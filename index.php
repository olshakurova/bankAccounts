
<?php 
if (isset($_COOKIE["cookiename"])){	
	$name = "Tervetuloa " . $_COOKIE["cookiename"] . "!";
}
else
	$name="";

?>
<!DOCTYPE html>
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
<table style="width:100%">
<tr>
<td><a href="asetukset.php">
<img src="images/settings.png" alt="Settings" id="settingsImage"></a></td>
<td><h1>Bank Accounts</h1></td>
<tr>
</table>
</header>

<section>

<nav>
<div class="nav1">
<ul>
<li id="active"><a href="">Main</a></li>
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
<p>
 <?php print(htmlentities($name, ENT_QUOTES, "UTF-8"))
 ?>
</p>
Control all accounts with <strong>Bank Accounts</strong>!
</div>
</section>

<footer>
<p>Olga Shakurova<br>
   2013 v1.0</p>
</footer>
</div>
</body>
</html>