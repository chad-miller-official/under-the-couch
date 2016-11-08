<?
	db_include( 'get_equipment_manager_email' );
	$email = get_equipment_manager_email();
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Recording</title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />

		<?
            js_common_include();
            js_include( 'ext/jquery-validation-1.15.1/dist/jquery.validate.min.js' );
		?>

        <script src="/booking/js/record.js"></script>
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<div class="container">
			<? ui_insert( 'sidebar' ); ?>

			<div class="primary">
				<article>
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
							<legend>Recording Form</legend>
							<p>
								<label class="nowidth" for="contactname">*Contact Name:</label>
								<br />
								<input class="textbox" type="text" name="contact_name" id="contact_name">
							</p>
							<p>
								<label class="nowidth" for="email">*Email Address:</label>
								<br />
								<input class="textbox" type="text" name="email" id="email">
							</p>
							<p>
								<label class="nowidth" for="number">Contact Phone Number:</label>
								<br />
								<input class="textbox" type="tel" name="phone" id="phone">
							</p>
							<p>
								<label class="nowidth" for="date">*Date Requested:</label>
								<br />
								<input class="textbox" type="date" name="date" id="date">
							</p>
							<p>
								<label class="nowidth" for="comments">Additional comments:</label>
								<br />
								<font size="2">(Please explain the type of recording you want - number of songs, instruments, etc.)</font>
								<br />
								<textarea name="comments" id="comments"></textarea>
							</p>
							<input type="submit">
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
