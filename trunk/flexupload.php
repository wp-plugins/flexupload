<?php
/*
Plugin Name: flexupload
Plugin URI: http://code.google.com/p/wpflexupload/
Description: Flexupload multifile uploader with multithreading, resuming and compression.
Author: Butin Kirill <kiryaka@gmail.com>
Version: 0.0.1
Author URI: http://code.google.com/p/wpflexupload/
*/

/*
 * Copyright 2010 Butin Kirill <kiryaka@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *         http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * @package Flexupload multifile uploader
 * @author Kirill Butin <kiryaka@gmail.com>
 * @version 0.0.1
 */

function flexupload_wp_upload_tabs ($tabs) {
	$newtab = array('flexupload' => __('Flexupload','flexupload'));
	return array_merge($tabs,$newtab);
}
add_filter('media_upload_tabs', 'flexupload_wp_upload_tabs');

function media_upload_flexupload() {
	return wp_iframe( 'media_upload_flexupload_content', $errors );
}
add_action('media_upload_flexupload', 'media_upload_flexupload');

function media_upload_flexupload_content($errors) {
	media_upload_header();
	global $flexupload_content;
	require_once("view/fu_iframe.php");
	echo $flexupload_content;
}

function flexupload_add_media_button($content)
{
	global $post_ID, $temp_ID;
	$uploading_iframe_ID = (int) (0 == $post_ID ? $temp_ID : $post_ID);
	$media_upload_iframe_src = "media-upload.php?post_id=$uploading_iframe_ID";
	$flexupload_iframe_src = apply_filters('flexupload_iframe_src', "$media_upload_iframe_src&amp;tab=flexupload");
	$flexupload_title =  __('Flexupload','flexupload');
	$flexupload_button_src = '/wp-content/plugins/flexupload/view/icon_upload.gif';
	
	$content .= <<<EOF
		<a href="{$flexupload_iframe_src}&amp;TB_iframe=true" class="thickbox" title='$flexupload_title'><img src='$flexupload_button_src' alt='$flexupload_title' /></a>
EOF;

	return $content;
}

add_filter("media_buttons_context", "flexupload_add_media_button");
?>
