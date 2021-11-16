<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Cate_product, Product, Slide};

class HomeController extends Controller
{
    public function index()
    {
        $movieHot = Product::where('status', 1)->where('is_home', 1)->orderBy('position', 'ASC')->take(16)->get();
        $cate_product = Cate_product::orderBy('position', 'ASC')->get();
        $comingson = Slide::where('status', 1)->orderBy('position', 'ASC')->where('dislay', 1)->get();

        return view('frontend.layouts.home', compact('movieHot', 'comingson', 'cate_product'));
    }
}
