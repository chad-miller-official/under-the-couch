<? if( is_logged_in() ): ?>
    <script type="text/javascript">
        window.location = '/index.php';
    </script>
    <? exit; ?>
<? endif; ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Create Account</title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
		<?
            js_common_include();
            js_include( 'validate_lib.js' );
		?>
        <script src="/user/js/create_account.js"></script>
	</head>
	<body>
		<? ui_insert( 'header' ); ?>
		<div class="container">
			<h1 class="centered-title">Create an Account</h1>
			<form class="login" method="post" id="create_account_form" action="/">
				<fieldset class="centered-fieldset">
					<p>
						<label class="nowidth" for="firstname">First Name:</label>
						<input class="textbox" type="text" name="first_name" id="first_name" />
					</p>
					<p>
						<label class="nowidth" for="lastname">Last Name:</label>
						<input class="textbox" type="text" name="last_name" id="last_name" />
					</p>
					<p>
						<label class="nowidth" for="email">GATech Email:</label>
						<input class="textbox" type="text" name="gatech_email" id="gatech_email" />
					</p>
					<p>
						<label class="nowidth" for="password">Password:</label>
						<input class="textbox" type="password" name="password" id="password" />
					</p>
                    <p>
                        <label class="nowidth" for="password_again">Password Again:</label>
                        <input class="textbox" type="password" name="password_again" id="password_again" />
                    </p>
					<input type="submit" class="submit-button" id="submit-login"></input>
				</fieldset>
			</form>
		</div>
		<? ui_insert( 'footer' ); ?>
	</body>
</html>
