<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Create Account</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />

		<?
			js_include(
				'jquery-2.1.1.min',
				'jquery-validation-1.13.0/jquery.validate.min'
			);
		?>
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<? if( !is_logged_in() ): ?>
			<form method="post" id="accountform" action="accountform_action.php">
				<fieldset>
					<legend>Create Account</legend>
					<p>
						<label for="firstname">First Name:</label>
						<input class="textbox" type="text" name="firstname" id="firstname" />
					</p>
					<p>
						<label for="lastname">Last Name:</label>
						<input class="textbox" type="text" name="lastname" id="lastname" />
					</p>
					<p>
						<label for="email">GATech Email:</label>
						<input class="textbox" type="text" name="email" id="email" />
					</p>
					<p>
						<label for="password">Password:</label>
						<input class="textbox" type="password" name="password" id="password" />
					</p>
					<input type="submit" />
				</fieldset>
			</form>

			<script>
				$.validator.addMethod( "email_is_gatech", function( value, element, params ) {
					var email = $( "#email" ).val().replace( /\s/g, '' );
					return ( email != '' && email.match( /[\w\.]+@gatech\.edu/g ) )
				}, "Must be a @gatech.edu email address." );

				$( "#accountform" ).validate({
					rules : {
						firstname : "required",
						lastname  : "required",
						email     : { email_is_gatech : true },
						password  : "required"
					}
				});
			</script>
		<? else: ?>
			<h2>You are already logged in!</h2>
			<meta http-equiv="refresh" content="3;url=index.php" />
		<? endif; ?>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
