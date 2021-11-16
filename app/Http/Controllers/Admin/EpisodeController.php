<?php

namespace App\Http\Controllers\Admin;

use App\Models\Narration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Models\Cate_product;
use Image, File;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\Images;
use Carbon\Carbon;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class EpisodeController extends Controller
{
    public function index($id)
    {
        $list = Images::where('product_id', $id)->orderBy('ep', 'ASC')->get();
        $thuyetminh = Narration::where('product_id', $id)->orderBy('ep', 'ASC')->get();
        $movies = Product::where('id', $id)->first();

        return view('admin.episode.index', compact('list', 'id', 'movies', 'thuyetminh'));
    }

    public function create(Request $req)
    {
        $episode                  = new Images;
        $episode->slug            = 'tap-'.$req['ep'];
        $episode->ep           = $req['ep'];
        $episode->link1           = $req['link1'];
        $episode->vip           = $req['vip'];
        $episode->link2           = $req['link2'];
        $episode->link3           = $req['link3'];
        $episode->link4           = $req['link4'];
        $episode->note           = $req['note'];
        $episode->product_id = $req['product_id'];

        $episode->save();

        $product = Product::where('id', $episode->product_id)->first();
        $ep = Images::where('product_id', $product->id)->orderBy('ep', 'DESC')->first();
        if ($ep) {
            $product->ep = $ep->ep;
        }
        $product->date_update = Carbon::now();
        $product->check_full = null;
        $product->save();

        return back()->with('success', 'Thêm thành công');
    }

    public function edit($id, $ep_id)
    {
        $list = Images::where('product_id', $id)->orderBy('id', 'ASC')->get();
        $episode = Images::where('id', $ep_id)->first();
        $movies = Product::where('id', $id)->first();

        return view('admin.episode.edit', compact('list', 'id', 'ep_id', 'episode', 'movies'));
    }

    public function postEdit(Request $req)
    {
        $episode                  = Images::where('id', $req->ep_id)->first();
        $episode->slug            = 'tap-'.$req['ep'];
        $episode->ep           = $req['ep'];
        $episode->vip           = $req['vip'];
        $episode->link1           = $req['link1'];
        $episode->link2           = $req['link2'];
        $episode->link3           = $req['link3'];
        $episode->link4           = $req['link4'];
        $episode->note           = $req['note'];

        /*$validatedData = $req->validate([
            'ep'     => 'required|unique:images,ep,' .$episode->id,
        ]);*/
        $episode->save();

        $product = Product::where('id', $episode->product_id)->first();
        $ep = Images::where('product_id', $product->id)->orderBy('ep', 'DESC')->first();
        if ($ep) {
            $product->ep = $ep->ep;
        }
        $product->save();

        return back()->with('success', 'Sửa thành công');
    }

    public function dellEp($id)
    {
        $result = Images::findOrFail($id);
        $result->delete();

        $product = Product::where('id', $result->product_id)->first();
        $ep = Images::where('product_id', $product->id)->orderBy('ep', 'DESC')->first();
        if ($ep) {
            $product->ep = $ep->ep;
        }
        $product->save();

        return redirect()->route('admin.product.episode.index', $result->product_id)->with('success', 'Xóa thành công');
    }

    public function import(Request $req)
    {
        $data = $req->product_id;
        $validatedData = $req->validate([
            'file'     => 'required|mimes:xlsx',
        ]);
        Excel::import(new ProductsImport($data), $req->file, $data);

        return back()->with('success', 'All good!');
    }

    public function  hackAnimehay(Request $req)
    {
        $tap = $req->tap;
        $link = $req->link;
        $product_id = $req->product_id;

        return view('admin.episode.hack_animehay', compact('tap', 'link', 'product_id'));
    }

    public function  postHackAnimehay(Request $req)
    {
        $sotap = (int)$req->sotap;
        for ($i = 1; $i <= $sotap; $i++)
        {
            if ($req->link1[$i-1] != null || $req->link2[$i-1] != null || $req->link3[$i-1] != null || $req->link4[$i-1] != null) {
                $episode                  = new Images;
                $episode->slug            = 'tap-'.$i;
                $episode->ep           = $i;
                $episode->link1           = $req->link1[$i-1];
                $episode->link2           = $req->link2[$i-1];
                $episode->link3           = $req->link3[$i-1];
                $episode->link4           = $req->link4[$i-1];
                $episode->note           = $req['note'];
                $episode->product_id = $req['product_id'];
                $episode->save();
                $product = Product::where('id', $episode->product_id)->first();
                $product->date_update = Carbon::now();
                $product->check_full = null;
                $product->save();
            }
        }

        return redirect()->route('admin.product.episode.index', $req['product_id'])->with('success', 'Xong rồi đó');

    }

    public function createTM(Request $req)
    {
        $episode                  = new Narration;
        $episode->slug            = 'tap-'.$req['ep'];
        $episode->ep           = $req['ep'];
        $episode->link1           = $req['link1'];
        $episode->link2           = $req['link2'];
        $episode->note           = $req['note'];
        $episode->product_id = $req['product_id'];
        $episode->save();


        return back()->with('success', 'Thêm thành công');
    }

    public function editTM($id, $ep_id)
    {
        $list = Narration::where('product_id', $id)->orderBy('id', 'ASC')->get();
        $episode = Narration::where('id', $ep_id)->first();
        $movies = Product::where('id', $id)->first();

        return view('admin.episode.edit_tm', compact('list', 'id', 'ep_id', 'episode', 'movies'));
    }

    public function postEditTM(Request $req)
    {
        $episode                  = Narration::where('id', $req->ep_id)->first();
        $episode->slug            = 'tap-'.$req['ep'];
        $episode->link1           = $req['link1'];
        $episode->link2           = $req['link2'];
        $episode->note           = $req['note'];
        $episode->save();

        return back()->with('success', 'Sửa thành công');
    }

    public function dellEpTM($id)
    {
        $result = Narration::findOrFail($id);
        $result->delete();

        return redirect()->route('admin.product.episode.index', $result->product_id)->with('success', 'Xóa thành công');
    }


}
