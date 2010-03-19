<?php
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

chdir('../../../wp-admin/');
require_once('admin.php');
session_write_close();
session_start();
ignore_user_abort(true);

$file['name'] = $_GET['realname'];
$file['tmp_name'] = $_GET['tmpname'];
$mime = wp_check_filetype($file['name']);
$file['type'] = $mime['type'];
$file['size'] = filesize(sys_get_temp_dir()."/".$file['tmp_name']);
$file['error'] = null;

$name = $file['name'];

$post_id = $_REQUEST['post_id'];
$type = $file['type'];

$time = current_time('mysql');
$uploads = wp_upload_dir($time);
$filename = wp_unique_filename( $uploads['path'], $file['name'], "flexupload" );
$new_file = $uploads['path'] . "/$filename";
rename(sys_get_temp_dir()."/".$file['tmp_name'], $new_file);
//copy(sys_get_temp_dir()."/".$file['tmp_name'], $new_file);

$stat = stat( dirname( $new_file ));
$perms = $stat['mode'] & 0000666;
@ chmod( $new_file, $perms );
// Compute the URL
$url = $uploads['url'] . "/$filename";

$file = apply_filters( 'wp_handle_upload', array( 'file' => $new_file, 'url' => $url, 'type' => $type ) );

$name_parts = pathinfo($name);
$name = trim( substr( $name, 0, -(1 + strlen($name_parts['extension'])) ) );

$url = $file['url'];
$type = $file['type'];
$file = $file['file'];
$title = $name;
$content = '';

// use image exif/iptc data for title and caption defaults if possible
//if ( $image_meta = @wp_read_image_metadata($file) ) {
//	if ( trim($image_meta['title']) ) $title = $image_meta['title'];
//	if ( trim($image_meta['caption']) ) 	$content = $image_meta['caption'];
//}


// Construct the attachment array
$attachment = array_merge( array(
	'post_mime_type' => $type,
	'guid' => $url,
	'post_parent' => $post_id,
	'post_title' => $title,
	'post_content' => $content,
), array() );

// Save the data
$id = wp_insert_attachment($attachment, $file, $post_id);

if ( !is_wp_error($id) ) {
	wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file ) );
}
session_write_close();
