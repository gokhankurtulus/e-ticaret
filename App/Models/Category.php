<?php

namespace App\Models;
class Category extends Model
{
    protected static $table = 'categories';
    private $id;
    private $name;
    private $slug;
    private $parent;
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
            $this->parent = $resource['parent'];
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
        $allCategories = Category::get(where: $where);
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

    public function getSlug()
    {
        return $this->slug;
    }

    public function getParent()
    {
        return $this->parent;
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