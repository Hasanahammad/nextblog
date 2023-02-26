<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    function categoryAdd(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $article_created_time = date('Y-m-d H:i:s');


        $category_name = $request->input('category_name');
        $category_description = $request->input('category_description');


        $result = CategoryModel::insert([
            'category_name' => $category_name,
            'category_description' => $category_description,
            'created_at' => $article_created_time
        ]);

        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }

    function getCategoryData()
    {
        $result = json_encode(CategoryModel::all());
        return $result;
    }

    function subCategory()
    {
        $categories = CategoryModel::select('category_name')->get();

        return view('Add_sub_Category',['categories' => $categories]);
    }
}
