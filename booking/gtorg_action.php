<?
	$email = <<<HTML
		Organization name: {$_POST['orgname']}
		<br />
		Contact name: {$_POST['contactname']}
		<br />
		Email address: {$_POST['email']}
		<br />
HTML;

	if( $_POST['phone'] )
		$email .= "Contact number: {$_POST['phone']}<br />";

	$email .= <<<HTML
		Date requested: {$_POST['date']}
		<br />
		Start time: {$_POST['start']}
		<br />
		End time: {$_POST['end']}
		<br />
		Description of event: {$_POST['description']}
		<br />
		Expected number of attendees: {$_POST['attendees']}
		<br />
HTML;

	if( $_POST['comments'] )
		$email .= "Additional comments: {$_POST['comments']}";

	$mailed = mail(
		EMAIL_BOOKING,
		'[GT Organization] Booking Request',
		$email,
		'From: ' . EMAIL_WEBMASTER . "\r\nContent-type: text/html\r\n"
	);

	if( $mailed )
	{
		global $subroot;

		$message1 = 'Booking request sent!';
		$message2 = "We'll get back to you within a few days.";
		$redirect = "$subroot/index.php";
	}
	else
	{
		$message1 = 'Booking request not sent!';
		$message2 = 'Returning to form page...';
		$redirect = 'gtorg.php';
	}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Under the Couch - Submitting Booking Form...</title>
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
			</article>
			<br />
		</div>

		<? ui_insert( 'footer' ); ?>
	</div>
</body>
</html>
