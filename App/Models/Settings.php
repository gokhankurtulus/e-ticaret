<?php

namespace App\Models;
class Settings extends Model
{
    protected static $table = 'settings';
    private $id;
    private $name;
    private $logo;
    private $slogan;
    private $mail;
    private $phone;
    private $tr_working_date;
    private $en_working_date;
    private $ru_working_date;
    private $location;
    private $location_link;
    private $wp_link;
    private $fb_link;
    private $tw_link;
    private $ig_link;
    private $in_link;
    private $created_at;
    private $updated_at;

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
            $this->name = $resource['name'];
            $this->logo = $resource['logo'];
            $this->slogan = $resource['slogan'];
            $this->mail = $resource['mail'];
            $this->phone = $resource['phone'];
            $this->tr_working_date = $resource['tr_working_date'];
            $this->en_working_date = $resource['en_working_date'];
            $this->ru_working_date = $resource['ru_working_date'];
            $this->location = $resource['location'];
            $this->location_link = $resource['location_link'];
            $this->wp_link = $resource['wp_link'];
            $this->fb_link = $resource['fb_link'];
            $this->tw_link = $resource['tw_link'];
            $this->ig_link = $resource['ig_link'];
            $this->in_link = $resource['in_link'];
            $this->created_at = $resource['created_at'];
            $this->updated_at = $resource['updated_at'];
            return true;
        }
        return false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function getSlogan()
    {
        return $this->slogan;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getWorkingDateByLanguage(string $language)
    {
        if (in_array($language, $GLOBALS['allowed_languages_code'])) {
            if ($language === 'tr')
                return $this->tr_working_date;
            else if ($language === 'en')
                return $this->en_working_date;
            else if ($language === 'ru')
                return $this->ru_working_date;
        }
        return $this->getWorkingDateByLanguage($GLOBALS['default_language']);
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getLocationLink()
    {
        return $this->location_link;
    }

    public function getWpLink()
    {
        return $this->wp_link;
    }

    public function getFbLink()
    {
        return $this->fb_link;
    }

    public function getTwLink()
    {
        return $this->tw_link;
    }

    public function getIgLink()
    {
        return $this->ig_link;
    }


    public function getInLink()
    {
        return $this->in_link;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

}