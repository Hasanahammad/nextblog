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

    function getArticleDetails(Request $request)
    {
        $id = $request->input('id');
        $result = NewsUpload::where('id',$id)->get();
        return $result;
    }

    function articleDelete(Request $request)
    {
        $id = $request->input('id');
        $result = NewsUpload::where('id',$id)->delete();
        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    function articleUpdate(Request $request)
    {
        $id = $request->input('id');
        $article_headline = $request->input('article_headline');
        $article_description = $request->input('article_description');
        $article_catagory = $request->input('article_catagory');
        $article_video = $request->input('article_video');
        $article_thumbnail = $request->input('article_thumbnail');

        $result = NewsUpload::where('id',$id)->update(['news_headline'=>$article_headline, 'news_description'=>$article_description, 'news_catagory'=>$article_catagory, 'upload_video'=>$article_video, 'thumbnail'=>$article_thumbnail]);
        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    function articleAdd(Request $request)
    {
        $article_headline = $request->input('article_headline');
        $article_description = $request->input('article_description');
        $article_catagory = $request->input('article_catagory');
        $article_video = $request->input('article_video');
        $article_thumbnail = $request->input('article_thumbnail');

        $result = NewsUpload::insert(['news_headline'=>$article_headline, 'news_description'=>$article_description, 'news_catagory'=>$article_catagory, 'upload_video'=>$article_video, 'thumbnail'=>$article_thumbnail]);
        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

}
