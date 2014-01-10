
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
						<li id="active"><a href="listaa.php">List</a></li>
						<li><a href="haku.php">Search</a></li>
						<li><a href="poista.php">Delete</a></li>
					</ul>
				</div>
			</nav>



			<div>
				<h1>List of Accounts</h1>
				<div id="list">
				<table>
					<tr>
					<th>Account Number</th>
					<th>Customer Name</th>
					<th>Balance</th>
					<th>Account Type</th>
					<th>Customer Number</th>
					<th>SSN</th>
					<th>Gender</th>
					<th>Additional information</th>
					</tr>
						<?php
						try
						{
							require_once "accountPDO.php";

							$kantakasittely = new accountPDO();

							$rivit = $kantakasittely->allAccounts();

							foreach ($rivit as $account) {
								print("<tr>");
								print("<td>" . $account->getAccountNumber());
								print("</td><td>" . $account->getName());
								print("</td><td> " . $account->getBalance());
								print("</td><td>" . $account->getType());
								print("</td><td>" . $account->getCustomerNumber());
								print("</td><td>" . $account->getSsn());
								print("</td><td>" . $account->getGender());
								print("</td><td>" . $account->getInfo() . "</td></tr>");

							}
						} catch (Exception $error) {
							print($error->getMessage());
							//header("location: virhe.php?virhe=" . $error->getMessage());
							exit;
						}

						?>
				</table>
				</div>
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
