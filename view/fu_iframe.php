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

global $flexupload_content;
$flexupload_content .= <<<EOF
	<style type="text/css" media="screen"> 
			html, body	{ height:100%; }
			body { margin:0; padding:0; overflow:auto; text-align:center; 
			       background-color: #ffffff; }   
			object { outline:none; }
        </style>		    
        <script type="text/javascript" src="/wp-content/plugins/flexupload/view/swfobject.js"></script>
        <script type="text/javascript">
            <!-- For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. --> 
            var swfVersionStr = "10.0.0";
            <!-- To use express install, set to playerProductInstall.swf, otherwise the empty string. -->
            var xiSwfUrlStr = "/wp-content/plugins/flexupload/view/playerProductInstall.swf";
            var flashvars = {};
            var params = {};
            params.quality = "high";
            params.bgcolor = "#ffffff";
            params.allowscriptaccess = "sameDomain";
            params.allowfullscreen = "true";
            var attributes = {};
            attributes.id = "flexupload_wp";
            attributes.name = "flexupload_wp";
            attributes.align = "middle";
            swfobject.embedSWF(
                "/wp-content/plugins/flexupload/view/flexupload_wp.swf", "flashContent", 
                "100%", "300px", 
                swfVersionStr, xiSwfUrlStr, 
                flashvars, params, attributes);
			<!-- JavaScript enabled so display the flashContent div in case it is not replaced with a swf object. -->
			swfobject.createCSS("#flashContent", "display:block;text-align:left;");
	
	gallery_text = '<li id="tab-gallery"><a class="current" href="/wp-admin/media-upload.php?post_id=339&amp;tab=gallery">Галерея (<span id="attachments-count">3</span>)</a></li>';
			
	finish_upload = function (tempFileName, realName){
		document.getElementById('nulIframe').src = '/wp-content/plugins/flexupload/wp_flexupload.php?tmpname=' + tempFileName + '&realname=' + realName + '&post_id=' + post_id;
		if( document.getElementById('attachments-count') ){
			document.getElementById('tab-gallery').style.fontWeight = "bold";
			document.getElementById('attachments-count').innerHTML = document.getElementById('attachments-count').innerHTML - -1;
		}
	}
        </script>
    <iframe id="nulIframe" style="display:none;width: 0px; height: 0px;"></iframe>
    	<table width="100%" height="92%">
    	<tbody>
    	<tr><td height="20%" valign="middle" align="center">
    	<div style="width: 500px; color: #666666;" id="firebug_warn">&nbsp;</div></td> </tr>
    	<tr><td height="80%" valign="top">
        <!-- SWFObject's dynamic embed method replaces this alternative HTML content with Flash content when enough 
			 JavaScript and Flash plug-in support is available. The div is initially hidden so that it doesn't show
			 when JavaScript is disabled. -->
        <div id="flashContent" style="display:none;">
        	<p>
	        	To view this page ensure that Adobe Flash Player version 
				10.0.0 or greater is installed. 
			</p>
			<a href='http://www.adobe.com/go/getflashplayer'>Get Adobe Flash player</a>
        </div>
	   	
       	<noscript>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="flexupload_wp">
                <param name="movie" value="/wp-content/plugins/flexupload/view/flexupload_wp.swf" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#ffffff" />
                <param name="allowScriptAccess" value="sameDomain" />
                <param name="allowFullScreen" value="true" />
                <!--[if !IE]>-->
                <object type="application/x-shockwave-flash" data="/wp-content/plugins/flexupload/view/flexupload_wp.swf" width="100%" height="100%">
                    <param name="quality" value="high" />
                    <param name="bgcolor" value="#ffffff" />
                    <param name="allowScriptAccess" value="sameDomain" />
                    <param name="allowFullScreen" value="true" />
                <!--<![endif]-->
                <!--[if gte IE 6]>-->
                	<p> 
                		Either scripts and active content are not permitted to run or Adobe Flash Player version
                		10.0.0 or greater is not installed.
                	</p>
                <!--<![endif]-->
                    <a href="http://www.adobe.com/go/getflashplayer">
                        Get Adobe Flash player
                    </a>
                <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>
	    </noscript>		
</td> </tr>
    	</tbody>
    	</table>
    	
<div style="position: absolute; bottom: 0px; right: 5px;color: #888888;font-size: 10px;">
EOF
;

$flexupload_content .=  __('If you like this plugin, you can ', 'flexupload') .
	'<a style="font-size: 10px;text-decoration:none; color: #888888; font-weight: bold;" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&item_name=Buy Me a Beer for Flexupload WordPress plugin&hosted_button_id=LFQ9FC2ELS2TU" target="_top">
		'.__('Buy Me a Beer', 'flexupload').'
	</a>' .
<<<EOF
</div>    	
<script>
	if (window.console && window.console.firebug) {
		document.getElementById('firebug_warn').innerHTML = '
EOF
;

$flexupload_content .= __('If you use Firebug - turn it off, or at least disable "Net" panel. Firebug can significantly slow down work of plugin or even crash FireFox.', 'flexupload') . 
<<<EOF
		';
	}
	
	if (document.getElementById('tab-gallery ') ){
		document.getElementById('tab-gallery ').id = 'tab-gallery';
	}
</script>    	
EOF;
