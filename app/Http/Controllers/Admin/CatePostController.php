<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate_post;
use App\Http\Requests\Cate_postRequest;
use Image;
use File;

class CatePostController extends Controller
{
    public function index()
    {
        $cate_post = Cate_post::all();

        return view('admin/cate_post/index', compact('cate_post'));
    }

    public function create()
    {
        $data=Cate_post::select('id','name','parent_id')->get();

        return view('admin/cate_post/create', compact('data'));
    }

    public function postCreate(Cate_postRequest $req)
    {
        $cate_post              = new Cate_post;
        $cate_post->name        = $req['name'];
        $cate_post->parent_id   = $req->parent_id;
        $cate_post->slug        = str_slug($cate_post->name);
        $cate_post->description = $req['description'];
        $cate_post->position    = $req['position'];
        $cate_post->status      = (is_null($req['status']) ? '0' : '1');
        $cate_post->title_seo   = $req['title_seo'];
        $cate_post->meta_key    = $req['meta_key'];
        $cate_post->meta_des    = $req['meta_des'];
        if($req->hasFile('image')){
            $image = $req->file('image');
            $filename = date('Y_d_m_H_i_s').'-'. $image->getClientOriginalName();
            Image::make($image)->save(public_path('upload/catepost/'.$filename));
            $cate_post->image = ('upload/catepost/'.$filename);
        }else{
            $cate_post->image = ('upload/catepost/avatar5.png');
        }
        $cate_post->save();

        return redirect()->route('admin.cate_post.home')->with('success','Thêm thành công');
    }

    public function update($slug)
    {
        $data      = Cate_post::select('id','name','parent_id')->get();
        $cate_post = Cate_post::where('slug', $slug)->first();

        return view('admin.cate_post.edit', compact('cate_post', 'data'));
    }

    public function postUpdate($slug, Request $req)
    {
        // $cate_product        = Cate_product::findOrFail($slug);
        $cate_post              = Cate_post::where('slug', $slug)->first();
        $cate_post->name        = $req['name'];
        $cate_post->parent_id   = $req->parent_id;
        $cate_post->slug        = str_slug($cate_post->name);
        $cate_post->position    = $req['position'];
        $cate_post->description = $req['description'];
        $cate_post->status      = (is_null($req['status']) ? '0' : '1');
        $cate_post->title_seo   = $req['title_seo'];
        $cate_post->meta_key    = $req['meta_key'];
        $cate_post->meta_des    = $req['meta_des'];
        if($req->hasFile('image')){
            if(file_exists($cate_post->image))
            {
                unlink($cate_post->image);
            }
            $image    = $req->file('image');
            $filename = date('Y_d_m_H_i_s').'-'. $image->getClientOriginalName();
            Image::make($image)->save(public_path('upload/catepost/'.$filename));

            $cate_post->image = ('upload/catepost/'.$filename);

        }
        $validatedData = $req->validate([
            'name'     => 'required|unique:cate_posts,name,' .$cate_post->id,
        ]);
        $cate_post->save();

        return redirect()->route('admin.cate_post.home')->with('success','Sửa thành công');
    }

    public function destroy($id)
    {
        $result = Cate_post::findOrFail($id);
        $result2 = Cate_post::where('parent_id', $id)->first();
        if(file_exists($result->image))
        {
            unlink($result->image);
        }
        if(isset($result2))
        {
            if(file_exists($result2->image))
            {
                unlink($result2->image);
            }
            $result2->delete();
        }
        $result->delete();

        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function status(Request $req)
    {
        if ($req->ajax())
        {
            $result = Cate_post::find($req->id);
            if ($result->status == 0)
            {
                $result->status = 1;
            } else {
                $result->status = 0;
            }
            $result->save();

            return response($result);
        }
    }
}
