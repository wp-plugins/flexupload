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

require_once("org/flexupload/model/ServerReply.php");
require_once("org/flexupload/model/FileInfo.php");
require_once("org/flexupload/model/FilePart.php");
require_once("org/flexupload/controller/FileController.php");

class UploadService {
	/**
	 * @var FileController
	 */
	protected $file_controller;
	public function __construct(){
		$this->file_controller = new FileController();
	}
	protected function checkPermission()
	{
		return 0 === strpos($_SERVER['HTTP_REFERER'], "http://".$_SERVER['SERVER_NAME']."/wp-content/plugins/flexupload/view/flexupload_wp.swf");
	}	
	public function startUpload(FileInfo $fileinfo)
	{
		if (!$this->checkPermission()) return ;
		$s = new ServerReply();
		$s->type = ServerReply::TYPE_START_UPLOAD;
		$permission = true;
		if ($permission){
			$s->status = ServerReply::SUCCESS;
			$fileinfo = $this->file_controller->createTempFile($fileinfo);
		}else{
			$s->status = ServerReply::FAIL;
		}
		
		$s->fileInfo = $fileinfo;
		return $s;
	}
	
	public function uploadFilePart(FileInfo $fileinfo, FilePart $filepart)
	{
		if (!$this->checkPermission()) return ;
		$s = new ServerReply();
		$s->status = ServerReply::SUCCESS;
		$s->type = ServerReply::TYPE_SAVE_PART ;
		$s->fileInfo = $this->file_controller->saveFilePart($fileinfo, $filepart);
		$s->bytesTransfered = $filepart->length;
		//usleep(100000);
		return $s;
	}	
	
	public function finishUpload(FileInfo $fileinfo)
	{
		if (!$this->checkPermission()) return ;
		$s = new ServerReply();
		$s->status = ServerReply::SUCCESS;
		$s->type = ServerReply::TYPE_FINISH_UPLOAD ;
		$s->fileInfo = $fileinfo;
		return $s;
	}
	
	public function isServerFree()
	{
		session_start();
		session_write_close();		
		$s = new ServerReply();
		$s->type = -1;
		return $s;
	}	
	public function finishSession()
	{
		$s = new ServerReply();
		$s->status = ServerReply::SUCCESS;
		$s->type = ServerReply::TYPE_FINISH_SESSION  ;
		return $s;
	}
}