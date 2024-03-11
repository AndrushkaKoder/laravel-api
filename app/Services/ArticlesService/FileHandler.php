<?php

namespace App\Services\ArticlesService;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FileHandler
{
	private string $extension = 'xlsx';

	protected function createXlsFile(array $data): string
	{
		$filename = md5(rand(1, 1000) . '_file') . ".{$this->extension}";
		$pathToSave = public_path() . '/' . $filename;
		$spreadSheet = new Spreadsheet();
		$sheet = $spreadSheet->getActiveSheet();

		$sheet->setCellValue('A1', 'title');
		$sheet->setCellValue('B1', 'text');
		$sheet->setCellValue('C1', 'created_at');

		if ($data) {
			foreach ($data as $i => $item) {
				$fieldIndex = $i + 2;
				$sheet->setCellValue("A{$fieldIndex}", $item['title']);
				$sheet->setCellValue("B{$fieldIndex}", $item['text']);
				$sheet->setCellValue("C{$fieldIndex}", $item['created_at']);
			}
		}

		$writer = new Xlsx($spreadSheet);
		$writer->save($pathToSave);

		return url($pathToSave);
	}

	public function updateUploadedFile($file): string
	{
//		dd($this->loadFile($file));
		return '';
	}

	public function getFileFromOuterApi(): string
	{
		$outerArticles = ImportArticles::getOuterArticlesInArray();
		return $this->createXlsFile($outerArticles);
	}

	private function loadFile($file)
	{
		$inputType = IOFactory::identify($file);
		$loader = IOFactory::createReader($inputType);
		return $loader->load($inputType);

	}

}
