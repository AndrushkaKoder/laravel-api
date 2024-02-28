<?php

namespace App\Services\ArticlesService;

use Illuminate\Http\UploadedFile;

class ArticlesService
{
	public function getResponseFile(UploadedFile|null $file): mixed
	{
		if ($file) {
			 $handler = new FileHandler();
			//Если пришел файл, обработать его и вернуть
		} else {
			$handler = new FileHandler();
			//dd(ImportArticles::getArticlesFile());
			//Если файла нет, получить по апи данные, записать в файл и вернуть
		}
		return null;
	}

}
