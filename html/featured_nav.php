<?php

$pages = glob( 'featured_nav/*.html' );

foreach( $pages as $page ) {

	$data = file_get_contents( $page );

	$to_json = array( 'data' => $data );

	file_put_contents( 'build/' . basename( $page, '.html' ) . '.json', json_encode( $to_json ) );

}