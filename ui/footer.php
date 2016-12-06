<?
    $found_year      = 2016;
    $current_year    = date( 'Y' );
    $copyright_years = strval( $found_year );

    if( $current_year > $found_year )
        $copyright_years .= " &ndash; $current_year";
?>
<footer>
    &copy; <?= $copyright_years ?> Under the Couch
</footer>
