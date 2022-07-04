<?php

namespace App\Models;

class User extends Model
{
    protected static $table = 'user';
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
            if ($this->birthDate)
                $this->parseBirthDate();
            return true;
        }
        return false;
    }

    public function parseBirthDate()
    {
        $birthDateTime = new \DateTime($this->birthDate);
        $this->birthDateDay = $birthDateTime->format('d');
        $this->birthDateMonth = $birthDateTime->format('m');
        $this->birthDateYear = $birthDateTime->format('Y');
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