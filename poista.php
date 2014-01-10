<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="author" content="OS">
<meta name="description" content="Bank account is an attempt to use PHP">
<meta name="keywords" content="">

<title>Accounts</title>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link rel="stylesheet" href="styles/styles.css" type="text/css">

</head>
<body>
	<div id="container">

		<header>
			<h1>Acounts</h1>
		</header>

		<section>

			<nav>
				<div class="nav1">
					<ul>
						<li><a href="index.php">Main</a></li>
						<li><a href="uusi.php">Add</a></li>
						<li><a href="listaa.php">List</a></li>
						<li><a href="haku.php">Search</a></li>
						<li id="active"><a href="poista.php">Delete</a></li>
					</ul>
				</div>
			</nav>



			<div class="content">
				<h1>Delete Account</h1>
				<table>
					<tr>
						<td class="right"><?php

						try
						{
							require_once "accountPDO.php";
							$kantakasittely = new accountPDO();
							if (isset($_POST["poista"])) {
								$id=$_POST["id"];
								print("<p>Account sucessfully deleted.</p>");
								$kantakasittely->deleteAccount($id);

								$rivit = $kantakasittely->allAccounts();
								foreach ($rivit as $account) {
									$idToDelete = $account->getId();
									print("<tr><td>");
									print("<tr><td>");
									print("<p>Account number: " . $account->getAccountNumber());
									print("<br>Name: " . $account->getName());
									print("<br>Balance: " . $account->getBalance());
									print("</td><td>");
									print("<form method='post' action='' id='form'>");
									print("<input type='hidden' name='id' value='" . $idToDelete . "'>");
									print("<br><input type='submit' name='poista' value='Delete'></p>\n");
									print("</form></tr>");
								}

							}
							else{
								$rivit = $kantakasittely->allAccounts();
									
								foreach ($rivit as $account) {
									$idToDelete = $account->getId();
									print("<tr><td>");
									print("<p>Account number: " . $account->getAccountNumber());
									print("<br>Name: " . $account->getName());
									print("<br>Balance: " . $account->getBalance());
									print("</td><td>");
									print("<form method='post' action='' id='form'>");
									print("<input type='hidden' name='id' value='" . $idToDelete . "'>");
									print("<br><input type='submit' name='poista' value='Delete'></p>\n");
									print("</form></tr>");
								}
							}
						} catch (Exception $error) {
							print($error->getMessage());
							//header("location: virhe.php?virhe=" . $error->getMessage());
							exit;
						}

						?></td>
					</tr>
				</table>
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
