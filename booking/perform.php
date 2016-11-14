<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Performing</title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />

		<?
            js_common_include();
            js_include( 'ext/jquery-validation-1.15.1/dist/jquery.validate.min.js' );
        ?>

        <script src="/booking/js/perform.js"></script>
	</head>

	<body>
		<? ui_insert( 'header' ); ?>
		
		<div class="container">
			<? ui_insert( 'sidebar' ); ?>

			<div class="primary">
				<article>
					Bands and promoters should fill out the form below to book the venue. We will read every email, but if we do
					not respond to you, that means we cannot fit you into our schedule at the present time.
					<br /><br />
					<form method="post" id="perform_booking_form" action="/">
						<fieldset>
							<legend>Booking Form</legend>
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
								<label class="nowidth" for="bandname">*Band Name:</label>
								<br />
								<input class="textbox" type="text" name="band_name" id="band_name">
							</p>
							<p>
								<label class="nowidth" for="date">*Date Requested:</label>
								<br />
								<input class="textbox" type="date" name="date" id="date">
							</p>
							<p>
								<label class="nowidth" for="style">Style of Music:</label>
								<br />
								<input class="textbox" type="text" name="style" id="style">
							</p>
							<p>
								<label class="nowidth" for="website">Website:</label>
								<br />
								<input class="textbox" type="text" name="website" id="website">
							</p>
							<p>
								<label class="nowidth" for="comments">Additional comments:</label>
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
					The above form is the standard for booking shows, but the booking agent may be emailed directly at
					<a href="mailto:<?= EMAIL_BOOKING ?>"><?= EMAIL_BOOKING ?></a>. Please have your email title begin
					with "[UTC Booking]" and include as much of the above information as possible in the email.
				</article>
			</div>

			<? ui_insert( 'footer' ); ?>
		</div>
	</body>
</html>
