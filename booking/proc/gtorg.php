<?
	lib_include( 'email_lib ');

	$phone    = $_POST['phone']    ?: 'N/A';
	$comments = $_POST['comments'] ?: 'N/A';

	$email = <<<HTML
<html>
	<head>
		<title>GT Org Request</title>
	</head>
	<body>
		Organization name: {$_POST['orgname']}
		<br />
		Contact name: {$_POST['contactname']}
		<br />
		Email address: {$_POST['email']}
		<br />
		Contact number: $phone
		<br />
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
		Additional comments: $comments
	</body>
</html>
HTML;

	$to      = EMAIL_BOOKING;
	$subject = '[GT Organization] Booking Request';
	$mailed  = send_html_email( $to, $subject, $email );

	if( $mailed )
	{
		$message1 = 'Booking request sent!';
		$message2 = "We'll get back to you within a few days.";
		$redirect = "/index.php";
	}
	else
	{
		$message1 = 'Booking request not sent!';
		$message2 = 'Returning to form page...';
		$redirect = '../gtorg.php';
	}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Under the Couch - Submitting Booking Form...</title>
	<link rel="stylesheet" type="text/css" href="/styles.css" />
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
