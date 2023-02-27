<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsUpload;

class NewsUploadController extends Controller
{
    function onNewsUpload(Request $request)
    {
        $contactArray = json_decode($request->getContent(), true);
        $news_headline  = $contactArray['news_headline'];
        $news_description  = $contactArray['news_description'];
        $news_catagory  = $contactArray['news_catagory'];
        $upload_video  = $contactArray['upload_video'];
        $thumbnail  = $contactArray['thumbnail'];


        $result = NewsUpload::insert(['news_headline'=>$news_headline, 'news_description'=>$news_description, 'news_catagory'=>$news_catagory,'upload_video'=>$upload_video, 'thumbnail'=>$thumbnail]);

        if($result == true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    function onNewsRetrieve($parameter = null)
    {
        if($parameter == null)
        {
            $result= NewsUpload::select('id', 'news_headline', 'news_description', 'news_category', 'upload_video', 'thumbnail')->get();

            foreach ($result as $row) {
                $row->upload_video = asset('videos/' . $row->upload_video);
                $row->thumbnail = asset('thumbnails/' . $row->thumbnail);
            }
            return $result;
        }
        else
        {
            $result= NewsUpload::where(['id'=>$parameter])->get();
            foreach ($result as $row) {
                $row->upload_video = asset('videos/' . $row->upload_video);
                $row->thumbnail = asset('thumbnails/' . $row->thumbnail);
            }
            return $result;
        }
    }
}
