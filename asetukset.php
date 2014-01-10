<?php 
if(isset($_POST["muuta"]))
{
	$name = $_POST["nimi"];
	//setcookie(keksin_nimi, keksin_arvo, keksin_kestoaika, polku, toimialue, salaus);
	setcookie("cookiename", $name, time() + (60*60*24*7)); 
	header("location: index.php");
	exit;
}

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="author" content="OS">
<meta name="description" content="Bank account is an attempt to use PHP">
<meta name="keywords" content="">

<title>Bank Accounts</title>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link rel="stylesheet" href="styles/styles.css" type="text/css">

</head>
<body>
<div id="container">

<header>
<h1>Settings</h1>
</header>

<section>

<nav>
<div class="nav1">
<ul>
<li id="active"><a href="index.php">Main</a></li>
<li><a href="uusi.php">Add</a></li>
<li><a href="listaa.php">List</a></li>
<li><a href="haku.php">Search</a></li>
<li><a href="poista.php">Delete</a></li>
</ul>
</div>
</nav>



<div class="content">
<h1>Accounts</h1>
<img src="images/bank.jpg" alt="Bank" id="Bankimage">
<form action="" method="post">
<table>
<tr>
<td>Enter Your Name:</td>
<td><input type="text" id="name" 
name="nimi" value="<?php 
if (isset($_COOKIE["cookiename"])){
print(htmlentities($_COOKIE["cookiename"], ENT_QUOTES, "UTF-8"));
}
?>"> </td>
<td><input type="submit" name="muuta" value="Change Name" /></td>
</tr>
</table>
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