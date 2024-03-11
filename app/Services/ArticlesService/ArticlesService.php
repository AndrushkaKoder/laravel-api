<?php

namespace App\Services\ArticlesService;

use Illuminate\Http\UploadedFile;

class ArticlesService
{
	/*
	 * Сервис обработки статей (файлов)
	 */
	public function getResponseFile(UploadedFile|null $file)
	{
		$handler = new FileHandler();
		if ($file) {
			return $handler->updateUploadedFile($file);
			//Если пришел файл, обработать его и вернуть
		} else {
			return $handler->getFileFromOuterApi();
			//Если файла нет, получить по апи данные, записать в файл и вернуть
		}
	}

}
