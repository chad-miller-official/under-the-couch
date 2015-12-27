<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Calendar</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<div class="container">
			<? ui_insert( 'sidebar' ); ?>

			<div class="primary">
				<center>
					<iframe src="<?= URL_CALENDAR ?>"
						    style=" border-width:0 "
							width="620"
							height="600"
							frameborder="0"
							scrolling="no">
					</iframe>
				</center>
			</div>

			<? ui_insert( 'footer' ); ?>
		</div>
	</body>
</html>
