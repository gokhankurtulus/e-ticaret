<?php

namespace App\Models;
class Category extends Model
{
    protected static $table = 'categories';
    private $id;
    private $name;
    private $trName;
    private $enName;
    private $ruName;
    private $slug;
    private $parent;
    private $isRoot;
    private $isChild;
    private $isSub;
    private $status;
    private $created_at;
    private $updated_at;
    public $children;

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
            $this->parent = $resource['parent'];
            $this->isRoot = $resource['isRoot'];
            $this->isChild = $resource['isChild'];
            $this->isSub = $resource['isSub'];
            $this->slug = $resource['slug'];
            $this->status = $resource['status'];
            $this->created_at = $resource['created_at'];
            $this->updated_at = $resource['updated_at'];
            return true;
        }
        return false;
    }

    public static function tree($where = [])
    {
        $allCategories = Category::getAll(where: $where);
        foreach ($allCategories as $category) {
            if ($category->getParent() === NULL)
                $rootCategories[] = $category;
        }
        self::formatTree($rootCategories, $allCategories);
        return $rootCategories;
    }

    private static function formatTree($rootCategories, $allCategories)
    {
        foreach ($rootCategories as $rootCategory) {
            foreach ($allCategories as $category)
                if ($rootCategory->getID() === $category->getParent())
                    $rootCategory->children[] = $category;
            if (!is_null($rootCategory->children))
                self::formatTree($rootCategory->children, $allCategories);
        }
    }


    public function getId()
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

    public function getSlug()
    {
        return $this->slug;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getIsRoot()
    {
        return $this->isRoot;
    }

    public function getIsChild()
    {
        return $this->isChild;
    }

    public function getIsSub()
    {
        return $this->isSub;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getChildren()
    {
        return $this->children;
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