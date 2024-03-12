<?php

namespace App\Services\ArticlesService;

use Illuminate\Http\UploadedFile;

class ArticlesService
{
	public function getResponseFile(UploadedFile|null $file): string
	{
		$handler = new FileHandler();

		return $file
			?
			$handler->updateUploadedFile($file)
			:
			$handler->getFileFromOuterApi();
	}

}
