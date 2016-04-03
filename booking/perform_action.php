<?
	lib_include( 'email_lib' );

	$phone    = $_POST['phone']    ?: 'N/A';
	$style    = $_POST['style']    ?: 'N/A';
	$website  = $_POST['website']  ?: 'N/A';
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
		Band name: {$_POST['bandname']}
		<br />
		Date requested: {$_POST['date']}
		<br />
		Style of music: $style
		<br />
		Website: $website
		<br />
		Additional comments: $comments
	</body>
</html>
HTML;

	$to      = EMAIL_BOOKING;
	$subject = '[UTC Booking] Booking Request';
	$mailed  = send_html_email( $to, $subject, $email );

	if( $mailed )
	{
		$message1 = 'Booking request sent!';
		$message2 = "If we're able to book you, we'll get back to you within a few days.";
		$redirect = "/index.php";
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
