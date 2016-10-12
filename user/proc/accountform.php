<?
    db_include( 'create_member' );

    if( !isset( $_POST['email'] ) || !isset( $_POST['password'] ) )
    {
        $display_message = 'No email address or password provided!';
        $redirect        = '/user/accountform.php';
    }
    else
    {
        $member_pk = create_member( $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['password'] );

        if( $member_pk )
        {
            $display_message = 'Successfully created account! You may log in now.';
            $redirect        = '/index.php';
        }
        else
        {
            $display_message = "An account with the specified email - <b>{$_POST['email']}</b> - already exists!";
            $redirect        = '/user/accountform.php';
        }
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Under the Couch - Creating Account...</title>
        <meta http-equiv="refresh" content="3;url=<?= $redirect ?>" />
        <link rel="stylesheet" type="text/css" href="/styles.css" />
    </head>

    <body>
        <? ui_insert( 'header' ); ?>

        <article>
            <h1> <?= $display_message ?> </h1>
        </article>

        <? ui_insert( 'footer' ); ?>
    </body>
</html>
