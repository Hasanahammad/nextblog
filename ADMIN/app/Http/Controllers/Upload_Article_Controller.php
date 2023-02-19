<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsUpload;

class Upload_Article_Controller extends Controller
{
    function ArticleIndex()
    {
        return view('UploadArticle');
    }

    function getArticleData()
    {
        $result = json_encode(NewsUpload::all());
        return $result;
    }
}
