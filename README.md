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
<pre>
<code>
  $user = new User();
  $user->setUsername = "username";
  $user->setName = "Name";
  $user->setSurname = "Surname";
  $user->setPassword = "passw0rd";
  $user->setStatus = User;
  $user->setMail = "user@mail.com";
  $user->setPhone = "(123) 456 - 7890";
  $user->setIdentity = "11111111111";
  $user->setBirthDate = "YYYY-MM-DD";
  if ($user->register())
    #do something
</code>
</pre>
<h3 align="left">Login</h3>
<pre>
<code>
  $userForLogin = new User();
  if ($userForLogin->login('username', 'passw0rd'))
    echo $userForLogin->getID();
</code>
</pre>
<h3 align="left">Load</h3>
<pre>
<code>
  $userID = 14;
  $user = new User();
  $user->load($userID);
  echo $user->getName();
</code>
</pre>
<h3 align="left">Load With Username</h3>
<pre>
<code>
  $user = new User();
  $user->loadUserWithUsername('username');
  echo $user->getMail();</li>
</code>
</pre>
<h3 align="left">Save</h3>
<pre>
<code>
  $user = new User();
  $user->load(28);
  $user->setName = "NewName";
  $user->setSurname = "NewSurname";
  if($user->validateInputs())
    if($user->save())
      #do something
</code>
</pre>
<pre>
<code>
  $anotherUser = new User();
  $anotherUser->load(29);
  $anotherUser->setUsername = "newUsername";
  $anotherUser->setMail = "new@mail.com";
  if($anotherUser->validateInputs())
    $anotherUser->save();
  echo $anotherUser->getUsername();
  echo $anotherUser->getMail();
</code>
</pre>
<pre>
<code>
  $user2 = new User();
  $user2->load(29);
  $user2->setIdentity = "11111111111";
  if($user2->validateInputs() && $user2->validateIdentity())
    $user2->save();
  echo $user2->getIdentity();
</code>
</pre>
<h3 align="left">Delete</h3>
<pre>
<code>
  $user = new User();
  $user->load(8);
  if ($user->delete())
    echo 'user deleted.';
</code>
</pre>
<h3 align="left">Change Password</h3>
<pre>
<code>
  $user = new User();
  $user->load(12);
  $user->setPassword = "newPassw0rd";
  $user->setPasswordCheck = "newPassw0rd";
  $user->oldPassword = "passw0rd";
  if($user->changePassword())
    #do something
</code>
</pre>
<h3 align="left">Change Address</h3>
<pre>
<code>
  $user = new User();
  $user->load(17);
  $user->setCity = 34;
  $user->setFullAddress = "Full address here";
  if($user->changeAddress())
    #do something
</code>
</pre>
<h3 align="left">Get Users With Search</h3>
<pre>
<code>
  $userID = 24;
  $userClass = new User();
  $searchResult =$userClass->getUsersWithSearch('userna');
  //print_r($searchResult);
  if (isset($searchResult[$userID]))
    echo $searchResult[$userID]->getName();
</code>
</pre>
<h3 align="left">Get All Users</h3>
<pre>
<code>
  $userClass = new User();
  $allUsers = $userClass->getAllUsers();
  print_r($allUsers);<br>
  $firstUserID = 15;
  print_r($allUsers[$firstUserID]);<br>
  $secondUserID = 16;
  echo $allUsers[$secondUserID]->getUsername();
</code>
</pre>
<h3 align="left">Set user data in array</h3>
<pre>
<code>
  $userClass = new User();
  $allUsers = $userClass->getAllUsers();
  $allUsers[22]->setUsername = "youcansetuservalues";
  if($allUsers[22]->validateInputs() && $allUsers[22]->validateIdentity())
    $allUsers[22]->save();
  echo $allUsers[22]->getUsername();
</code>
</pre>
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
<pre>
<code>
  $product = new Product();
  $product->setName = 'Best Product';
  $product->setDescription = 'test desc';
  $product->setCode = $product->generateProductCode('TST');
  $product->setSlug = $product->createSlug($product->setName . '-' . $product->setCode);
  $product->setStatus = 0;
  $product->setShowSize = 0;
  $product->setPage = '1';
  $product->setCategory = '2';
  $product->setSubCategory = '3';
  $product->setPrice = '14.99';
  $product->setDiscount = '0';
  $product->setDiscountedPrice = '14.99';
  $product->setImage1 = 'image1.jpg';
  $product->setImage2 = 'image2.jpg';
  $product->setImage3 = 'image3.jpg';
  $productID = $product->create(); //returns lastInsertId when successfully insert
  if ($productID)
    #do something
</code>
</pre>
<h3 align="left">Load</h3>
<pre>
<code>
  $productID = 135;
  $product = new Product();
  $product->load($userID);
  echo $product->getName();
</code>
</pre>
<h3 align="left">Load With Url</h3>
<pre>
<code>
  $slug = "basic-oversize-t-shirt-bs-859728";
  $product = new Product();
  $product->loadWithUrl($slug);
  echo $product->getPrice();
</code>
</pre>
<h3 align="left">Save</h3>
<pre>
<code>
  $product = new Product();
  $product->load(11129);
  $product->setName = 'New Product Name';
  $product->setSlug = $product->createSlug($product->setName . '-' . $product->setCode);
  $product->save();
</code>
</pre>
<h3 align="left">Delete</h3>
<pre>
<code>
  $product = new Product();
  $product->load(82354);
  if ($product->delete())
    echo 'product deleted.';
</code>
</pre>
<h3 align="left">Get Products With Search</h3>
<pre>
<code>
  $productClass = new Product();
  $searchResult = $productClass->getProductsWithSearch('t-shirt');
  print_r($searchResult);
</code>
</pre>
<h3 align="left">Get All Products</h3>
<pre>
<code>
  $productClass = new Product();
  $allProducts = $productClass->getAllProducts();
  print_r($allProducts);<br>
  $firstProductID = 1234;
  print_r($allProducts[$firstProductID]);<br>
  $secondProductID = 9876;
  echo $allProducts[$secondProductID]->getPrice();
</code>
</pre>

<h3 align="left">Set product data in array</h3>
<pre>
<code>
  $productClass = new Product();
  $allProducts = $productClass->getAllProducts();
  $allProducts[11126]->setName = "youcansetproductvalues";
  $allProducts[11126]->setSlug = $allProducts[11126]->createSlug($allProducts[11126]->setName . '-' . $allProducts[11126]->setCode);
  $allProducts[11126]->save();
  echo $allProducts[11126]->getSlug();
</code>
</pre>

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
