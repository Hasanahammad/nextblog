<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsUpload;
use App\Models\CategoryModel;
use Illuminate\Support\Str;

class Upload_Article_Controller extends Controller
{
    function ArticleIndex()
    {
        $categories = CategoryModel::select('category_name')->get();
        return view('ArticleList', ['categories' => $categories]);
    }
    function ArticleForm()
    {
        $categories = CategoryModel::select('category_name')->get();
        return view('ArticleForm', ['categories' => $categories]);
    }

    function getArticleData()
    {
        $result =NewsUpload::all();
        // foreach ($result as $row) {
        //     $row->upload_video = asset('videos/' . $row->upload_video);
        //     $row->thumbnail = asset('thumbnails/' . $row->thumbnail);
        // }

        json_encode($result);
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
        $host = $_SERVER['HTTP_HOST'];

        $article_headline = $request->input('article_headline');
        $article_description = $request->input('article_description');
        $article_category = $request->input('article_category');

        $videoPath = $request->file('article_video')->store('public');
        $videoName = (explode('/',$videoPath))[1];
        $video_filename = "http://".$host."/storage/".$videoName;

        $photoPath = $request->file('article_thumbnail')->store('public');
        $photoName = (explode('/',$photoPath))[1];
        $thumbnail_filename = "http://".$host."/storage/".$photoName;




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
