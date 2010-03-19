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
			
	finish_upload = function (tempFileName, realName){
		document.getElementById('nulIframe').src = '/wp-content/plugins/flexupload/wp_flexupload.php?tmpname=' + tempFileName + '&realname=' + realName + '&post_id=' + post_id;
	}
        </script>
    <iframe id="nulIframe" style="display:none;width: 0px; height: 0px;"></iframe>
    	<table width="100%" height="80%">
    	<tbody>
    	<tr><td height="20%" valign="middle" align="center"><div style="width: 450px; color: #666666;">
    	<b>WordPress Flexupload</b> plugin is based on <a href="http://code.google.com/p/flexupload/" target="_top">Flexupload project</a> 
        	and it's still in deep beta, so NO GUARANTEE at all. Use At Your Own Risk.</div></td> </tr>
    	<tr><td height="70%" valign="top">
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
                        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash Player" />
                    </a>
                <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>
	    </noscript>		
</td> </tr>
	<tr><td height="10%" valign="middle" align="center"><div style="width: 500px; color: #666666;">
	P.S. If you use Firebug - turn it off, or at least disable "Net" panel. Firebug can significantly slow down work of plugin or even crash FireFox.</div></td> </tr>

    	</tbody>
    	</table>
EOF;
