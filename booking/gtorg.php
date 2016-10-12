<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Under the Couch - Booking</title>
		<link rel="stylesheet" type="text/css" href="/styles.css">

		<?
			js_include(
				'jquery-2.1.1.min',
				'jquery-validation-1.13.0/jquery.validate.min'
			);
		?>
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<div class="container">
			<? ui_insert( 'sidebar' ); ?>

			<div class="primary">
				<article>
					This option is for Georgia Tech organizations wishing to use our space. It is required
					that at least two UTC sound engineers be present for the entirety of your event. Other
					event details will be handled on a case-by-case basis.
					<br />
					<br />
					Cash is the preferred payment option for sound engineers, but a check made out to the
					engineer is also acceptable. Payment must be made at the event.
					<br />
					<br />
					Sound Engineer Rates: $10/hour per engineer
					<br /><br />
					<form method="post" id="bookingform" action="/booking/proc/gtorg.php">
						<fieldset>
							<legend>Booking Form</legend>
							<p>
								<label class="nowidth" for="orgname">*Organization Name:</label>
								<br />
								<input class="textbox" type="text" name="orgname" id="orgname">
							</p>
							<p>
								<label class="nowidth" for="contactname">*Contact Name:</label>
								<br />
								<input class="textbox" type="text" name="contactname" id="contactname">
							</p>
							<p>
								<label class="nowidth" for="email">*Email Address:</label>
								<br />
								<input class="textbox" type="text" name="email" id="email">
							</p>
							<p>
								<label class="nowidth" for="number">Contact Phone Number:</label>
								<br />
								<input class="textbox" type="tel" name="phone">
							</p>
							<p>
								<label class="nowidth" for="date">*Date Requested:</label>
								<br />
								<input class="textbox" type="date" name="date" id="date">
							</p>
							<p>
								<label class="nowidth" for="start">*Start Time (including 30 minute setup time):</label>
								<br />
								<input class="textbox" type="time" name="start" id="start">
							</p>
							<p>
								<label class="nowidth" for="website">*End Time (including 30 minute teardown time):</label>
								<br />
								<input class="textbox" type="time" name="end" id="end">
							</p>
							<p>
								<label class="nowidth" for="description">*Description of Event:</label>
								<br />
								<input class="textbox" type="text" name="description" id="description">
							</p>
							<p>
								<label class="nowidth" for="attendees">*Expected Number of Attendees:</label>
								<br />
								<input class="textbox" type="number" name="attendees" id="attendees">
							</p>
							<p>
								<label class="nowidth" for="comments">Additional comments:</label>
								<br />
								<textarea name="comments"></textarea>
							</p>
							Required fields are marked with "*".
							<br />
							<br />
							<u><a href="usageaggrement.pdf">USAGE AGREEMENT</a></u>: What we expect from you:
							<ul>
								<li>
									You must clean up after the event; this includes taking trash out to the dumpster (do not
									put in student center trash cans)
								</li>
								<li>
									Please respect our equipment; you will be held responsible for any equipment that you damage
								</li>
								<li>
									If you wish for music to be played over the speakers during your event, you must bring your
									own device
								</li>
								<li>
									You are required to pay two Musician's Network workers $10/hour to help run your event
								</li>
							</ul>
							By clicking the submit button below, you agree to the terms of the usage agreement above.
							<br />
							<br />
							<input type="submit">
						</fieldset>
					</form>
					<br />
					<script>
						$( "#bookingform" ).validate( {
							rules : {
								orgname     : "required",
								contactname : "required",
								email       : {
									required : true,
									email    : true
								},
								date        : "required",
								start       : "required",
								end         : "required",
								description : "required",
								attendees   : "required"
							}
						} );
					</script>
					The above form is the standard for booking events, but the booking agent may be emailed directly at
					<a href="<?= EMAIL_BOOKING?>"><?= EMAIL_BOOKING ?></a>. Please have your email title begin
					with "[GT Organization]" and include as much of the above information as possible in the email. If you
					do not fill out the above form, please print and sign our <a href="usageagreement.pdf">Usage Agreement</a>
					and bring it to the event.
				</article>
			</div>

			<? ui_insert( 'footer' ); ?>
		</div>
	</body>
</html>
