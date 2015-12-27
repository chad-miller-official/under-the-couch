<?
	$email = <<<HTML
		Contact name: {$_POST['contactname']}
		<br />
		Email address: {$_POST['email']}
		<br />
HTML;

	if($_POST['phone'])
		$email .= "Contact number: {$_POST['phone']}<br />";

	$email .= "Date requested: {$_POST['date']}<br />";

	if($_POST['comments'])
		$email .= "Additional comments: {$_POST['comments']}";

	$mailed = mail(
		EMAIL_BOOKING,
		'[UTC Booking] Booking Request',
		$email,
		'From: ' . EMAIL_WEBMASTER . "\r\nContent-type: text/html\r\n"
	);

	if( $mailed )
	{
		global $subroot;

		$message1 = 'Recording request sent!';
		$message2 = "We'll get back to you in a few days.";
		$redirect = "$subroot/index.php";
	}
	else
	{
		$message1 = 'Recording request not sent!';
		$message2 = 'Redirecting to form page...';
		$redirect = 'record.php';
	}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Under the Couch - Submitting Recording Form...</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
	<meta http-equiv="refresh" content="3;url=<?= $redirect ?>" />
</head>

<body>
	<? ui_insert( 'header' ); ?>

	<div class="container">
		<? ui_insert( 'sidebar' ); ?>

		<div class="primary">
			<article>
				<h1> <?= $message1 ?> </h1>
				<?= $message2 ?>
				<br />
			</article>
		</div>

		<? ui_insert( 'footer' ); ?>
	</div>
</body>
</html>
