<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NewsService
{

    /**
     * Fetch news articles from the API.
     *
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    private function requestNewsApi(int $page = 1, int $pageSize = 10): array
    {
        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => 'tesla',
            'from' => '2025-03-23',
            'sortBy' => 'publishedAt',
            'pageSize' => $pageSize,
            'page' => $page,
            'apiKey' => $this->getApiKey(),
        ]);

        return $response->json();
    }
    /**
     * Fetch news articles from the API.
     *
     * @param int $page
     * @return array
     */
    public function fetchNews(int $page): array
    {
        $response = $this->requestNewsApi($page, 10);

        return $response['articles'] ?? [];
    }

    /**
     * Fetch total results from the API.
     *
     * @return int
     */
    public function fetchTotalResults(): int
    {
        $response = $this->requestNewsApi(1, 1);

        return $response['totalResults'] ?? 0;
    }

    /**
     * Fetch random authors from the API.
     *
     * @param int $count
     * @return array
     */
    public function fetchRandomAuthors(int $count): array
    {
        $authorsResponse = Http::get('https://randomuser.me/api/', [
            'results' => $count,
        ]);

        return $authorsResponse['results'] ?? [];
    }
    /**
     * Combine news articles with authors.
     *
     * @param array $articles
     * @param array $authors
     * @return array
     */
    public function combineNewsWithAuthors(array $articles, array $authors): array
    {
        return collect($articles)->map(function ($article, $index) use ($authors) {
            return [
                'title' => $article['title'],
                'description' => $article['description'],
                'url' => $article['url'],
                'image' => $article['urlToImage'],
                'author' => $authors[$index]['name']['first'] . ' ' . $authors[$index]['name']['last'],
                'avatar' => $authors[$index]['picture']['thumbnail'],
            ];
        })->toArray();
    }
    /**
     * Calculate total pages based on total results.
     *
     * @param int $totalResults
     * @return int
     */
    public function calculateTotalPages(int $totalResults): int
    {
        return ceil($totalResults / 10);
    }
    /**
     * Get the API key from the configuration.
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return config('services.newsapi.key');
    }
}
