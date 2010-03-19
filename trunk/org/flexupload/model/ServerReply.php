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


class ServerReply {
	public $_explicitType = 'ServerReply';
	const SUCCESS = 1;
	const FAIL = 0;
	
	const TYPE_START_SESSION = 1;
	const TYPE_FINISH_SESSION = 2;
	
	const TYPE_START_UPLOAD = 3;
	const TYPE_SAVE_PART = 4;
	const TYPE_FINISH_UPLOAD = 5;
	
	public $fileInfo;
	public $bytesTransfered = 0;
	public $status = SUCCESS;
	public $type;
}