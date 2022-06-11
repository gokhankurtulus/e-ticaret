# Class structure and usage examples for e-commerce

<h3 align="left">Languages and Tools:</h3>
<p align="left"> <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="javascript" width="40" height="40"/> </a> <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/> </a> <a href="https://www.php.net" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40"/> </a> </p>

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
  <li>if($user->save())</li>
  <li>#do something</li>
  <br>
  <li>$anotherUser = new User();</li>
  <li>$anotherUser->load(29);</li>
  <li>$anotherUser->setMail = "new@mail.com";</li>
  <li>$anotherUser->save();</li>
  <li>echo $anotherUser->getMail();</li>
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
  <li>echo $allUsers[22]->getUsername();</li>
  <li>$allUsers[22]->setUsername = "youcansetuservalues";</li>
  <li>$allUsers[22]->save();</li>
  <li>echo $allUsers[22]->getUsername();</li>
</ul>
