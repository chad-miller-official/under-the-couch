<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Create Account</title>
		<link rel="stylesheet" type="text/css" href="/styles.css" />

		<?
            js_common_include();
            js_include(
                'ext/jquery-validation-1.15.1/dist/jquery.validate.min.js',
                'validate_lib.js'
            );
		?>

        <script src="/user/js/create_account.js"></script>
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<? if( !is_logged_in() ): ?>
			<form method="post" id="create_account_form" action="/">
				<fieldset>
					<legend>Create Account</legend>
					<p>
						<label for="firstname">First Name:</label>
						<input class="textbox" type="text" name="first_name" id="first_name" />
					</p>
					<p>
						<label for="lastname">Last Name:</label>
						<input class="textbox" type="text" name="last_name" id="last_name" />
					</p>
					<p>
						<label for="email">GATech Email:</label>
						<input class="textbox" type="text" name="gatech_email" id="gatech_email" />
					</p>
					<p>
						<label for="password">Password:</label>
						<input class="textbox" type="password" name="password" id="password" />
					</p>
                    <p>
                        <label for="password_again">Password Again:</label>
                        <input class="textbox" type="password" name="password_again" id="password_again" />
                    </p>
					<input type="submit" />
				</fieldset>
			</form>
		<? else: ?>
            <script type="text/javascript">
                window.location = '/index.php';
            </script>
		<? endif; ?>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
