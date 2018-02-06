<?php

/*
Plugin Name: News Headlines
Description: This plugin lists news headlines inside a post and a widget through a shortcode.
Version: 0.1
Author URI: https://www.vjks.net
*/

function get_api_data() {

	$response = file_get_contents( 'https://newsapi.org/v2/top-headlines?sources=associated-press,bbc-news&apiKey=03f7f516433f4d609412c784073a93e2' );
	/*$file = plugin_dir_path( __FILE__ ) . '/contents2.txt'; 
    $open = fopen( $file, "a" ); 
    $write = fputs( $open, $response ); 
    fclose( $open );*/
	
	$json_array = json_decode( $response, true );
	$headlines = "";
	
	foreach( $json_array[ 'articles' ] as $articles ) {
		$headlines = $headlines . "<div style=\"box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 10px;margin: 10px 0px 0px 0px;\">";
		$headlines = $headlines . "<p><h3><a target=\"_blank\" href=\"" . $articles[ 'url' ] . "\">" . $articles[ 'title' ] . "</a></h1></p>\n";
		$headlines = $headlines . "<p>" . $articles[ 'description' ] . "</p>\n";
		$headlines = $headlines . "<p><img src=\"" . $articles[ 'urlToImage' ] . "\"></p>\n";
		$headlines = $headlines . "</div>\n";
	}
	
	$response = $headlines; 
    return $response;
}


function get_api_data_for_widget() {

	$response = file_get_contents( 'https://newsapi.org/v2/top-headlines?sources=associated-press,bbc-news&apiKey=03f7f516433f4d609412c784073a93e2' );
	$file = plugin_dir_path( __FILE__ ) . '/contents2.txt'; 
    $open = fopen( $file, "a" ); 
    $write = fputs( $open, $response ); 
    fclose( $open );
	
	$json_array = json_decode( $response, true );
	$headlines = "";
	
	$i = 0;
	foreach( $json_array[ 'articles' ] as $articles ) {
		$headlines = $headlines . "<p><h6>" . ++$i . ". <a target=\"_blank\" href=\"" . $articles[ 'url' ] . "\">" . $articles[ 'title' ] . "</a></h6></p>\n";
	}
	
	$response = $headlines; 
    return $response;
}

add_shortcode('news_headlines', 'get_api_data');
add_shortcode('news_headlines_widget', 'get_api_data_for_widget');