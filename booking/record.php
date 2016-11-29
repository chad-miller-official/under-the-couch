<?
	db_include( 'get_officer_email' );
	$email = get_officer_email(ROLE_EQUIPMENT_MANAGER);
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Recording</title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />

		<?
            js_common_include();
            js_include( 'validate_lib.js' );
		?>

        <script src="/booking/js/record.js"></script>
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<div class="container">
			<? ui_insert( 'sidebar' ); ?>

			<div class="primary">
				<article>
					<h1>Recording</h1>
					Under the Couch has a newly built studio.
					<br />
					<br />
					Hourly Rates:
					<br />
					<ul>
						<li>$10/hr (Paid to Musician’s Network)</li>
						<li>+ Sound engineer rate ($10/hr minimum)</li>
						<li>[+ An assistant engineer will also be required for large tracking sessions]</li>
					</ul>
					<form method="post" id="record_booking_form" action="/">
						<fieldset>
							<p>
								<label class="nowidth" for="contactname">*Contact Name:</label>
								<input class="textbox" type="text" name="contact_name"
									id="contact_name" placeholder="First Last">
							</p>
							<p>
								<label class="nowidth" for="email">*Email Address:</label>
								<input class="textbox" type="text" name="email"
									id="email" placeholder="you@example.com">
							</p>
							<p>
								<label class="nowidth" for="number">Contact Phone Number:</label>
								<input class="textbox" type="tel" name="phone"
									id="phone" placeholder="(xxx)-xxx-xxxx">
							</p>
							<p>
								<label class="nowidth" for="date">*Date Requested:</label>
								<input class="textbox" type="date" name="date" id="date">
							</p>
							<p>
								<label class="nowidth" for="comments">Additional comments:</label>
								<br>
								<font size="3">(Please explain the type of recording you want - number of songs, instruments, etc.)</font>
								<br>
								<br>
								<textarea name="comments" id="comments"></textarea>
							</p>
							<input type="submit" class="submit-button"></input>
						</fieldset>
					</form>

					<br />

					Required fields are marked with "*".
					<br />
					<br />
					The above form is the standard for recording at Under the Couch, but the equipment manager may be emailed
					directly at <a href="mailto:<?= $email ?>"><?= $email ?></a>. Please have your email title begin
					with "[UTC Recording]" and include as much of the above information as possible in the email.
				</article>
			</div>

			<? ui_insert( 'footer' ); ?>
		</div>
	</body>
</html>
