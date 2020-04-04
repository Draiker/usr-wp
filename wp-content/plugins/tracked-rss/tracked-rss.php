<?php
/*
Plugin Name: Tracked RSS
Plugin URI: http://www.jackmcintyre.net/projects/tracked-rss/?utm_source=wordpress&utm_medium=plugin&utm_campaign=tracked-rss
Description: Modifies RSS permalinks to use Google Analytics tracking. Campaign is set as post slug.
Version: 0.2
Author: Jack McIntyre
Author URI: http://www.jackmcintyre.net?utm_source=wordpress&utm_medium=plugin&utm_campaign=tracked-rss

Thanks to Chris from Dot-Chris Development for this re-write.

*/

function trackedrss($guid) {
	global $wp,$post;
	if (is_feed()) {
    $operator = (preg_match("/\?/i", $guid)) ? "&amp;":"?";
    $format = "%s"."utm_source=%s"."&amp;utm_medium=%s"."&amp;utm_campaign=%s";
    $url_pre = $guid . $operator;
    $source = "rss";
    $medium = "rss";
    $campaign = (string)$post->post_name;
    return sprintf($format,$url_pre,$source,$medium,$campaign);
	}
}

add_filter ('the_permalink_rss','trackedrss');
?>