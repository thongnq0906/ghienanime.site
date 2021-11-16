<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Cate_post;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    public function listPost($slug)
    {
        $cate_post = Cate_post::where('slug', $slug)->first();
        $post = Post::orderBy('id','DESC')->where('status', 1)->where(function($query) use ($cate_post)
        {
            $query = $query->orWhere('cate_post_id',$cate_post->id);
            $con = Cate_post::where('parent_id',$cate_post->id)->get();
            foreach ($con as $dt) {
                $query = $query->orWhere('cate_post_id',$dt->id);
            }
        })->paginate(8);

        return view('frontend.posts.list', compact('post', 'cate_post'));
    }

    public function detail($slug)
    {
        $detail = Post::where('status', 1)->where('slug', $slug)->first();
        $cate_post = Cate_post::where('id', $detail->cate_post_id)->first();

        return view('frontend.posts.detail', compact('detail', 'cate_post'));
    }

    public function postSearch(Request $req)
    {
        $input  = trim($req->search);
        $product = Product::where('name', 'LIKE',"%$input%")->where('status', 1)->orWhere('name2', 'LIKE',"%$input%")->paginate(48);

        return view('frontend.layouts.search', compact('product', 'input'));
    }
}
