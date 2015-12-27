<?
	$email = <<<HTML
		Contact name: {$_POST['contactname']}
		<br />
		Email address: {$_POST['email']}
		<br />
HTML;

	if($_POST['phone'])
		$email .= "Contact number: {$_POST['phone']}<br />";

	$email = <<<HTML
		Band name: {$_POST['bandname']}
		<br />
		Date requested: {$_POST['date']}
		<br />
HTML;

	if($_POST['style'])
		$email .= "Style of music: {$_POST['style']}<br />";

	if($_POST['website'])
		$email .= "Website: {$_POST['website']}<br />";

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
		
		$message1 = 'Booking request sent!';
		$message2 = "If we're able to book you, we'll get back to you within a few days.";
		$redirect = "$subroot/index.php";
	}
	else
	{
		$message1 = 'Booking request not sent!';
		$message2 = 'Redirecting to form page...';
		$redirect = 'perform.php';
	}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Under the Couch - Submitting Performance Form...</title>
	<link rel="stylesheet" type="text/css" href="../styles.css" />
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
