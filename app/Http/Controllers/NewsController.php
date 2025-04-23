<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function __construct(
        private readonly NewsService $newsService
    ) {}

    /**
     * Display a listing of the news articles.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $page = (int) $request->get('page', 1);
        $newsResponse = $this->newsService->fetchNews($page);
        $authorsResponse = $this->newsService->fetchRandomAuthors(count($newsResponse));
        $totalResults = $this->newsService->fetchTotalResults();

        $articles = $this->newsService->combineNewsWithAuthors($newsResponse, $authorsResponse);
        $totalPages = ceil($totalResults / 10);

        return view('news.index', compact('articles', 'page', 'totalPages'));
    }
}
