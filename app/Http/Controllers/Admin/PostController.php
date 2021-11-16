<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Cate_post;
use Image;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        $data = Cate_post::select('id','name','parent_id')->get();

        return view('admin.post.index', compact('post', 'data'));
    }

    public function create()
    {
        $data=Cate_post::select('id','name','parent_id')->get();
        if ($data != null) {

            return view('admin.post.create', compact('data'));
        } else {

            return redirect()->route('admin.cate_post.home')->with('error', 'Chưa có danh mục');
        }
    }

    public function postCreate(PostRequest $req)
    {
        $post               = new Post;
        $post->name         = $req['name'];
        $post->slug         = str_slug($req['name']);
        $post->cate_post_id = $req['cate_post_id'];
        $post->position     = $req['position'];
        $post->status       = (is_null($req['status']) ? '0' : '1');
        $post->is_home      = (is_null($req['is_home']) ? '0' : '1');
        $post->title        = $req['title'];
        $post->description  = $req['description'];
        $post->title_seo    = $req['title_seo'];
        $post->meta_key     = $req['meta_key'];
        $post->meta_des     = $req['meta_des'];
        if ($req->hasFile('image')) {
            $image    = $req->file('image');
            $filename = date('Y_d_m_H_i_s').'-'. $image->getClientOriginalName();
            Image::make($image)->save(public_path('upload/post/'.$filename));
            $post->image = ('upload/post/'.$filename);
        }
        $post->save();

        return redirect()->route('admin.post.index');
    }

    public function update($slug)
    {
        $data = Cate_post::select('id','name','parent_id')->get();
        $post = Post::where('slug', $slug)->first();

        return view('admin.post.edit', compact('data', 'post'));
    }

    public function postUpdate($slug, Request $req)
    {
        $post               = Post::where('slug', $slug)->first();
        $post->name         = $req['name'];
        $post->slug         = str_slug($req['name']);
        $post->cate_post_id = $req['cate_post_id'];
        $post->position     = $req['position'];
        $post->status       = (is_null($req['status']) ? '0' : '1');
        $post->is_home      = (is_null($req['is_home']) ? '0' : '1');
        $post->title        = $req['title'];
        $post->description  = $req['description'];
        $post->title_seo    = $req['title_seo'];
        $post->meta_key     = $req['meta_key'];
        $post->meta_des     = $req['meta_des'];
        if ($req->hasFile('image')){
            if (file_exists($post->image)) {
                unlink($post->image);
            }
            $image    = $req->file('image');
            $filename = date('Y_d_m_H_i_s').'-'. $image->getClientOriginalName();
            Image::make($image)->save(public_path('upload/post/'.$filename));
            $post->image = ('upload/post/'.$filename);
        }
        $validatedData = $req->validate([
            'name'     => 'required|unique:posts,name,' .$post->id,
        ]);
        $post->save();

        return redirect()->route('admin.post.index')->with('success', 'Sửa thành công');
    }

    public function destroy($id)
    {
        $result = Post::findOrFail($id);
        if (file_exists($result->image)) {
            unlink($result->image);
        }
        $result->delete();

        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function search(Request $req)
    {
        $id_cate_post = $req->cate_post;
        if ($id_cate_post == 0) {

            return redirect()->route('admin.post.index');
        }
        session()->put('id',$id_cate_post);
        $data = Cate_post::select('id','name','parent_id')->get()->toArray();
        $post = Post::orderBy('position','ASC')->where(function($query)
        {
            $pro       = $query;
            $id        = session('id');
            $cate_post = Cate_post::find($id);
            $pro = $pro->orWhere('cate_post_id',$cate_post->id); // bài viết có id của danh muc cha cấp 1.
            $com = Cate_post::where('parent_id',$cate_post->id)->get();//danh mục cha cấp 2.
            foreach ($com as $dt) {
                $pro = $pro->orWhere('cate_post_id',$dt->id);// bài viết có id của danh muc cha cấp 2.
            }
            session()->forget('id');//xóa session;
        })->get();

        return view('admin.post.search', compact('post', 'data', 'id_cate_post'));
    }

    public function checkbox(Request $req)
    {
        $checkbox = $req->checkbox;
        if (!isset($req->checkbox)) {

            return back()->with('success', 'Chưa chọn bài');
        }
        if ($req->select_action == 1) {
            $checkbox = $req->checkbox;
            foreach ($checkbox as $c) {
                $result = Post::findOrFail($c);
                if(file_exists($result->image)) {
                    unlink($result->image);
                }
                $result->delete();
            }

            return redirect()->back()->with('success', 'Xóa thành công');
        }
        if ($req->select_action == 2) {
            $checkbox = $req->checkbox;
            foreach ($checkbox as $c) {
                $result = Post::where('id', $c)->first();
                $result->status = 1;
                $result->save();
            }

            return back()->with('success', 'Thao tác thành công');
        }

        if ($req->select_action == 3) {
            $checkbox = $req->checkbox;
            foreach ($checkbox as $c) {
                $result = Post::where('id', $c)->first();
                $result->status = 0;
                $result->save();
            }

            return back()->with('success', 'Thao tác thành công');
        }
        if ($req->select_action == 0) {

            return back()->with('success', 'Chưa chọn thao tác');
        }
        if ($checkbox == NULL){

            return back()->with('success', 'Bạn chưa chọn cái nào');
        }
    }

    public function status(Request $req)
    {
        if ($req->ajax()) {
            $result = Post::find($req->id);
            if ($result->status == 0) {
                $result->status = 1;
            } else {
                $result->status = 0;
            }
            $result->save();

            return response($result);
        }
    }

    public function is_home(Request $req)
    {
        if ($req->ajax()) {
            $result = Post::find($req->id);
            if ($result->is_home == 0) {
                $result->is_home = 1;
            } else {
                $result->is_home = 0;
            }
            $result->save();

            return response($result);
        }
    }
}
