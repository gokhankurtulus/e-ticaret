# Class structure and usage examples for e-commerce

<h3 align="left">Languages and Tools:</h3>
<p align="left">
<img onclick="return false;" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40" title="PHP"/>
<img onclick="return false;" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40" title="MySQL"/>
<img onclick="return false;" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="javascript" width="40" height="40" title="JavaScript"/>
<img onclick="return false;" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/jquery/jquery-original.svg" alt="jquery" width="40" height="40" title="jQuery"/>
<img onclick="return false;" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg" alt="html" width="40" height="40" title="HTML"/>
<img onclick="return false;" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original.svg" alt="css" width="40" height="40" title="CSS"/>
</p>
<ul>
  <li>jQuery v3.5.1</li>
  <li>jQuery UI - v1.12.1</li>
  <li>SOAP</li>
</ul>
<ul>
  <li><a href="https://github.com/gokhankurtulus/e-ticaret#user-class">User Class</a></li>
  <li><a href="https://github.com/gokhankurtulus/e-ticaret#product-class">Product Class</a></li>
</ul>
<h3 align="left">define.php</h3>
User Roles
<ul>
  <li>define('Banned', 0);</li>
  <li>define('User', 1);</li>
  <li>define('Editor', 2);</li>
  <li>define('Support', 3);</li>
  <li>define('Moderator', 4);</li>
  <li>define('Admin', 5);</li>
</ul>
<h2 align="left">User Class</h2>
<h3 align="left">Register</h3>
<ul>
  <li>$user = new User();</li>
  <li>$user->setUsername = "username";</li>
  <li>$user->setName = "Name";</li>
  <li>$user->setSurname = "Surname";</li>
  <li>$user->setPassword = "passw0rd";</li>
  <li>$user->setStatus = User;</li>
  <li>$user->setMail = "user@mail.com";</li>
  <li>$user->setPhone = "(123) 456 - 7890";</li>
  <li>$user->setIdentity = "11111111111";</li>
  <li>$user->setBirthDate = "YYYY-MM-DD";</li>
  <li>if ($user->register())</li>
  <li>#do something</li>
</ul>
<h3 align="left">Login</h3>
<ul>
  <li>$userForLogin = new User();</li>
  <li>if ($userForLogin->login('username', 'passw0rd'))</li>
  <li>echo $userForLogin->getID();</li>
</ul>
<h3 align="left">Load</h3>
<ul>
  <li>$userID = 14;</li>
  <li>$user = new User();</li>
  <li>$user->load($userID);</li>
  <li>echo $user->getName();</li>
</ul>
<h3 align="left">Load With Username</h3>
<ul>
  <li>$user = new User();</li>
  <li>$user->loadUserWithUsername('username');</li>
  <li>echo $user->getMail();</li>
</ul>
<h3 align="left">Save</h3>
<ul>
  <li>$user = new User();</li>
  <li>$user->load(28);</li>
  <li>$user->setName = "NewName";</li>
  <li>$user->setSurname = "NewSurname";</li>
  <li>if($user->validateInputs() && $user->validateIdentity())</li>
  <li>if($user->save())</li>
  <li>#do something</li>
  <br>
  <li>$anotherUser = new User();</li>
  <li>$anotherUser->load(29);</li>
  <li>$anotherUser->setUsername = "newUsername";</li>
  <li>$anotherUser->setMail = "new@mail.com";</li>
  <li>if($user->validateInputs() && $user->validateIdentity())</li>
  <li>$anotherUser->save();</li>
  <li>echo $anotherUser->getUsername();</li>
  <li>echo $anotherUser->getMail();</li>
  <br>
  <li>$user2 = new User();</li>
  <li>$user2->load(29);</li>
  <li>$user2->setIdentity = "11111111111";</li>
  <li>if($user->validateInputs() && $user->validateIdentity())</li>
  <li>$user2->save();</li>
  <li>echo $user2->getIdentity();</li>
</ul>
<h3 align="left">Delete</h3>
<ul>
  <li>$user = new User();</li>
  <li>$user->load(8);</li>
  <li>if ($user->delete())</li>
  <li>echo 'user deleted.';</li>
</ul>
<h3 align="left">Change Password</h3>
<ul>
  <li>$user = new User();</li>
  <li>$user->load(12);</li>
  <li>$user->setPassword = "newPassw0rd";</li>
  <li>$user->setPasswordCheck = "newPassw0rd";</li>
  <li>$user->oldPassword = "passw0rd";</li>
  <li>if($user->changePassword())</li>
  <li>#do something</li>
</ul>
<h3 align="left">Change Address</h3>
<ul>
  <li>$user = new User();</li>
  <li>$user->load(17);</li>
  <li>$user->setCity = 34;</li>
  <li>$user->setFullAddress = "Full address here";</li>
  <li>if($user->changeAddress())</li>
  <li>#do something</li>
</ul>
<h3 align="left">Get Users With Search</h3>
<ul>
  <li>$userID = 24;</li>
  <li>$userClass = new User();</li>
  <li>$searchResult =$userClass->getUsersWithSearch('userna');</li>
  <li>//print_r($searchResult);</li>
  <li>if (isset($searchResult[$userID]))</li>
  <li>echo $searchResult[$userID]->getName();</li>
</ul>
<h3 align="left">Get All Users</h3>
<ul>
  <li>$userClass = new User();</li>
  <li>$allUsers = $userClass->getAllUsers();</li>
  <li>print_r($allUsers);</li>
  <br>
  <li>$firstUserID = 15;</li>
  <li>$secondUserID = 16;</li>
  <li>print_r($allUsers[$firstUserID]);</li>
  <li>echo $allUsers[$secondUserID]->getUsername();</li>
</ul>
<h3 align="left">Set user data in array</h3>
<ul>
  <li>$userClass = new User();</li>
  <li>$allUsers = $userClass->getAllUsers();</li>
  <li>$allUsers[22]->setUsername = "youcansetuservalues";</li>
  <li>if($allUsers[22]->validateInputs() && $allUsers[22]->validateIdentity())</li>
  <li>$allUsers[22]->save();</li>
  <li>echo $allUsers[22]->getUsername();</li>
</ul>
<h3 align="left">Functions</h3>
<ul>
  <li>parseBirthDate() - Parse loaded user's birthDate to birthDateDay, birthDateMonth, birthDateYear.</li>
  <li>validateInputs() - Requires setName, setSurname, setMail. Returns true or exception.</li>
  <li>validateIdentity() - Validates T.C citizens identity from tckimlik.nvi.gov.tr. Requires setName, setSurname, setIdentity, birthDateYear. returns true/false or "err".</li>
  <li>getID() - Returns user's id.</li>
  <li>getUsername() - Returns user's username.</li>
  <li>getName() - Returns user's name.</li>
  <li>getSurname() - Returns user's surname.</li>
  <li>getPassword() - Returns user's password.</li>
  <li>getStatus() - Returns user's status.</li>
  <li>getMail() - Returns user's mail.</li>
  <li>getPhone() - Returns user's phone.</li>
  <li>getIdentity() - Returns user's identity.</li>
  <li>getBirthDate() - Returns user's birthdate.</li>
  <li>getBirthDateDay() - Returns user's birthdate (Day).</li>
  <li>getBirthDateMonth() - Returns user's birthdate (Month).</li>
  <li>getBirthDateYear() - Returns user's birthdate (Year).</li>
  <li>getCity() - Returns user's city.</li>
  <li>getFullAddress() - Returns user's fullAddress.</li>
</ul>
<h2 align="left">Product Class</h2>
<h3 align="left">Create</h3>
<ul>
  <li>$product = new Product();</li>
  <li>$product->setName = 'Best Product';</li>
  <li>$product->setDescription = 'test desc';</li>
  <li>$product->setCode = $product->generateProductCode('TST');</li>
  <li>$product->setSlug = $product->createSlug($product->setName . '-' . $product->setCode);</li>
  <li>$product->setStatus = 0;</li>
  <li>$product->setShowSize = 0;</li>
  <li>$product->setPage = '1';</li>
  <li>$product->setCategory = '2';</li>
  <li>$product->setSubCategory = '3';</li>
  <li>$product->setPrice = '14.99';</li>
  <li>$product->setDiscount = '0';</li>
  <li>$product->setDiscountedPrice = '14.99';</li>
  <li>$product->setImage1 = 'image1.jpg';</li>
  <li>$product->setImage2 = 'image2.jpg';</li>
  <li>$product->setImage3 = 'image3.jpg';</li>
  <li>$productID = $product->create(); //returns lastInsertId when successfully insert</li>
  <li>if ($productID)</li>
  <li>#do something</li>
</ul>
<h3 align="left">Load</h3>
<ul>
  <li>$productID = 135;</li>
  <li>$product = new Product();</li>
  <li>$product->load($userID);</li>
  <li>echo $product->getName();</li>
</ul>
<h3 align="left">Load With Url</h3>
<ul>
  <li>$slug = "basic-oversize-t-shirt-bs-859728";</li>
  <li>$product = new Product();</li>
  <li>$product->loadWithUrl($slug);</li>
  <li>echo $product->getPrice();</li>
</ul>
<h3 align="left">Save</h3>
<ul>
  <li>$product = new Product();</li>
  <li>$product->load(11129);</li>
  <li>$product->setName = 'New Product Name';</li>
  <li>$product->setSlug = $product->createSlug($product->setName . '-' . $product->setCode);</li>
  <li>$product->save();</li>
</ul>
<h3 align="left">Delete</h3>
<ul>
  <li>$product = new Product();</li>
  <li>$product->load(82354);</li>
  <li>if ($product->delete())</li>
  <li>echo 'product deleted.';</li>
</ul>
<h3 align="left">Get Products With Search</h3>
<ul>
  <li>$productClass = new Product();</li>
  <li>$searchResult = $productClass->getProductsWithSearch('t-shirt');</li>
  <li>print_r($searchResult);</li>
</ul>
<h3 align="left">Get All Products</h3>
<ul>
  <li>$productClass = new Product();</li>
  <li>$allProducts = $productClass->getAllProducts();</li>
  <li>print_r($allProducts);</li>
  <br>
  <li>$firstProductID = 1234;</li>
  <li>$secondProductID = 9876;</li>
  <li>print_r($allProducts[$firstProductID]);</li>
  <li>echo $allProducts[$secondProductID]->getPrice();</li>
</ul>

<h3 align="left">Set product data in array</h3>
<ul>
  <li>$productClass = new Product();</li>
  <li>$allProducts = $productClass->getAllProducts();</li>
  <li>$allProducts[11126]->setName = "youcansetproductvalues";</li>
  <li>$allProducts[11126]->setSlug = $allProducts[11126]->createSlug($allProducts[11126]->setName . '-' . $allProducts[11126]->setCode);</li>
  <li>$allProducts[11126]->save();</li>
  <li>echo $allProducts[11126]->getSlug();</li>
</ul>

<h3 align="left">Functions</h3>
<ul>
  <li>generateProductCode($code_start) - Requires code_start. Generates product code like TEST-123456</li>
  <li>createSlug($str, $delimiter = '-') - Requires str and delimiter. Generates SEO-Friendly slug.</li>
  <li>getID() - Returns product's id.</li>
  <li>getName() - Returns product's name.</li>
  <li>getCode() - Returns product's code.</li>
  <li>getSlug() - Returns product's slug.</li>
  <li>getDescription() - Returns product's description.</li>
  <li>getStatus() - Returns product's status.</li>
  <li>getShowSize() - Returns product's showSize. If product has one size showSize = 0, if product has more than one size showSize = 1.</li>
  <li>getPage() - Returns product's page.</li>
  <li>getCategory() - Returns product's category.</li>
  <li>getSubCategory() - Returns product's subcategory.</li>
  <li>getCategory() - Returns product's category.</li>
  <li>getDiscount() - Returns product's discount.</li>
  <li>getPrice() - Returns product's price.</li>
  <li>getDiscountedPrice() - Returns product's discountedPrice.</li>
  <li>getImage1() - Returns product's image1.</li>
  <li>getImage2() - Returns product's image2.</li>
  <li>getImage2() - Returns product's image3.</li>
  <li>getUploadDate() - Returns product's uploadDate.</li>
</ul>
