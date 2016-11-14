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
            <br />
            <div class="container">
    			<form class="login" method="post" id="login_form" action="/">
    				<fieldset>
    					<legend>Login</legend>
    					<div class="form-row">
    						<span class="form-label">GATech Email:</span>
    						<span class="form-input"><input class="textbox" type="text" name="gatech_email" id="gatech_email" /></span>
    					</div>
    					<div class="form-row">
    						<span class="form-label">Password:</span>
    						<span class="form-input"><input class="textbox" type="password" name="password" id="password" /></span>
    					</div>
    					<div class="form-row">
                            <span class="form-input"><input type="submit" id="submit_login" /></span>
                        </div>
    					<br /><br />
    					<center>Don't have an account? Register <a href="/user/create_account.php">here</a>.</center>
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
