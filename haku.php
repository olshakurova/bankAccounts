<?php

require_once "account.php";
$searchSigns="";
if (isset($_POST["haku"])) {
	$searchSigns=$_POST["searchParameter"];
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
						<li><a href="uusi.php">Add</a></li>
						<li><a href="listaa.php">List</a></li>
						<li id="active"><a href="haku.php">Search</a></li>
						<li><a href="poista.php">Delete</a></li>
					</ul>
				</div>
			</nav>



			<div class="content">
				<h1>Search Account</h1>
				<form method="post" action="" id="form">
					<fieldset>
						<table>
							<tr>
								<td><label for="customerNumber">Account Number:</label>
								</td>
								<td><input type="search" id="searchParameter"
									name="searchParameter"
									value="<?php print(htmlentities($searchSigns, ENT_QUOTES, "UTF-8"));?>">
								</td>
								<td><input type="submit" name="haku" value="Search" />
								</td>
							</tr>
						</table>
					</fieldset>
					<fieldset>
						<legend>Search Results</legend>
						<table>
							<tr>
								<td class="right"><?php
								try
								{
									require_once "accountPDO.php";
									if($searchSigns != "")
									{
										$kantakasittely = new accountPDO();
										$rivit = $kantakasittely->findAccounts($searchSigns);
										if($rivit== NULL){
											print("<p>No matches found.</p>");
										}
										else{
											$searchFormWords="";
											foreach ($rivit as $account) {
												print("<p>Account number: " . $account->getAccountNumber());
												print("<br>Balance: " . $account->getBalance());
												print("<br>Account type: " . $account->getType());
												print("<br>Customer Number: " . $account->getCustomerNumber());
												print("<br>Name: " . $account->getName());
												print("<br>SSN: " . $account->getSsn());
												print("<br>Gender: " . $account->getGender());
												print("<br>Additional information: " . $account->getInfo() . "</p>\n");
											}
										}
									}   }
									catch (Exception $error) {
										print($error->getMessage());
										//header("location: virhe.php?virhe=" . $error->getMessage());
	 exit;
}

?>
								</td>
							</tr>
						</table>
					</fieldset>
				</form>
			</div>
		</section>

		<footer>
			<p>
				Olga Shakurova<br> 2013 v1.0
			</p>
		</footer>
	</div>
</body>
</html>
