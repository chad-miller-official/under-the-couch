<!-- Temporary 404 page for now -->
<?
    db_include( 'get_officer_email' );
    $email = get_officer_email(ROLE_IT_OFFICER);
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>404 - Not Found</title>
        <link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
    </head>

    <body>
        <? ui_insert('header'); ?>

        <div class="container">
            <br/>
            <h1 class="centered-title">404 Error</h1>

            <p style="text-align:center">
                <strong>Page requested: <?= $_REQUEST['file'] ?></strong>
            </p>

            <p style="text-align:center">
                Please contact the IT Officer at
                <a href="mailto:<?= $email ?>"><?= $email ?></a>.
            </p>
        </div>

        <? ui_insert('footer'); ?>
    </body>
</html>
