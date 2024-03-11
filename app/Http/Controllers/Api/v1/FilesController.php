<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\ArticlesService\ArticlesService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class FilesController extends Controller
{

	public function __construct(protected ArticlesService $service)
	{
		$this->service = new ArticlesService();
	}

	public function getOuterFile(Request $request)
	{
		try {
			if ($request->isMethod('post')) {
				$file = $request->file('file');
				return $this->sendFile($file);
			} else {
				throw new \Exception('Method not allowed!');
			}

		} catch (\Exception $exception) {
			return Http::response($exception->getMessage(), 405);
		}
	}

	protected function sendFile($file)
	{
		return $this->service->getResponseFile($file instanceof UploadedFile ? $file : null);
	}
}
