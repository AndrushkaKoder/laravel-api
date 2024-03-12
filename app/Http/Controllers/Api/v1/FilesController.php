<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\ArticlesService\ArticlesService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class FilesController extends Controller
{
	private array $extensions = [
		'xlsx',
		'xls'
	];

	public function __construct(protected ArticlesService $service)
	{
		$this->service = new ArticlesService();
	}

	public function getOuterFile(Request $request)
	{
		try {
			if ($request->isMethod('post')) {
				$file = $request->file('file');
				if ($file) {
					if (!in_array($file->extension(), $this->extensions))
						throw new \Exception('Incorrect file format!');
				}
				return $this->sendFile($file);
			} else {
				throw new \Exception('Method not allowed!');
			}

		} catch (\Exception $exception) {
			die($exception->getMessage());
		}
	}

	protected function sendFile($file): string
	{
		return $this->service->getResponseFile($file instanceof UploadedFile ? $file : null);
	}
}
