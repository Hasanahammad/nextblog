<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Upload_Article_Controller extends Controller
{
    function ArticleIndex()
    {
      return view('UploadArticle');
    }
}
