<?
	db_include( 'get_member_by_login_credentials' );

	if( !isset( $_POST['password'] ) || !isset( $_POST['email'] ) )
	{
		$display_message = 'No email address or password provided!';
		$redirect = 'login.php';
	}
	else
	{
		$password_hash = hash( 'sha512', $_POST['password'] );
		$member        = get_member_by_login_credentials( $_POST['email'], $password_hash );

		if( $member )
		{
			$status = login( $member['member'] );

			if( $status )
			{
				$display_message = 'Successfully logged in!';
				$redirect        = 'index.php';
			}
			else
			{
				$display_message = 'You are already logged in!';
				$redirect        = 'index.php';
			}
		}
		else
		{
			$display_message = 'Incorrect email or password provided!';
			$redirect        = 'login.php';
		}
	}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Logging In...</title>
		<meta http-equiv="refresh" content="3;url=<?= $redirect ?>" />
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<center>
			<h1> <?= $display_message ?> </h1>
		</center>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
