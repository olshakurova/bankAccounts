<?php 

require_once "account.php";
session_start();
  $male_status ="unchecked";
  $female_status ="unchecked";
  $genderIsSet = "";
  // submit button
if (isset($_POST["submit"])) {
	if(isset($_POST["gender"])){
		$genderIsSet = $_POST["gender"];
	}
  $account = new Account($_POST["customerNumber"], $_POST["name"], $_POST["ssn"], $genderIsSet, $_POST["accountNumber"], $_POST["balance"], $_POST["accountType"], $_POST["info"]);          
  //if (!isset($_SESSION["account"]))
  $_SESSION["account"] = $account;
  session_write_close();
  $nameMistake = $account->checkName();
  $customerNumberMistake = $account->checkCustomerAccountNumber($account->getCustomerNumber());
  $ssnMistake = $account->checkSsn();
  $selected_radio = $account->getGender();
	if ($selected_radio == "male")
		$male_status ="checked";
	elseif ($selected_radio == "female")
		$female_status = "checked";
	$genderMistake = $account->checkGender($male_status, $female_status);
	$accountNumberMistake = $account->checkCustomerAccountNumber($account->getAccountNumber());
	$balanceMistake = $account->checkBalance();
	$accountTypeMistake = $account->checkTypeAccount();
	$infoMistake = $account->checkInfo();
	
	if ($nameMistake == 0 && $customerNumberMistake == 0 && $ssnMistake == 0 && $genderMistake == 0
	&& $accountNumberMistake == 0 && $balanceMistake == 0 && $accountTypeMistake == 0
	&& $infoMistake == 0) {
	  	header("location: nayttoSivu.php");
	  	exit;
	  }
	
}
elseif (isset($_POST["cancel"])) {
	header("location: index.php");
	exit;
	if (isset($_SESSION["account"])){
	$_SESSION = array(); 
	
	if (isset($_COOKIE[session_name()])) 
	setcookie(session_name(), '', time()-100, '/');    
	session_destroy();
	}

} 
// from another page
else{
	$nameMistake = 0;
   $customerNumberMistake = 0;
   $ssnMistake = 0;
   $genderMistake = 0;
   $accountNumberMistake = 0;
   $balanceMistake = 0;
   $accountTypeMistake = 0;
   $infoMistake = 0;  
   
	if (isset($_SESSION["account"])){
	if (isset($_POST["edit"])){
			$account = $_SESSION["account"];
			$selected_radio = $account->getGender();
				if ($selected_radio == "male")
					$male_status ="checked";
				elseif ($selected_radio == "female")
					$female_status = "checked";
	}
	else if(isset($_POST["save"])){
	try
		{
		   require_once "accountPDO.php";
		   
		   $kantakasittely = new accountPDO();
		
		   $account = $kantakasittely->addAccount($_SESSION["account"]);
		   	header("location: talletettu.php");
	  		exit;

		} catch (Exception $error) {
			 print($error->getMessage());
			 //header("location: virhe.php?virhe=" . $error->getMessage());
			 exit;
		}
		}
	$_SESSION = array(); 
	
	if (isset($_COOKIE[session_name()])) 
	    setcookie(session_name(), '', time()-100, '/');    
	session_destroy(); 
}
	else {
   	$account = new Account();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="author" content="OS">
<meta name="description" content="Bank account is an attempt to use PHP">
<meta name="keywords" content="">

<title>Add account</title>

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
<li id="active"><a href="uusi.php">Add</a></li>
<li><a href="listaa.php">List</a></li>
<li><a href="haku.php">Search</a></li>
<li><a href="poista.php">Delete</a></li>
</ul>
</div>
</nav>



<div class="content">
<h1>Add New Account </h1>                     
<form method="post" action="" id="form">
<fieldset>
<legend>Customer information</legend>
<table>

<tr>
<td>
<label for="customerNumber">Customer number:</label>
</td>
<td>
<input type="text" id="customerNumber" name="customerNumber" value="<?php print(htmlentities($account->getCustomerNumber(), ENT_QUOTES, "UTF-8"));?>">
</td>
<td>
<?php 
print("<span class='err'>" . $account->showMistake($customerNumberMistake) . "</span>");
?> 
</td>


</tr>

<tr>
<td>
<label for="name">Name:</label>
</td>
<td>
<input type="text" id="name" name="name" value="<?php print(htmlentities($account->getName(), ENT_QUOTES, "UTF-8"));?>">
</td>
<td>
<?php 
print("<span class='err'>" . $account->showMistake($nameMistake) . "</span>");
?> 
</td>
</tr>

<tr>
<td>
<label for="ssn">SSN:</label>
</td>
<td>
<input type="text" id="ssn"  name="ssn" value="<?php print(htmlentities($account->getSsn(), ENT_QUOTES, "UTF-8"));?>">
</td>
<td>
<?php 
print("<span class='err'>" . $account->showMistake($ssnMistake) . "</span>");
?> 
</td>
</tr>
</table>
<input type="radio" id="male" name="gender" value="male" <?php if ($male_status == "checked") echo "checked";?>>
<label for="male">Male</label>
<input type="radio" id="female" name="gender" value="female" <?php if ($female_status == "checked") echo "checked";?>>
<label for="female">Female</label>

<?php 
print("<span class='err'>" . $account->showMistake($genderMistake) . "</span>");
?>

</fieldset>
<fieldset>
<legend>Account information</legend>
<table>

<tr>
<td>
<label for="accountNumber">Account number:</label>
</td>
<td>
<input type="text" id="accountNumber"  name="accountNumber"  value="<?php print(htmlentities($account->getAccountNumber(), ENT_QUOTES, "UTF-8"));?>">
</td>
<td>
<?php 
print("<span class='err'>" . $account->showMistake($accountNumberMistake) . "</span>");
?> 
</td>
</tr>

<tr>
<td>
<label for="balance">Balance:</label>
</td>
<td>
<input type="text" id="balance" name="balance" value="<?php print(htmlentities($account->getBalance(), ENT_QUOTES, "UTF-8"));?>"> 
</td>
<td>
<?php 
print("<span class='err'>" . $account->showMistake($balanceMistake) . "</span>");
?> 
</td>
</tr>

<tr>
<td>
<label for="type">Account type:</label>
</td>
<td>
<select id="type" name="accountType">
<option value="0" id="0">Choose</option>
<option value="1" id="1" <?php if ($account->getType() == "1") echo "selected='selected'";?>>1</option>
<option value="3" id="3" <?php if ($account->getType() == "3") echo "selected='selected'";?>>3</option>
<option value="5" id="5" <?php if ($account->getType() == "5") echo "selected='selected'";?>>5</option>
</select>
</td>
<td>
<?php 
print("<span class='err'>" . $account->showMistake($accountTypeMistake) . "</span>");
?> 
</td>
</tr>

<tr>
<td>
<label for="additionalInfo">Additional:</label>
</td>
<td>
 <textarea id="additionalInfo" name = "info"><?php print(htmlentities($account->getInfo(), ENT_QUOTES, "UTF-8"));?></textarea>
</td>
<td><?php 
print("<span class='err'>" . $account->showMistake($infoMistake) . "</span>");
?> </td>
</tr>
</table>
</fieldset>
<p>
<input type="submit" value="Submit" name="submit">
<input type="submit" value="Cancel" name="cancel"> 
</p>
</form>

</div>
</section>

<footer>
<p>Olga Shakurova<br>
   2013 v1.0</p>
</footer>
</div>
</body>
</html>