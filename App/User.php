<?php

/*
 *  Exception List
 *  Code -> Definition
 *  001 -> validate error, username regex
 *  002 -> validate error, name regex
 *  003 -> validate error, surname regex
 *  004 -> validate error, mail regex
 *  005 -> validate error, identity is not 11 character
 *  006 -> validate error, identity wrong
 *  007 -> validate error, identity check error
 *
 *  11 -> load error, id null
 *  12 -> load error, user not found
 *  13 -> load error, users not found
 *  14 -> load error, search parameter is null
 *
 *  21 -> save error, id null
 *  22 -> save error, username exist
 *  23 -> save error, failed to user saving
 *
 *  31 -> login error, username or password null
 *  32 -> login error, user not found
 *  33 -> login error, banned user
 *  34 -> login error, wrong password
 *
 *  41 -> register error, failed to register
 *  42 -> register error, username or mail exist
 *
 *  51 -> change password, password check doesnt match
 *  52 -> change password, old password wrong
 *
 *  61 -> change address, same address
 *
 */


require_once 'DB.php';
require_once 'define.php';

class User extends DB
{
    private $id;
    private $username;
    private $name;
    private $surname;
    private $password;

    private $status;

    private $mail;
    private $phone;
    private $identity;
    private $birthDate;
    private $birthDateDay;
    private $birthDateMonth;
    private $birthDateYear;

    private $city;
    private $fullAddress;


    public $setUsername;
    public $setName;
    public $setSurname;
    public $setPassword;
    public $setPasswordCheck;
    public $oldPassword;

    public $setStatus;

    public $setMail;
    public $setPhone;
    public $setIdentity;
    public $setBirthDate;

    public $setCity;
    public $setFullAddress;


    public function __construct()
    {
        parent::__construct();
    }

    public function load($userID = null) //loads user from db. returns object or exception or false
    {
        if (!isset($userID))
            throw new Exception('userID is null', 11);
        $user = $this->_db->prepare("SELECT * FROM user WHERE id =?");
        $user->execute([$userID]);
        $user = $user->fetch();
        if (!$user)
            throw new Exception('User not found with this id: ' . $userID, 12);
        if (!empty($user)) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->name = $user['name'];
            $this->surname = $user['surname'];
            $this->password = $user['password'];
            $this->status = $user['status'];
            $this->mail = $user['mail'];
            $this->phone = $user['phone'];
            $this->identity = $user['identity'];
            $this->birthDate = $user['birth'];
            $this->city = $user['city'];
            $this->fullAddress = $user['address'];

            $this->setUsername = $user['username'];
            $this->setName = $user['name'];
            $this->setSurname = $user['surname'];
            $this->setPassword = $user['password'];
            $this->setStatus = $user['status'];
            $this->setMail = $user['mail'];
            $this->setPhone = $user['phone'];
            $this->setIdentity = $user['identity'];
            $this->setBirthDate = $user['birth'];
            $this->setCity = $user['city'];
            $this->setFullAddress = $user['address'];

            $this->parseBirthDate();
            return true;
        }
        return false;
    }

    public function loadUserWithUsername($username = null) //loads user from db. returns object or exception or false
    {
        if (!isset($username))
            throw new Exception('username is null', 11);
        $user = $this->_db->prepare("SELECT * FROM user WHERE username =?");
        $user->execute([$username]);
        $user = $user->fetch();
        if (!$user)
            throw new Exception('User not found with this username: ' . $username, 12);
        if (!empty($user)) {
            $this->load($user['id']);
            return true;
        }
        return false;
    }

    public function getAllUsers() //returns array or exception or false
    {
        $userArray = [];
        $users = $this->_db->query("SELECT * FROM user ORDER BY id ASC", PDO::FETCH_ASSOC);
        if (!$users)
            throw new Exception('Users not found.', 13);
        if ($users->rowCount()) {
            foreach ($users as $user) {
                $newUser = new User();
                $newUser->load($user['id']);
                $userArray[$newUser->getID()] = $newUser;
            }
            return $userArray;
        }
        return false;
    }

    public function getUsersWithSearch($search = null) //returns array or exception or false
    {
        if (!isset($search))
            throw new Exception('search parameter is null', 14);
        $userArray = [];
        $users = $this->_db->prepare("SELECT * FROM user WHERE id = ? OR username LIKE ? ORDER BY id DESC");
        $users->execute([$search, "%$search%"]);
        if (!$users)
            throw new Exception('Users not found.', 13);
        if ($users->rowCount()) {
            foreach ($users as $user) {
                $newUser = new User();
                $newUser->load($user['id']);
                $userArray[$newUser->getID()] = $newUser;
            }
            return $userArray;
        }
        return false;
    }

    public function save() //requires setUsername, setName, setSurname, setIdentity, setPhone, setBirthDate, setMail, setStatus, setCity, setFullAddress. returns true or exception
    {
        if (!isset($this->id))
            throw new Exception('User ID cannot be null.', 21);
        if ($this->setUsername != $this->getUsername()) {
            $checkExist = $this->_db->prepare("SELECT * FROM user WHERE username =?");
            $checkExist->execute([$this->setUsername]);
            $checkExist = $checkExist->fetch();
            if ($checkExist)
                throw new Exception('username exist.', 22);
        }
        $sql = "UPDATE user SET 
                username=?,
                name=?,
                surname=?,
                status=?,
                mail=?,
                phone=?,
                identity=?,
                birth=?
                WHERE
                id=?";
        $user = $this->_db->prepare($sql)->execute([$this->setUsername, $this->setName, $this->setSurname, $this->setStatus, $this->setMail, $this->setPhone, $this->setIdentity, $this->setBirthDate, $this->id]);
        if (!$user)
            throw new Exception('Failed to user saving.', 23);
        else {
            $this->load($this->id);
            return true;
        }
    }

    public function changePassword() // requires $this->oldPassword, $this->setPassword, $this->setPasswordCheck. returns true or false
    {
        if ($this->setPassword != $this->setPasswordCheck)
            throw new Exception('Password check doesn\'t match.', 51);
        if (!password_verify($this->oldPassword, $this->password))
            throw new Exception('Wrong password.', 52);
        $sql = "UPDATE user SET password=? WHERE id=?";
        if ($this->_db->prepare($sql)->execute([password_hash($this->setPassword, PASSWORD_DEFAULT), $this->id])) {
            $this->load($this->id);
            return true;
        } else
            return false;
    }

    public function changeAddress() //requires $this->setCity and $this->setFullAddress. returns true/false or exception
    {
        if ($this->setCity == $this->city && $this->setFullAddress == $this->fullAddress)
            throw new Exception('Same address fields.', 61);
        $sql = "UPDATE user SET city=?, address=? WHERE id=?";
        if ($this->_db->prepare($sql)->execute([$this->setCity, $this->setFullAddress, $this->id])) {
            $this->load($this->id);
            return true;
        } else
            return false;
    }

    public function delete()
    {
        $sql = "DELETE FROM user WHERE id =?";
        if ($this->_db->prepare($sql)->execute([$this->id]))
            return true;
        else
            return false;
    }

    public function login($username, $password) //requires $username, $password. returns true/false or exception
    {
        if (is_null($username) || trim($username) == '' || is_null($password) || trim($password) == '')
            throw new Exception('Username or password cannot be null.', 31);
        $login = $this->_db->prepare("SELECT * FROM user WHERE username =?");
        $login->execute([$username]);
        $login = $login->fetch();
        if (!$login)
            throw new Exception('User not found.', 32);
        if ($login['status'] == Banned)
            throw new Exception('Banned user.', 33);
        $passwordCheck = password_verify($password, $login['password']);
        if (!$passwordCheck)
            throw new Exception('Password doesnt match.', 34);
        if ($login && $login['status'] >= 1 && $passwordCheck) {
            $this->load($login['id']);
            return true;
        }
        return false;
    }

    public function register() //requires setUsername, setName, setSurname, setIdentity, setPassword, setPhone, setBirthDate, setMail, setStatus. returns true or exception
    {
        $this->setPassword = password_hash($this->setPassword, PASSWORD_DEFAULT);

        $exist = $this->_db->prepare("SELECT * FROM user WHERE username = ? OR mail = ?");
        $exist->execute([$this->setUsername, $this->setMail]);
        $exist = $exist->fetch();
        if (!$exist) {
            $sql = "INSERT INTO user (username, name, surname, identity, password, phone, birth, mail, status) VALUES (?,?,?,?,?,?,?,?,?)";
            $register = $this->_db->prepare($sql)->execute([$this->setUsername, $this->setName, $this->setSurname, $this->setIdentity, $this->setPassword, $this->setPhone, $this->setBirthDate, $this->setMail, $this->setStatus]);
            if ($register)
                return true;
            else
                throw new Exception('Failed to register.', 41);
        } else
            throw new Exception('Username or mail exist.', 42);
    }

    private function parseBirthDate()
    {
        $birthDateTime = new DateTime($this->birthDate);
        $this->birthDateDay = $birthDateTime->format('d');
        $this->birthDateMonth = $birthDateTime->format('m');
        $this->birthDateYear = $birthDateTime->format('Y');
    }

    public function validateInputs() //validate setName, setSurname, setMail. returns true or exception
    {
        if (!preg_match("/^[a-zA-Z']*$/", $this->setUsername) || is_null($this->setUsername))
            throw new Exception('Only english characters allowed on username.', 001);
        if (!preg_match("/^[a-zA-ZğüşöçİĞÜŞÖÇ' ]*$/", $this->setName) || is_null($this->setName))
            throw new Exception('Only letters and white space allowed on name.', 002);
        if (!preg_match("/^[a-zA-ZğüşöçİĞÜŞÖÇ' ]*$/", $this->setSurname) || is_null($this->setSurname))
            throw new Exception('Only letters and white space allowed on surname.', 003);
        if (!filter_var($this->setMail, FILTER_VALIDATE_EMAIL) || is_null($this->setMail))
            throw new Exception('Invalid email format: ' . $this->setMail, 004);

        return true;
    }


    public function validateIdentity() //validate setName, setSurname, setIdentity, birthDateYear. returns true/false or "err"
    {
        if (strlen($this->setIdentity) != 11)
            throw new Exception('identity must be 11 character.', 005);
        $client = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");
        try {
            $result = $client->TCKimlikNoDogrula([
                'TCKimlikNo' => $this->setIdentity,
                'Ad' => trim($this->setName),
                'Soyad' => trim($this->setSurname),
                'DogumYili' => $this->birthDateYear
            ]);
            if ($result->TCKimlikNoDogrulaResult) {
                return true;
            } else {
                throw new Exception('identity wrong.', 006);
            }
        } catch (Exception $e) {
            throw new Exception('identity check error.', 007);
        }
    }

    public function getID()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getIdentity()
    {
        return $this->identity;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getBirthDateDay()
    {
        return $this->birthDateDay;
    }

    public function getBirthDateMonth()
    {
        return $this->birthDateMonth;
    }

    public function getBirthDateYear()
    {
        return $this->birthDateYear;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getFullAddress()
    {
        return $this->fullAddress;
    }
}

?>