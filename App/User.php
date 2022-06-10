<?php

/*
 *  Exception List
 *  Code -> Definition
 *  001 -> validate error, name regex
 *  002 -> validate error, surname regex
 *  003 -> validate error, mail regex
 *
 *  11 -> load error, id null
 *  12 -> load error, user not found
 *  13 -> load error, users not found
 *
 *  21 -> save error, id null
 *  22 -> save error, sql execution
 *
 *  31 -> login error, sql returned false
 *  32 -> login error, banned user
 *  33 -> login error, wrong password
 *
 *  41 -> register error, sql returned false
 *  42 -> register error, username or mail exist
 *
 *  51 -> change password, password check doesnt match
 *  52 -> change password, old password wrong
 *
 *  61 -> change address, same address
 *
 */

require_once 'DB.php';

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

    public function load($userID = null)
    {
        if (is_null($userID))
            throw new Exception('userID is null', 11);
        $user = $this->_db->prepare("SELECT * FROM user WHERE id =?");
        $user->execute([$userID]);
        $user = $user->fetch();
        if (!$user)
            throw new Exception('User not found with this id: ' . $this->id, 12);
        if (!is_null($user) && !empty($user)) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->setUsername = $user['username'];
            $this->name = $user['name'];
            $this->setName = $user['name'];
            $this->surname = $user['surname'];
            $this->setSurname = $user['surname'];
            $this->password = $user['password'];
            $this->setPassword = $user['password'];

            $this->status = $user['status'];
            $this->setStatus = $user['status'];

            $this->mail = $user['mail'];
            $this->setMail = $user['mail'];
            $this->phone = $user['phone'];
            $this->setPhone = $user['phone'];
            $this->identity = $user['identity'];
            $this->setIdentity = $user['identity'];
            $this->birthDate = $user['birth'];
            $this->setBirthDate = $user['birth'];

            $this->city = $user['city'];
            $this->setCity = $user['city'];
            $this->fullAddress = $user['address'];
            $this->setFullAddress = $user['address'];
            return $this;
        }
    }

    public function getAllUsers() //returns array
    {
        $userArray = [];
        $query = $this->_db->query("SELECT * FROM user ORDER BY id ASC", PDO::FETCH_ASSOC);
        if (!$query)
            throw new Exception('Users not found.', 13);
        if ($query->rowCount()) {
            foreach ($query as $user) {
                $newUser = new User();
                $newUser->id = $user['id'];
                $newUser->username = $user['username'];
                $newUser->setUsername = $user['username'];
                $newUser->name = $user['name'];
                $newUser->setName = $user['name'];
                $newUser->surname = $user['surname'];
                $newUser->setSurname = $user['surname'];
                $newUser->password = $user['password'];
                $newUser->setPassword = $user['password'];
                $newUser->status = $user['status'];
                $newUser->setStatus = $user['status'];
                $newUser->mail = $user['mail'];
                $newUser->setMail = $user['mail'];
                $newUser->phone = $user['phone'];
                $newUser->setPhone = $user['phone'];
                $newUser->identity = $user['identity'];
                $newUser->setIdentity = $user['identity'];
                $newUser->birthDate = $user['birth'];
                $newUser->setBirthDate = $user['birth'];
                $newUser->city = $user['city'];
                $newUser->setCity = $user['city'];
                $newUser->fullAddress = $user['address'];
                $newUser->setFullAddress = $user['address'];

                $userArray[$user['id']] = $newUser;
            }
            return $userArray;
        }

    }

    public function validateInputs()
    {
        if (!preg_match("/^[a-zA-ZğüşöçİĞÜŞÖÇ' ]*$/", $this->setName) || is_null($this->setName))
            throw new Exception('Only letters and white space allowed on name.', 001);
        if (!preg_match("/^[a-zA-ZğüşöçİĞÜŞÖÇ' ]*$/", $this->setSurname) || is_null($this->setSurname))
            throw new Exception('Only letters and white space allowed on surname.', 002);
        if (!filter_var($this->setMail, FILTER_VALIDATE_EMAIL) || is_null($this->setMail))
            throw new Exception('Invalid email format: ' . $this->setMail, 003);

        return true;
    }

    public function save()
    {
        if ($this->id == null)
            throw new Exception('User ID cannot be null.', 21);
        $this->validateInputs();
        if ($this->setUsername != $this->getUsername()) {
            $checkExist = $this->_db->prepare("SELECT * FROM user WHERE username =?");
            $checkExist->execute([$this->setUsername]);
            $checkExist = $checkExist->fetch();
            if ($checkExist)
                throw new Exception('username exist.', 23);
        }
        $sql = "UPDATE user SET 
                username=?,
                name=?,
                surname=?,
                status=?,
                mail=?,
                phone=?,
                identity=?,
                birth=?,
                city=?,
                address=?
                WHERE
                id=?";
        $user = $this->_db->prepare($sql)->execute([$this->setUsername, $this->setName, $this->setSurname, $this->setStatus, $this->setMail, $this->setPhone, $this->setIdentity, $this->setBirthDate, $this->setCity, $this->setFullAddress, $this->id]);
        if (!$user)
            throw new Exception('Failed to user saving.', 22);
        else
            return true;
    }

    public function changePassword() // requires $this->oldPassword, $this->setPassword, $this->setPasswordCheck. returns true or false
    {
        if ($this->setPassword != $this->setPasswordCheck)
            throw new Exception('Password check doesn\'t match.', 51);
        if (!password_verify($this->oldPassword, $this->password))
            throw new Exception('Wrong password.', 52);
        $sql = "UPDATE user SET password=? WHERE id=?";
        if ($this->_db->prepare($sql)->execute([password_hash($this->setPassword, PASSWORD_DEFAULT), $this->id]))
            return true;
        else
            return false;
    }

    public function changeAddress() //requires $this->setCity and $this->setFullAddress. returns true or false
    {
        if ($this->setCity == $this->city && $this->setFullAddress == $this->fullAddress)
            throw new Exception('Same address fields.', 61);
        $sql = "UPDATE user SET city=?, address=? WHERE id=?";
        if ($this->_db->prepare($sql)->execute([$this->setCity, $this->setFullAddress, $this->id]))
            return true;
        else
            return false;
    }

    public function delete()
    {
        $sql = "DELETE FROM user WHERE id =?";
        $this->_db->prepare($sql)->execute([$this->id]);
    }

    public function login($username, $password)
    {
        $login = $this->_db->prepare("SELECT * FROM user WHERE BINARY username =?");
        $login->execute([$username]);
        $login = $login->fetch();
        if (!$login)
            throw new Exception('Login error.', 31);
        if ($login['status'] == 0)
            throw new Exception('Banned user.', 32);
        $passwordCheck = password_verify($password, $login['password']);
        if (!$passwordCheck)
            throw new Exception('Password doesnt match.', 33);
        if ($login && $login['status'] >= 1 && $passwordCheck) {
            return $login['id'];
        }
    }

    public function register()
    {
        $this->validateInputs();
        $this->setPassword = password_hash($this->setPassword, PASSWORD_DEFAULT);

        $exist = $this->_db->prepare("SELECT * FROM user WHERE username = ? OR mail = ?");
        $exist->execute([$this->setUsername,$this->setMail]);
        $exist = $exist->fetch();
        if (!$exist) {
            $sql = "INSERT INTO user (username, name, surname, identity, password, phone, birth, mail, status) VALUES (?,?,?,?,?,?,?,?,?)";
            $register = $this->_db->prepare($sql)->execute([$this->setUsername, $this->setName, $this->setSurname, $this->setIdentity, $this->setPassword, $this->setPhone, $this->setBirthDate, $this->setMail, $this->setStatus]);
            if ($register)
                return true;
            else
                return throw new Exception('Failed to register.', 41);
        } else
            return throw new Exception('Username or mail exist.', 42);
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