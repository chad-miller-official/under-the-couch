<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Log In</title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
		<?
            js_common_include();
            js_include( 'validate_lib.js' );
		?>
        <script src="/user/js/login.js"></script>
	</head>
	<body>
		<? if( !is_logged_in() ): ?>
            <? ui_insert( 'header' ); ?>

            <div class="container">
				<h1 class="centered-title">Login</h1>
    			<form class="login" method="post" id="login_form" action="/">
    				<fieldset class="centered-fieldset">
    					<p>
    						<label class="nowidth">GATech Email:</label>
    						<input class="textbox" type="text" name="gatech_email" id="gatech_email" />
    					</p>
    					<p>
    						<label class="nowidth">Password:</label>
    						<input class="textbox" type="password" name="password" id="password" />
    					</p>
    					<p>
                            <input type="submit" class="submit-button" id="submit-login"></input>
                        </p>
    					<span class="centered">Don't have an account? Register <a href="/user/create_account.php">here</a>.</span>
    				</fieldset>
    			</form>
            </div>
            <br />
            <? ui_insert( 'footer' ); ?>
		<? else: ?>
			<script type="text/javascript">
                window.location = '/index.php';
            </script>
		<? endif; ?>
	</body>
</html>
