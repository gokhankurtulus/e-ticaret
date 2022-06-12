<?php
/*
    $product->setName = 'test product';
    $product->setDescription = 'test desc';
    $product->setCode = $product->generateProductCode('TS');
    $product->setSlug = $product->createSlug($product->setName . '-' . $product->setCode);
    $product->setStatus = 0;
    $product->setShowSize = 0;
    $product->setPage = '1';
    $product->setCategory = '2';
    $product->setSubCategory = '3';
    $product->setPrice = '14.99';
    $product->setDiscount = '0';
    $product->setDiscountedPrice = '14.99';
    $product->setImage1 = '';
    $product->setImage2 = '';
    $product->setImage3 = '';
    $productID = $product->create(); //returns lastInsertId when successfully insert
    if ($productID)
        echo 'works';

$slug = "just-be-cool-unisex-basic-oversize-t-shirt-bs-524337";
    $product = new Product();
    $product->loadProductWithUrl($slug);
    echo $product->getPrice();

$slug = "just-be-cool-unisex-basic-oversize-t-shirt-bs-524337";
    $product = new Product();
    $product->loadProductWithUrl($slug);
    echo number_format($product->getPrice(), 2, ',', '.');
 */
