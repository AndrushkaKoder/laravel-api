<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\ArticlesService\ArticlesService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class FilesController extends Controller
{

	public function __construct(protected ArticlesService $service)
	{
		$this->service = new ArticlesService();
	}

	public function getOuterFile(Request $request): mixed
	{
		if ($request->isMethod('post')) {
			$file = $request->file('file');
			return $this->service->getResponseFile($file instanceof UploadedFile ? $file : null);
		}
		return null;
	}

	protected function sendFile()
	{

	}
}
