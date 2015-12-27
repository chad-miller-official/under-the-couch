<?
	db_include(
		'get_officer_info_by_position_short_name',
		'get_position_by_short_name'
	);

	$position = get_position_by_short_name( $_GET['name'] );

	if( $position )
	{
		$position_name        = $position['name'];
		$position_description = $position['description'];
	}
	else
	{
		$position_name        = 'Officer Not Found';
		$position_description = 'Officer position not found!';
	}

	$officers = get_officer_info_by_position_short_name( $_GET['name'] );
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - <?= $position_name ?></title>
		<link rel="stylesheet" type="text/css" href="../styles.css" />
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<div class="container">
			<? ui_insert( 'sidebar' ); ?>

			<div class="primary">
				<article>
					<br/>
                    <center>
						<? if( $officers ): ?>
							<? foreach( $officers as $officer ): ?>
								<img src="pics/<?= "{$officer['short_name']}_{$officer['member']}" ?>.jpg" />
								<br />
								<b> <?= $officer['officer_name'] ?> </b>
								<br />
								<?= $officer['display_email_address'] ?>
								<br />
								<br />
							<? endforeach; ?>
						<? endif; ?>
						<?= $position_description ?>
                    </center>
					<br/>
				</article>
			</div>

			<? ui_insert( 'footer' ); ?>
		</div>
	</body>
</html>
