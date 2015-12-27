<?
	$status  = logout();
	$message = $status ? 'Successfully logged out!' : 'You are not logged in!';
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Logged Out</title>
		<meta http-equiv="refresh" content="3;url=index.php" />
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<center><h1> <?= $message ?> </h1></center>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
