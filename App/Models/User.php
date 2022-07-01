<?php

namespace App\Models;

class User extends Model
{
    protected static $table = 'user';
    protected $id;
    protected $username;
    protected $name;
    protected $surname;
    protected $password;

    protected $status;

    protected $mail;
    protected $phone;
    protected $identity;
    protected $birthDate;
    protected $birthDateDay;
    protected $birthDateMonth;
    protected $birthDateYear;

    protected $city;
    protected $fullAddress;

    protected static function getTable()
    {
        return static::$table;
    }

    protected static function getClass()
    {
        return self::class;
    }


    public function load($resource)
    {
        if (!empty($resource)) {
            $this->id = $resource['id'];
            $this->username = $resource['username'];
            $this->name = $resource['name'];
            $this->surname = $resource['surname'];
            $this->password = $resource['password'];
            $this->status = $resource['status'];
            $this->mail = $resource['mail'];
            $this->phone = $resource['phone'];
            $this->identity = $resource['identity'];
            $this->birthDate = $resource['birth'];
            $this->city = $resource['city'];
            $this->fullAddress = $resource['address'];
            $this->parseBirthDate();
            return true;
        }
        return false;
    }

    public function login($username, $password) //TODO changed, will remove
    {
        if (is_null($username) || trim($username) == '' || is_null($password) || trim($password) == '')
            throw new \Exception('Username or password cannot be null.', 31);
        $login = $this->_db->prepare("SELECT * FROM user WHERE username =?");
        $login->execute([$username]);
        $login = $login->fetch();
        if (!$login)
            throw new \Exception('User not found.', 32);
        if ($login['status'] == Banned)
            throw new \Exception('Banned user.', 33);
        $passwordCheck = password_verify($password, $login['password']);
        if (!$passwordCheck)
            throw new \Exception('Password doesnt match.', 34);
        if ($login && $login['status'] >= 1 && $passwordCheck) {
            $this->load($login['id']);
            return true;
        }
        return false;
    }


    public function register() //TODO changed, will remove
    {
        $this->setPassword = password_hash($this->setPassword, PASSWORD_DEFAULT);

        $exist = $this->_db->prepare("SELECT * FROM user WHERE username = ? OR mail = ?");
        $exist->execute([$this->setUsername, $this->setMail]);
        $exist = $exist->fetch();
        if (!$exist) {
            $sql = "INSERT INTO user (username, name, surname, identity, password, phone, birth, mail, status) VALUES (?,?,?,?,?,?,?,?,?)";
            $register = $this->_db->prepare($sql)->execute([$this->setUsername, $this->setName, $this->setSurname, $this->setIdentity, $this->setPassword, $this->setPhone, $this->setBirthDate, $this->setMail, $this->setStatus]);
            if ($register)
                return $this->_db->lastInsertId();
            else
                throw new \Exception('Failed to register.', 41);
        } else
            throw new \Exception('Username or mail exist.', 42);
    }

    public function parseBirthDate()
    {
        $birthDateTime = new \DateTime($this->birthDate);
        $this->birthDateDay = $birthDateTime->format('d');
        $this->birthDateMonth = $birthDateTime->format('m');
        $this->birthDateYear = $birthDateTime->format('Y');
    }

    public function validateInputs() //TODO changed, will remove
    {
        if (!(strlen($this->setUsername) >= 6 && strlen($this->setUsername) <= 20))
            throw new \Exception('Username must be 6-20 character long.', 100);
        if (!(strlen($this->setName) >= 2 && strlen($this->setName) <= 20))
            throw new \Exception('Name must be 2-20 character long.', 101);
        if (!(strlen($this->setSurname) >= 2 && strlen($this->setSurname) <= 20))
            throw new \Exception('Surname must be 2-20 character long.', 102);
        if (empty(trim($this->setMail)))
            throw new \Exception('Email cannot be empty.', 103);
        if (!preg_match("/^[a-zA-Z']*$/", $this->setUsername) || is_null($this->setUsername))
            throw new \Exception('Only english characters allowed on username.', 104);
        if (!preg_match("/^[a-zA-ZğüşöçİĞÜŞÖÇ' ]*$/", $this->setName) || is_null($this->setName))
            throw new \Exception('Only letters and white space allowed on name.', 105);
        if (!preg_match("/^[a-zA-ZğüşöçİĞÜŞÖÇ' ]*$/", $this->setSurname) || is_null($this->setSurname))
            throw new \Exception('Only letters and white space allowed on surname.', 106);
        if (!filter_var($this->setMail, FILTER_VALIDATE_EMAIL) || is_null($this->setMail))
            throw new \Exception('Invalid email format: ' . $this->setMail, 107);

        return true;
    }


    public function validateIdentity() //TODO changed, will remove
    {
        $int_identity = ctype_digit($this->setIdentity) ? intval($this->setIdentity) : null;
        if (strlen($int_identity) != 11 || !is_int($int_identity))
            throw new \Exception('identity must be 11 digit number.', 200);
        $client = new \SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");
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
                throw new \Exception('identity wrong.', 201);
            }
        } catch (\Exception $e) {
            throw new \Exception('identity check error.', 202);
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