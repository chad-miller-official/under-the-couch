<?
	db_include( 'get_member_by_login_credentials' );

    $password = @$_POST['password'];
    $email    = @$_POST['email'];

	if( !isset( $email ) || !isset( $password ) )
	{
		$display_message = 'No email address or password provided!';
		$redirect = '/login.php';
	}
	else
        list( $display_message, $redirect ) = login( $email, $password );
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Logging In...</title>
		<meta http-equiv="refresh" content="3;url=<?= $redirect ?>" />
		<link rel="stylesheet" type="text/css" href="/styles.css" />
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<center>
			<h1> <?= $display_message ?> </h1>
		</center>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
