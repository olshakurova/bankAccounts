<?php 
require_once 'Account.php';
session_start();

if (isset($_SESSION["account"])) {
	$bankAccount = $_SESSION["account"];
}
else {
	$bankAccount = new Account();
}

/*Tyhjennetään istuntomuuttujat palvelimelta
$_SESSION = array(); 

if (isset($_COOKIE[session_name()])) 
// Poistetaan istunnon tunniste käyttäjän koneelta
    setcookie(session_name(), '', time()-100, '/');  
    
session_destroy(); */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="author" content="OS">
<meta name="description" content="Bank account is an attempt to use PHP">
<meta name="keywords" content="">

<title>Account data</title>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link rel="stylesheet" href="styles/styles.css" type="text/css">

</head>
<body>
<div id="container">

<header>
<h1>Bank Accounts</h1>
</header>

<section>

<nav>
<div class="nav1">
<ul>
<li><a href="index.php">Main</a></li>
<li><a href="uusi.php">Add</a></li>
<li><a href="listaa.php">List</a></li>
<li><a href="haku.php">Search</a></li>
<li><a href="poista.php">Delete</a></li>
</ul>
</div>
</nav>



<div class="content">
<h1>You inserted the following information:</h1>                     
<fieldset>
<legend>Bank Account</legend>
<form action="uusi.php" method="post">
<table>
<tr>
<td>Customer Number:</td>
<td><?php print($bankAccount -> getCustomerNumber()) ?></td>
</tr>
<tr>
<td>Name:</td>
<td><?php print($bankAccount -> getName()) ?></td>
</tr>
<tr>
<td>SSN:</td>
<td><?php print($bankAccount -> getSsn()) ?></td>
</tr>
<tr>
<td>Gender:</td>
<td><?php print($bankAccount -> getGender()) ?></td>
</tr>
<tr>
<td>Account number:</td>
<td><?php print($bankAccount -> getAccountNumber()) ?></td>
</tr>
<tr>
<td>Balance:</td>
<td><?php print($bankAccount -> getBalance()) ?></td>
</tr>
<tr>
<td>Account Type:</td>
<td><?php print($bankAccount -> getType()) ?></td>
</tr>
<tr>
<td>Info:</td>
<td><?php print($bankAccount -> getInfo()) ?></td>
</tr>
</table>
 <br />
 <input type="submit" name="edit" value="Edit" />
 <input type="submit" name="save" value="Save" />
 <input type="submit" name="cancel" value="Cancel" />
</form>
</fieldset>
</div>
</section>

<footer>
<p>Olga Shakurova<br>
   2013 v1.0</p>
</footer>
</div>
</body>
</html>