<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsUpload;
use Illuminate\Support\Str;

class Upload_Article_Controller extends Controller
{
    function ArticleIndex()
    {
        return view('ArticleList');
    }
    function ArticleForm()
    {
        return view('ArticleForm');
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
        $article_category = $request->input('article_category');
        $article_video = $request->input('article_video');
        $article_thumbnail = $request->input('article_thumbnail');

        $result = NewsUpload::where('id',$id)->update(['news_headline'=>$article_headline, 'news_description'=>$article_description, 'news_category'=>$article_category, 'upload_video'=>$article_video, 'thumbnail'=>$article_thumbnail]);
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
        date_default_timezone_set('Asia/Dhaka');
        $article_created_time = date('Y-m-d H:i:s');


        $article_headline = $request->input('article_headline');
        $article_description = $request->input('article_description');
        $article_category = $request->input('article_category');
        //$article_created_time = $request->input('article_created_time');

        $article_video = $request->file('article_video');
        $video_extension = $article_video->getClientOriginalExtension();
        $video_filename = time() . '_' . Str::random(8) . '.' . $video_extension;
        $path = $article_video->storeAs('public/videos', $video_filename);

        $article_thumbnail = $request->file('article_thumbnail');
        $thumbnail_extension = $article_thumbnail->getClientOriginalExtension();
        $thumbnail_filename = time() . '_' . Str::random(8) . '.' . $thumbnail_extension;
        $thumbnail_path = $article_thumbnail->storeAs('public/thumbnails', $thumbnail_filename);

        $result = NewsUpload::insert([
            'news_headline' => $article_headline,
            'news_description' => $article_description,
            'news_category' => $article_category,
            'upload_video' => $video_filename,
            'thumbnail' => $thumbnail_filename,
            'created_at' => $article_created_time
        ]);

        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }

}
