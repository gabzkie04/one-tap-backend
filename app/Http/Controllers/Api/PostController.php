<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //

    public function addPost(Request $request)
    {
        $request->validate([
            "farm" => "required",
            "title" => "required|unique:post",
            "description" => "required",
            "image" => "required",
            "status" => "required",
            "quantity" => "required",
            "type" => "required",
            "price" => "required",
        ]);

        $str_rnd = Str::random(5);
        $file = $request->file('image');
        $destinationPath = 'file_storage/';

        if ($file->getClientOriginalExtension() === null) {
            return response()->json([
                "errors" => [
                    "message" => "Product Image is required!",
                ],
                "message" => "Product Image is required",
            ], 200);
        }
        
        $filename = $str_rnd . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);

        $post = new Post();
        $post->farm_id  = $request->farm;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $request->filename;
        $post->status = $request->status;
        $post->quantity = $request->quantity;
        $post->type = $request->type;
        $post->price = $request->price;
    }
}
