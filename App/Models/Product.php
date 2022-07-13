<?php

namespace App\Models;


class Product extends Model
{
    protected static $table = 'product';
    private $id;
    private $name;
    private $trName;
    private $enName;
    private $ruName;
    private $code;
    private $slug;
    private $description;
    private $status;
    private $showSize;

    private $category;
    private $childCategory;
    private $subCategory;

    private $discount;
    private $price;
    private $discountedPrice;

    private $image1;
    private $image2;
    private $image3;

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
            $this->trName = $resource['tr_name'];
            $this->enName = $resource['en_name'];
            $this->ruName = $resource['ru_name'];
            $this->code = $resource['code'];
            $this->slug = $resource['slug'];
            $this->description = $resource['description'];
            $this->status = $resource['status'];
            $this->showSize = $resource['size'];
            $this->category = $resource['category'];
            $this->childCategory = $resource['childcategory'];
            $this->subCategory = $resource['subcategory'];
            $this->discount = $resource['discount'];
            $this->price = $resource['price'];
            $this->discountedPrice = $resource['discountedPrice'];
            $this->image1 = $resource['image1'];
            $this->image2 = $resource['image2'];
            $this->image3 = $resource['image3'];
            $this->created_at = $resource['created_at'];
            $this->updated_at = $resource['updated_at'];
            return true;
        }
        return false;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTrName()
    {
        return $this->trName;
    }

    public function getEnName()
    {
        return $this->enName;
    }

    public function getRuName()
    {
        return $this->ruName;
    }

    public function getNameByLanguage(string $language)
    {
        if (in_array($language, $GLOBALS['allowed_languages_code'])) {
            if ($language === 'tr')
                return $this->trName;
            else if ($language === 'en')
                return $this->enName;
            else if ($language === 'ru')
                return $this->ruName;
        }
        return $this->getName($GLOBALS['default_language']);
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getShowSize()
    {
        return $this->showSize;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getChildCategory()
    {
        return $this->childCategory;
    }

    public function getSubCategory()
    {
        return $this->subCategory;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDiscountedPrice()
    {
        return $this->discountedPrice;
    }

    public function getImage1()
    {
        return $this->image1;
    }

    public function getImage2()
    {
        return $this->image2;
    }

    public function getImage3()
    {
        return $this->image3;
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