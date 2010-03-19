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


class FileController
{
	/**
	 * @param FileInfo $fileInfo
	 * @return FileInfo
	 */
	public function createTempFile(FileInfo $fileInfo){
		$tmpfname = tempnam(sys_get_temp_dir(), "php_upload_");
		
		$fp = fopen($tmpfname, "w+");
		ftruncate($fp, $fileInfo->size);
		fclose($fp);
		
		$fileInfo->tempFileName = basename($tmpfname);
		
		return $fileInfo;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param FileInfo $fileInfo
	 * @param FilePart $filePart
	 * @return FileInfo
	 */
	public function saveFilePart(FileInfo $fileInfo,  FilePart $filePart){
		$filepath = sys_get_temp_dir()."/".$fileInfo->tempFileName;
		$fp = fopen($filepath, "r+");
		fseek($fp, $filePart->fileOffset, SEEK_SET);
		$res = fwrite($fp, $filePart->byteArray);
		//Loger::log("Write to file {$filepath} bytes: ".$filePart->length." offset:".$filePart->fileOffset."  with result ".$res);
		fclose($fp);
		return $fileInfo;
	}
	
}