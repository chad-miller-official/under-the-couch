<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Calendar</title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
	</head>
	<body>
		<? ui_insert( 'header' ); ?>

		<div class="container">
			<? ui_insert( 'sidebar' ); ?>
            <section class="focus-content">
				<iframe src="<?= URL_CALENDAR ?>"
					    style="border-width:0; float:right"
						width="740"
						height="700"
						frameborder="0"
						scrolling="no">
				</iframe>
            </section>
		</div>
        <br />
        <? ui_insert( 'footer' ); ?>
	</body>
</html>
