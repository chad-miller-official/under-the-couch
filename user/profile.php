<?
    db_include( 'get_member' );

    if( !isset( $_REQUEST['member'] ) )
    {
        if( is_logged_in() ):
            $member_pk = SessionLib::get( 'user_member.member' );
        else:
?>
            <script type="text/javascript">
                window.location = '/user/login.php';
            </script>
<?
            exit;
        endif;
    }
    else
    {
        if( $_REQUEST['member'] == -1 ):
?>
            <script type="text/javascript">
                window.location = '/404.php?file=profile.php?member=-1';
            </script>
<?
            exit;
        else:
            $member_pk = $_REQUEST['member'];
        endif;
    }

    $is_owner    = ( $member_pk == SessionLib::get( 'user_member.member' ) );
    $member_info = get_member( $member_pk );

    $name          = $member_info['name'];
    $email_address = $member_info['display_email_address'] ?: $member_info['gatech_email_address'];

    $profile_photo_path = $member_info['profile_photo_path'] ?: '/media/profile/default.jpg';

    $paid_dues_date     = $member_info['paid_dues_date'] ?: 'N/A';
    $paid_practice_date = $member_info['paid_practice_date'] ?: 'N/A';

    $paid_locker_date = $member_info['paid_locker_date'] ?: 'N/A';
    $locker_end_date  = $member_info['locker_end_date'];
    $locker_number    = $member_info['locker_number'];
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Profile - <?= $name ?></title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
        <?
            js_common_include();
            js_include( 'validate_lib.js' );
		?>
        <script src="/user/js/profile.js"></script>
	</head>
	<body>
        <? ui_insert( 'header' ); ?>
        <div class="container">
            <? ui_insert( 'sidebar' ); ?>
            <article>
                <? if ($is_owner): ?>
                    <h1>
                        Your Profile
                    </h1>
                <? endif; ?>
                <div class="profile-card">
        			<aside id="profile-photo-wrapper">
                        <? if( $is_owner ): ?>
                            <form id="form_upload_profile_photo"
                                  action="/"
                                  method="post"
                                  enctype="multipart/form-data"
                            >
                                <input type="file"
                                       style="display:none"
                                       id="input_upload_profile_photo"
                                       name="profile_photo"
                                >
                                <input type="hidden" name="member_pk" id="member_pk" value="<?= $member_pk ?>" />
                                <div id="upload_profile_photo">
                                    <a href="" id="upload_profile_photo_link">Upload Photo</a>
                                </div>
                        <? endif; ?>
                                <img src="<?= $profile_photo_path ?>" id="profile_photo" />
                        <? if( $is_owner ): ?>
                            </form>
                        <? endif; ?>
                    </aside>
                    <div id="public_info">
                        <h2><?= $name ?></h2>
                        <p><? if(!$is_owner): ?>
                                <a href="mailto:<?= $email_address ?>"><?= $email_address?></a>
                            <? else: ?>
                                <a id="change-email-link" href="javascript:void(0);"><?= $email_address?></a>
                                <div id="change-email">
                                    <? require($GLOBALS[WEBROOT] . "/user/change_email_mini.php"); ?>
                                </div>
                            <? endif; ?>
                        </p>
                    </div>
                    <? if( $is_owner || SessionLib::get( 'user_member.is_admin' ) ): ?>
                        <div id="payment_dates">
                            <p>
                                <span>Paid Dues:</span> <span><?= $paid_dues_date ?></span>
                                <br />
                                <span>Paid Practice Fees:</span> <span><?= $paid_practice_date ?></span>
                                <? if( $paid_locker_date ): ?>
                                    <br />
                                    <br />
                                    Paid Locker Fee: <?= $paid_locker_date ?>
                                    <br />
                                    Paid Through: <?= $locker_end_date ?>
                                    <br />
                                    Locker Number: <?= $locker_number ?>
                                <? endif; ?>
                            </p>
                        </div>
                    <? endif; ?>
                    <h2>About Me</h2>
                    <? if ($is_owner):
                        require($GLOBALS[WEBROOT] . "/user/profile-card.php");
                    else:
                        require($GLOBALS[WEBROOT] . "/user/profile-card.php");
                    endif; ?>
                </div>
            </article>
        </div>
        <? ui_insert( 'footer' ); ?>
	</body>
</html>
