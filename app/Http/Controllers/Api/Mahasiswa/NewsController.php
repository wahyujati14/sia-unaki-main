<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index(){
        $news = Cache::remember('news', 10, function() {
            return  News::with('news_category')->latest()->paginate(10);
         });
        return $this->getSuccessResponse(['news' => $news]);
    }

    public function show($id)
    {
        $news = News::with('news_category')->find($id);
        return $this->getSuccessResponse(['news' => $news]);
    }
}
