<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch -  Log In</title>
		<link rel="stylesheet" type="text/css" href="/styles.css" />

		<?
            js_common_include();
            js_include(
                'ext/jquery-validation-1.15.1/dist/jquery.validate.min.js',
                'validate_lib.js'
            );
		?>

        <script src="/user/js/login.js"></script>
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<? if( !is_logged_in() ): ?>
			<form method="post" id="login_form" action="/">
				<fieldset>
					<legend>Login</legend>
					<p>
						<label for="email">GATech Email:</label>
						<input class="textbox" type="text" name="gatech_email" id="gatech_email" />
					</p>
					<p>
						<label for="password">Password:</label>
						<input class="textbox" type="password" name="password" id="password" />
					</p>
					<input type="submit" id="submit_login" />
					<br />
					<br />
					Don't have an account? Register <a href="/user/create_account.php">here</a>.
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
