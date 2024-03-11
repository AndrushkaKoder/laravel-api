<?php

namespace App\Services\ArticlesService;

use Illuminate\Support\Facades\Http;

class ImportArticles
{
	private static string $url = 'https://techcrunch.com/wp-json/wp/v2/posts';
	private static int $maxArticlesCount = 140;

	public static function getOuterArticlesInArray(): array
	{
		$outerArticles = Http::get(self::$url);
		return array_map(function ($article) {
			return [
				'title' => trim(data_get($article, 'title.rendered')),
				'text' => trim(data_get($article, 'excerpt.rendered')),
				'created_at' => data_get($article, 'date'),
			];
		}, array_slice($outerArticles->json(), 0, self::$maxArticlesCount) ?? []);
	}
}
