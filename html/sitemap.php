<?php

include_once( 'Spyc.php' );
include_once( 'frontmatter.php' );

$data = Spyc::YAMLLoad('data.yml');

$pages = glob( 'pages/*.hbs' );

$template = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="[[sitemap_path]]">
	[[pages]]
</urlset>
XML;

$page_template = <<<'XML'
	<url>
      <loc>[[url]]</loc>
      <changefreq>daily</changefreq>
      <priority>[[priority]]</priority>
   </url>
XML;

$pages_output = '';

foreach( $pages as $page ) {
	if( basename( $page, '.hbs' ) === '404'
	    || basename( $page, '.hbs' ) === 'podminky-uveru-popup'
	    || basename( $page, '.hbs' ) === 'template'
	    || basename( $page, '.hbs' ) === 'zpracovani-udaju-popup') {
		continue;
	}

	$page_data = new FrontMatter( $page );

	$slug = ( basename( $page, '.hbs' ) === 'index' ) ? $data['abspath'] . '/' : $data['abspath'] . '/' . basename( $page, '.hbs' );

	$page_output = str_replace( '[[url]]', $slug, $page_template );
	switch( basename( $page, '.hbs' ) ){
		case 'index':
			$priority = 1;
			break;
		case 'reference':
		case 'kontakt':
			$priority = 0.8;
			break;
		case 'dokumenty':
			$priority = 0.7;
			break;
		default:
			$priority = 0.9;
	}
	$page_output = str_replace( '[[priority]]', $priority, $page_output );
	$pages_output .= $page_output;

}


$output = str_replace( '[[sitemap_path]]', $data['abspath'] . '/sitemap.xml', $template );
$output = str_replace( '[[pages]]', $pages_output, $output );

file_put_contents( 'build/sitemap.xml', $output );