<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        
        return response()->json([
            "status" => 200,
            "data" => $post
        ], 200);
    }

    public function create(Request $request)
    {

        $request->validate([
            "judul" => "required",
            "slug" => "required",
            "isi" => "required"
        ]);

        $data = [
            "judul" => $request->judul,
            "slug" => $request->slug,
            "isi" => $request->isi 
        ];

        $datas = Post::create($data);

        if(!$datas) {
            return response([
                "status" => 401,
                "message" => "Gagal menambah post",
            ],401);
        } else {
            return response([
                "status" => 200,
                "message" => "berhasil menambah post",
                "data" => $datas
            ],200);
        }
    }

    public function getSingle(Post $post)
    {
        return response()->json([
            "status" => 200,
            "message" => "post ditemukan",
            "data" => $post
        ], 200);
    }
}
