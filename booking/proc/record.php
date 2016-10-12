<?
	lib_include( 'email_lib' );

	$phone    = $_POST['phone']    ?: 'N/A';
	$comments = $_POST['comments'] ?: 'N/A';

	$email = <<<HTML
<html>
	<head>
		<title>Booking Request</title>
	</head>
	<body>
		Contact name: {$_POST['contactname']}
		<br />
		Email address: {$_POST['email']}
		<br />
		Contact number: $phone
		<br />
		Date requested: {$_POST['date']}
		<br />
		Additional comments: $comments
	</body>
</html>
HTML;

	$to      = EMAIL_BOOKING;
	$subject = '[UTC Recording] Recording Request';
	$mailed  = send_html_email( $to, $subject, $email );

	if( $mailed )
	{
		$message1 = 'Recording request sent!';
		$message2 = "We'll get back to you in a few days.";
		$redirect = "/index.php";
	}
	else
	{
		$message1 = 'Recording request not sent!';
		$message2 = 'Redirecting to form page...';
		$redirect = '/booking/record.php';
	}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Under the Couch - Submitting Recording Form...</title>
	<link rel="stylesheet" type="text/css" href="/styles.css">
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
