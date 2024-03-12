<?php

namespace App\Services\ArticlesService;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FileHandler
{
	private string $extension = 'xlsx';

	protected function createXlsFile($data): string
	{
		$filename = md5(rand(1, 1000) . '_file') . ".{$this->extension}";
		$pathToSave = storage_path('app/public/' . $filename);
		$spreadSheet = new Spreadsheet();
		$sheet = $spreadSheet->getActiveSheet();

		if ($data) {
			foreach ($data as $i => $item) {
				$sheet->setCellValue([$i + 1, 1], $item[0] ?? '');
				$sheet->setCellValue([$i + 1, 2], $item[1] ?? '');
			}
		}
		$writer = new Xlsx($spreadSheet);
		$writer->save($pathToSave);
		return url("storage/{$filename}");
	}

	public function updateUploadedFile($file): string
	{
		$dataArray = $this->loadFile($file);
		return $this->createXlsFile($dataArray);
	}

	public function getFileFromOuterApi(): string
	{
		$dataArray = ImportArticles::getOuterArticlesInArray();
		return $this->createXlsFile($dataArray);
	}

	private function loadFile($file): array
	{
		$inputType = IOFactory::identify($file);
		$loader = IOFactory::createReader($inputType);
		$file = $loader->load($file);
		return $file->getActiveSheet()->toArray();
	}

}
