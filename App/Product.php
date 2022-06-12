<?php
/*
 *  Exception List
 *  Code -> Definition
 *  001 -> validate error, name regex
 *  002 -> validate error, surname regex
 *  003 -> validate error, mail regex
 *
 *  11 -> load error, id null
 *  12 -> load error, product not found
 *  13 -> load error, products not found
 *  14 -> load error, search parameter is null
 *
 *  21 -> save error, id null
 *  22 -> save error, slug exist
 *  23 -> save error, failed to user saving
 *
 *
 *  41 -> register error, failed to register
 *  42 -> register error, code or slug exist
 */

require_once 'DB.php';
require_once 'define.php';

class Product extends DB
{
    private $id;
    private $name;
    private $code;
    private $slug;
    private $description;
    private $status;
    private $showSize;

    private $page;
    private $category;
    private $subCategory;

    private $discount;
    private $price;
    private $discountedPrice;

    private $image1;
    private $image2;
    private $image3;

    private $uploadDate;

    public $setName;
    public $setCode;
    public $setSlug;
    public $setDescription;
    public $setStatus;
    public $setShowSize;

    public $setPage;
    public $setCategory;
    public $setSubCategory;

    public $setDiscount;
    public $setPrice;
    public $setDiscountedPrice;

    public $setImage1;
    public $setImage2;
    public $setImage3;

    public function __construct()
    {
        parent::__construct();
    }

    public function load($productID = null)
    {
        if (!isset($productID))
            throw new Exception('productID is null', 11);
        $product = $this->_db->prepare("SELECT * FROM product WHERE id =?");
        $product->execute([$productID]);
        $product = $product->fetch();
        if (!$product)
            throw new Exception('product not found with this id: ' . $productID, 12);
        if (!empty($product)) {
            $this->id = $product['id'];
            $this->name = $product['name'];
            $this->code = $product['code'];
            $this->slug = $product['slug'];
            $this->description = $product['description'];
            $this->status = $product['status'];
            $this->showSize = $product['size'];
            $this->page = $product['page'];
            $this->category = $product['category'];
            $this->subCategory = $product['subcategory'];
            $this->discount = $product['discount'];
            $this->price = $product['price'];
            $this->discountedPrice = $product['discountedPrice'];
            $this->image1 = $product['image1'];
            $this->image2 = $product['image2'];
            $this->image3 = $product['image3'];

            $this->setName = $product['name'];
            $this->setCode = $product['code'];
            $this->setSlug = $product['slug'];
            $this->setDescription = $product['description'];
            $this->setStatus = $product['status'];
            $this->setShowSize = $product['size'];
            $this->setPage = $product['page'];
            $this->setCategory = $product['category'];
            $this->setSubCategory = $product['subcategory'];
            $this->setDiscount = $product['discount'];
            $this->setPrice = $product['price'];
            $this->setDiscountedPrice = $product['discountedPrice'];
            $this->setImage1 = $product['image1'];
            $this->setImage2 = $product['image2'];
            $this->setImage3 = $product['image3'];

            $this->uploadDate = $product['uploadDate'];
            return true;
        }
        return false;
    }

    public function loadProductWithUrl($url = null) //loads product from db. returns object or exception or false
    {
        if (!isset($url))
            throw new Exception('$url is null', 11);
        $product = $this->_db->prepare("SELECT * FROM product WHERE slug =?");
        $product->execute([$url]);
        $product = $product->fetch();
        if (!$product)
            throw new Exception('product not found with this url: ' . $url, 12);
        if (!empty($product)) {
            $this->load($product['id']);
            return $this;
        }
        return false;
    }

    public function getAllProducts() //returns array or exception or false
    {
        $productArray = [];
        $products = $this->_db->query("SELECT * FROM product ORDER BY id ASC", PDO::FETCH_ASSOC);
        if (!$products)
            throw new Exception('products not found.', 13);
        if ($products->rowCount()) {
            foreach ($products as $product) {
                $newProduct = new Product();
                $newProduct->load($product['id']);
                $productArray[$newProduct->getID()] = $newProduct;
            }
            return $productArray;
        }
        return false;
    }

    public function getProductsWithSearch($search = null) //returns array or exception or false
    {
        if (!isset($search))
            throw new Exception('search parameter is null', 14);
        $productArray = [];
        $products = $this->_db->prepare("SELECT * FROM product WHERE id = ? OR name LIKE ? OR code = ? ORDER BY id DESC");
        $products->execute([$search, "%$search%", $search]);
        if (!$products)
            throw new Exception('products not found.', 13);
        if ($products->rowCount()) {
            foreach ($products as $product) {
                $newProduct = new Product();
                $newProduct->load($product['id']);
                $productArray[$newProduct->getID()] = $newProduct;
            }
            return $productArray;
        }
        return false;
    }

    public function save() //requires setUsername, setName, setSurname, setIdentity, setPhone, setBirthDate, setMail, setStatus, setCity, setFullAddress. returns true or exception
    {
        if (!isset($this->id))
            throw new Exception('product ID cannot be null.', 21);
        if ($this->setSlug != $this->getSlug()) {
            $checkExist = $this->_db->prepare("SELECT * FROM product WHERE BINARY slug =?");
            $checkExist->execute([$this->setSlug]);
            $checkExist = $checkExist->fetch();
            if ($checkExist)
                throw new Exception('slug exist.', 22);
        }
        $sql = "UPDATE product SET 
                name=?,
                description=?,
                code=?,
                slug=?,
                status=?,
                size=?,
                page=?,
                category=?,
                subcategory=?,
                discount=?,
                price=?,
                discountedPrice=?,
                image1=?,
                image2=?,
                image3=?
                WHERE
                id=?";
        $user = $this->_db->prepare($sql)->execute([$this->setName, $this->setDescription, $this->setCode, $this->setSlug, $this->setStatus, $this->setShowSize, $this->setPage, $this->setCategory, $this->setSubCategory, $this->setDiscount, $this->setPrice, $this->setDiscountedPrice, $this->setImage1, $this->setImage2, $this->setImage3, $this->id]);
        if (!$user)
            throw new Exception('Failed to product saving.', 23);
        else {
            $this->load($this->id);
            return true;
        }
    }

    public function create() //requires setName, setDescription, setCode, setSlug, setStatus, setShowSize, setPage, setCategory, setSubCategory, setPrice, setDiscount, setDiscountedPrice, setImage1, setImage2, setImage3. returns true or exception
    {
        $exist = $this->_db->prepare("SELECT * FROM product WHERE code = ? OR slug = ?");
        $exist->execute([$this->setCode, $this->setSlug]);
        $exist = $exist->fetch();
        if (!$exist) {
            $sql = "INSERT INTO product (name, description, code, slug, status, size, page, category, subcategory, price, discount, discountedPrice, image1, image2, image3) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $register = $this->_db->prepare($sql)->execute([$this->setName, $this->setDescription, $this->setCode, $this->setSlug, $this->setStatus, $this->setShowSize, $this->setPage, $this->setCategory, $this->setSubCategory, $this->setPrice, $this->setDiscount, $this->setDiscountedPrice, $this->setImage1, $this->setImage2, $this->setImage3]);
            if ($register)
                return $this->_db->lastInsertId();
            else
                throw new Exception('failed to insert.', 41);
        } else
            throw new Exception('code or slug exist.', 42);
    }

    public function delete()
    {
        $sql = "DELETE FROM product WHERE id =?";
        if ($this->_db->prepare($sql)->execute([$this->id]))
            return true;
        else
            return false;
    }
    public function generateProductCode($code_start)
    {
        tryagain:
        $random_id = rand(100000, 999999);
        $productCode = $code_start . '-' . $random_id;
        $checkExist = $this->_db->prepare("SELECT * FROM product WHERE code =?");
        $checkExist->execute([$productCode]);
        $checkExist = $checkExist->fetch();
        if ($checkExist)
            goto tryagain;
        else
            return $productCode;
    }

    public function createSlug($str, $delimiter = '-')
    {
        $turkish = array("ı", "İ", "ğ", "Ğ", "ü", "Ü", "ş", "Ş", "ö", "Ö", "ç", "Ç");//turkish letters
        $english = array("i", "I", "g", "G", "u", "U", "s", "S", "o", "O", "c", "C");//english cooridinators letters
        $str = str_replace($turkish, $english, $str);
        $str = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $str;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
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

    public function getPage()
    {
        return $this->page;
    }

    public function getCategory()
    {
        return $this->category;
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

    public function getUploadDate()
    {
        return $this->uploadDate;
    }
}