=== Plugin Name ===
Contributors: kiryaka
Tags: uploader, multifile, flash, gallery
Requires at least: 2.5
Tested up to: 2.9.2
Stable tag: 0.0.3

Flexupload is fast multiple file uploader wordpress plugin with multithreading.

== Description ==

The main goal of this plugin - is to create an alternative way of multipart/form-data uploaders. Flexupload use Action Message Format (AMF) instead of usual POST data. It allows to use really cool features like simultaneous file upload, multithreading, resuming, compression and so on… On the other hand it increases server load. Here is the table of advantages and disadvantages:

Advantages:

* Real multithreading give from 50% to 300% faster upload speed (compared to usual flash uploaders)
* Size of flash uploader swf file is only 95Kb! There no image data at all!
* No upload size limit. Data transferred by small pieces in many threads, so no more server side upload limit.
* Pause and resuming - you can stop uploading and free your inet channel for some time and then resume uploading.
* Feasibility of image resizing on client size. Force for clients and configurable for admin users.
* Full information - average and current speed, uploaded and total size and more.

Disadvantages

* It's mutch more resource intensive than usual upload.
* It's required Flash Player 10
  
== Installation ==
Unpack the zip file and upload the content into the folder wp-content/plugins/flexupload (the WordPress plugins folder). Note : Do not change the folder names.

== Frequently Asked Questions ==

== Screenshots ==
1. Multifile flash uploader in action

== Changelog ==

= 0.0.3 =
* First beta version