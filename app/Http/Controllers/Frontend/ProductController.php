<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Narration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate_product;
use App\Models\Cate_post;
use App\Models\Post;
use App\Models\Product;
use App\Models\Images;

class ProductController extends Controller
{
    public function allProduct()
    {
        $product = Product::where('status', 1)->orderBy('date_update', 'DESC')->paginate(32);

        return view('frontend.products.allProduct', compact('product'));
    }

    public function productByCate($slug)
    {
        $cate_product = Cate_product::where('slug', $slug)->first();
        if ($cate_product) {
            $product = Product::where('status', 1)->where(function($query) use ($cate_product)
            {
                $query = $query->orWhere('cate_product_id',$cate_product->id);
                $con       = Cate_product::where('parent_id',$cate_product->id)->get();
                foreach ($con as $c) {
                    $query = $query->orWhere('cate_product_id',$c->id);
                }
            })->orderBy('date_update', 'DESC')->paginate(32);

            return view('frontend.products.productByCate', compact('cate_product', 'product'));
        } else {

            return view('errors.404');
        }
    }

    public function detailProduct($slug)
    {
        $detail_product = Product::where('status', 1)->where('slug', $slug)->first();
        if ($detail_product) {
            $cate_product = Cate_product::where('id', $detail_product->cate_product_id)->first();
            $epFirst = Images::where('product_id', $detail_product->id)->orderBy('ep', 'DESC')->first();
            $listEp = Images::where('product_id', $detail_product->id)->orderBy('ep', 'DESC')->get();
            $plq = Product::where('cate_product_id', $cate_product->id)->where('id', '<>', $detail_product->id)->orderBy('date_update', 'DESC')->take(24)->get();
            if ($detail_product->nhom == null) {
                $phankhac = [];
            } else {
                $phankhac = Product::where('nhom', $detail_product->nhom)->where('id', '<>', $detail_product->id)->orderBy('name', 'ASC')->get();
            }
            if ($detail_product->day_update != null) {
                $day = json_decode($detail_product->day_update);
            } else {
                $day = [];
            }
            $thuyetminh = Narration::where('product_id', $detail_product->id)->orderBy('ep', 'DESC')->get();

            return view('frontend.products.detailProduct', compact('detail_product', 'cate_product', 'epFirst', 'listEp', 'plq', 'phankhac', 'day', 'thuyetminh'));
        } else {

            return view('errors.404');
        }
    }

    public function viewMovie($slug, $slug_ep)
    {
        $movie = Product::where('slug', $slug)->first();
        if ($movie) {
            $listEp = Images::where('product_id', $movie->id)->orderBy('ep', 'DESC')->get();
            $listEpTM = Narration::where('product_id', $movie->id)->orderBy('ep', 'DESC')->get();
            $episode = Images::where('slug', $slug_ep)->where('product_id', $movie->id)->first();
            if ($episode) {
                $plq = Product::where('cate_product_id', $movie->cate_product_id)->where('id', '<>', $movie->id)->orderBy('date_update', 'DESC')->take(24)->get();
                if ($movie->nhom == null) {
                    $phankhac = [];
                } else {
                    $phankhac = Product::where('nhom', $movie->nhom)->where('id', '<>', $movie->id)->orderBy('name', 'ASC')->get();
                }
                $next = Images::where('product_id', $movie->id)->orderBy('ep', 'ASC')->where('ep', '>', $episode->ep)->first();
                $prev = Images::where('product_id', $movie->id)->orderBy('ep', 'DESC')->where('ep', '<', $episode->ep)->first();
                if ($movie->day_update != null) {
                    $day = json_decode($movie->day_update);
                } else {
                    $day = [];
                }

                return view('frontend.products.view_movie', compact('episode', 'listEp', 'movie', 'plq', 'phankhac', 'next', 'prev', 'day', 'listEpTM'));
            } else {

                return view('errors.404');
            }
        } else {

            return view('errors.404');
        }
    }

    public function getSever(Request $request)
    {
        $id    = $request->id;
        $link   = $request->link;
        $episode = Images::where('id', $id)->first();

        return $this->ajaxRespond(1, '', view('frontend.products.sever', compact('episode', 'link'))->render());
    }

    public function lichphim()
    {
        $thu23D = Product::where('cate_product_id', 2)->where('day_update', 'like', '%Mon%')->orderBy('name', 'ASC')->get();
        $thu22D = Product::where('cate_product_id', 4)->where('day_update', 'like', '%Mon%')->orderBy('name', 'ASC')->get();

        $thu23D2 = Product::where('cate_product_id', 2)->where('day_update', 'like', '%Tue%')->orderBy('name', 'ASC')->get();
        $thu22D2 = Product::where('cate_product_id', 4)->where('day_update', 'like', '%Tue%')->orderBy('name', 'ASC')->get();

        $thu23D3 = Product::where('cate_product_id', 2)->where('day_update', 'like', '%Wed%')->orderBy('name', 'ASC')->get();
        $thu22D3 = Product::where('cate_product_id', 4)->where('day_update', 'like', '%Wed%')->orderBy('name', 'ASC')->get();

        $thu23D4 = Product::where('cate_product_id', 2)->where('day_update', 'like', '%Thu%')->orderBy('name', 'ASC')->get();
        $thu22D4 = Product::where('cate_product_id', 4)->where('day_update', 'like', '%Thu%')->orderBy('name', 'ASC')->get();

        $thu23D5 = Product::where('cate_product_id', 2)->where('day_update', 'like', '%Fri%')->orderBy('name', 'ASC')->get();
        $thu22D5 = Product::where('cate_product_id', 4)->where('day_update', 'like', '%Fri%')->orderBy('name', 'ASC')->get();

        $thu23D6 = Product::where('cate_product_id', 2)->where('day_update', 'like', '%Sat%')->orderBy('name', 'ASC')->get();
        $thu22D6 = Product::where('cate_product_id', 4)->where('day_update', 'like', '%Sat%')->orderBy('name', 'ASC')->get();

        $thu23D7 = Product::where('cate_product_id', 2)->where('day_update', 'like', '%Sun%')->orderBy('name', 'ASC')->get();
        $thu22D7 = Product::where('cate_product_id', 4)->where('day_update', 'like', '%Sun%')->orderBy('name', 'ASC')->get();

        $homnay = Carbon::now()->format('D');

        return view('frontend.layouts.lichphim', compact('thu23D', 'thu22D', 'thu23D2', 'thu22D2','thu23D3', 'thu22D3','thu23D4',
            'thu22D4','thu23D5', 'thu22D5','thu23D6', 'thu22D6','thu23D7', 'thu22D7', 'homnay'));
    }

    public function viewMovieTM($slug, $slug_ep)
    {
        $movie = Product::where('slug', $slug)->first();
        if ($movie) {
            $listEp = Images::where('product_id', $movie->id)->orderBy('ep', 'DESC')->get();
            $listEpTM = Narration::where('product_id', $movie->id)->orderBy('ep', 'DESC')->get();
            $episode = Narration::where('slug', $slug_ep)->where('product_id', $movie->id)->first();
            if ($episode) {
                $plq = Product::where('cate_product_id', $movie->cate_product_id)->where('id', '<>', $movie->id)->orderBy('date_update', 'DESC')->take(24)->get();
                if ($movie->nhom == null) {
                    $phankhac = [];
                } else {
                    $phankhac = Product::where('nhom', $movie->nhom)->where('id', '<>', $movie->id)->orderBy('name', 'ASC')->get();
                }
                $next = Narration::where('product_id', $movie->id)->orderBy('ep', 'ASC')->where('ep', '>', $episode->ep)->first();
                $prev = Narration::where('product_id', $movie->id)->orderBy('ep', 'DESC')->where('ep', '<', $episode->ep)->first();
                if ($movie->day_update != null) {
                    $day = json_decode($movie->day_update);
                } else {
                    $day = [];
                }

                return view('frontend.products.view_tm', compact('episode', 'listEp', 'movie', 'plq', 'phankhac', 'next', 'prev', 'day', 'listEpTM'));
            } else {

                return view('errors.404');
            }
        } else {

            return view('errors.404');
        }
    }
}
