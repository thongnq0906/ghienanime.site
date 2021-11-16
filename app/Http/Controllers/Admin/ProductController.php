<?php

namespace App\Http\Controllers\Admin;

use App\Models\Narration;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Models\Cate_product;
use Image, File;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\Images;
use App\Models\Check_movie;
use Goutte\Client;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use function Aws\filter;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('id', 'DESC')->get();
        $data    = Cate_product::select('id','name','parent_id')->get();

        return view('admin.product.index', compact('product', 'data'));
    }

    public function create()
    {
        $data = Cate_product::select('id','name','parent_id')->get();
        if ($data != null) {

            return view('admin.product.create', compact('data'));
        } else {

            return redirect()->route('admin.cate_product.home')->with('error', 'Chưa có danh mục');
        }
    }

    public function postCreate(ProductRequest $req)
    {
        function vn_to_str ($str){
            $unicode = array(
                'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
                'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                'd'=>'đ',
                'D'=>'Đ',
                'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                'i'=>'í|ì|ỉ|ĩ|ị',
                'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
                'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                'y'=>'ý|ỳ|ỷ|ỹ|ỵ','Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ');
            foreach($unicode as $nonUnicode=>$uni){
                $str = preg_replace("/($uni)/i", $nonUnicode, $str);
            }
            return $str;
        }

        $product                  = new Product;
        $product->name            = $req['name'];
        $product->name2            = vn_to_str($req['name']);
        $product->slug            = str_slug($req['name']);
        $product->price           = $req['price'];
        $product->cate_product_id = $req['cate_product_id'];
        $product->position        = $req['position'];
        $product->status          = 1;
        $product->is_home         = (is_null($req['is_home']) ? '0' : '1');
        $product->title           = $req['title'];
        $product->description     = $req['description'];
        $product->checkfull2     = $req['checkfull2'];
        $product->content         = $req['content'];
        $product->content2        = $req['content2'];
        $product->title_seo       = $req['title_seo'];
        $product->meta_key        = $req['meta_key'];
        $product->meta_des        = $req['meta_des'];
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $filename = date('Y_d_m_H_i_s').'-'. $image->getClientOriginalName();
            Image::make($image)->save(public_path('upload/product/'.$filename));
            $product->image = ('upload/product/'.$filename);
        }
        $product->day_update = json_encode($req['day_update']);
        $product->save();
        if ($req['name_link']) {
            foreach ($req->name_link as $key => $n)
            {
                if ($n != null && $req['link'][$key] != null) {
                    $check_link = new Check_movie;
                    $check_link->product_id = $product->id;
                    $check_link->name = $n;
                    $check_link->link = $req['link'][$key];
                    $check_link->note = $req['note_link'][$key];
                    $check_link->save();
                }
            }
        }

        return back()->with('success', 'Thành công');
    }

    public function update($id)
    {
        $data    = Cate_product::select('id','name','parent_id')->get();
        $product = Product::where('id', $id)->first();
        $img_detail = Images::where('product_id', $product->id)->get();
        if ($product->day_update == null || $product->day_update == 'null') {
            $day_update = [];
        } else {
            $day_update = json_decode($product->day_update);
        }
        $check_movie = Check_movie::where('product_id', $product->id)->get();

        return view('admin.product.edit', compact('data', 'product', 'img_detail', 'day_update', 'check_movie'));
    }

    public function postUpdate($id, Request $req)
    {
        $product                  = Product::where('id', $id)->first();
        $product->name            = $req['name'];
        $product->slug            = str_slug($req['name']);
        $product->price           = $req['price'];
        $product->cate_product_id = $req['cate_product_id'];
        $product->position        = $req['position'];
        $product->status          = (is_null($req['status']) ? '0' : '1');
        $product->is_home         = (is_null($req['is_home']) ? '0' : '1');
        $product->title           = $req['title'];
        $product->description     = $req['description'];
        $product->content         = $req['content'];
        $product->content2        = $req['content2'];
        $product->title_seo       = $req['title_seo'];
        $product->meta_key        = $req['meta_key'];
        $product->meta_des        = $req['meta_des'];
        $product->day_update = json_encode($req['day_update']);
        if ($req->hasFile('image')) {
            if(file_exists($product->image)) {
                unlink($product->image);
            }
            $image = $req->file('image');
            $filename = date('Y_d_m_H_i_s').'-'. $image->getClientOriginalName();
            Image::make($image)->save(public_path('upload/product/'.$filename));
            $product->image = ('upload/product/'.$filename);
        }
        $validatedData = $req->validate([
            'name'     => 'required|unique:products,name,' .$product->id,
            'price'    => 'numeric|nullable|min:0',
        ]);
        $check_movie = Check_movie::where('product_id', $product->id)->get();
        foreach ($check_movie as $ch) {
            $ch->delete();
        }
        $product->save();
        if ($req['name_link']) {
            foreach ($req->name_link as $key => $n)
            {
                if ($n != null && $req['link'][$key] != null) {
                    $check_link = new Check_movie;
                    $check_link->product_id = $product->id;
                    $check_link->name = $n;
                    $check_link->link = $req['link'][$key];
                    $check_link->note = $req['note_link'][$key];
                    $check_link->save();
                }
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Sửa thành công');
    }

    public function destroy($id)
    {
        $result = Product::findOrFail($id);
        $img = Images::where('product_id', $result->id)->get();
        if (file_exists($result->image)) {
            unlink($result->image);
        }
        foreach ($img as $key => $i) {
            $i->delete();
        }
        $result->delete();

        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function delImage(Request $request)
    {
        $del = Images::find($request->id);
        $path = $del->name;
        if(File::exists($path)) {
            File::delete($path);
        }
        $del->delete();
        echo "Xóa thành công";
    }

    public function search(Request $req)
    {
        $product = Product::orderBy('name', 'ASC')->get();

        /*$id_cate_product = $req->cate_product;
        if($id_cate_product == 0){
            return redirect()->route('admin.product.index');
        }
        session()->put('id',$id_cate_product);
        $data    = Cate_product::select('id','name','parent_id')->get()->toArray();
        $product = Product::orderBy('position','ASC')->where(function($query)
        {
            $pro = $query;
            $id  = session('id');
            $cate_product = Cate_product::find($id);
            $pro = $pro->orWhere('cate_product_id',$cate_product->id); // bài viết có id của danh muc cha cấp 1.
            $com = Cate_product::where('parent_id',$cate_product->id)->get();//danh mục cha cấp 2.

            foreach ($com as $dt) {
                $pro = $pro->orWhere('cate_product_id',$dt->id);// bài viết có id của danh muc cha cấp 2.
            }
            session()->forget('id');//xóa session;
        })->get();*/

        return view('admin.product.search', compact('product'));
    }

    public function gomnhom(Request $req)
    {
        $nhom = $req['nhom'];
        $product_id = $req['chon'];
        $name_phan = array_filter($req['phan']);
        $i = 0;
        foreach ($name_phan as $key => $n) {
            $product = Product::where('id', $product_id[$i])->first();
            $product->nhom = $nhom;
            $product->ten_phan = $n;
            $product->save();
            $i++;
        }
        return back();
    }

    public function checkbox(Request $req)
    {
        $checkbox = $req->checkbox;
        if(!isset($req->checkbox))
        {

            return back()->with('success', 'Chưa chọn sản phẩm');
        }
        if($req->select_action == 1)
        {
            $checkbox = $req->checkbox;
            foreach ($checkbox as $c) {
                $result = Product::findOrFail($c);
                if(file_exists($result->image))
                {
                    unlink($result->image);
                }
                $result->delete();
            }

            return redirect()->back()->with('success', 'Xóa thành công');
        }
        if($req->select_action == 2)
        {
            $checkbox = $req->checkbox;
            foreach ($checkbox as $c) {
                $result         = Product::where('id', $c)->first();
                $result->status = 1;
                $result->save();
            }

            return back()->with('success', 'Thao tác thành công');
        }
        if($req->select_action == 3)
        {
            $checkbox = $req->checkbox;
            foreach ($checkbox as $c) {
                $result         = Product::where('id', $c)->first();
                $result->status = 0;
                $result->save();
            }

            return back()->with('success', 'Thao tác thành công');
        }
        if($req->select_action == 0)
        {

            return back()->with('success', 'Chưa chọn thao tác');
        }
        if($checkbox == NULL){

            return back()->with('success', 'Bạn chưa chọn cái nào');
        }
    }

    public function status(Request $req)
    {
        if ($req->ajax())
        {
            $result = Product::find($req->id);
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

    public function is_home(Request $req)
    {
        if ($req->ajax())
        {
            $result = Product::find($req->id);
            if ($result->is_home == 0)
            {
                $result->is_home = 1;
            } else {
                $result->is_home = 0;
            }
            $result->save();

            return response($result);
        }
    }

    public function checkFull(Request $req)
    {
        $result         = Product::where('id', $req->product_id)->first();
        $result->check_full = $req->checkbox;
        $result->save();
        return back();
    }

    public function chuaXong()
    {
        $product = Product::orderBy('date_update', 'DESC')->where('check_full', null)->where('status_update', 1)->get();
        $data    = Cate_product::select('id','name','parent_id')->get();
        $homnaylathu = Carbon::now()->format('D');
        /*$cc = Product::orderBy('date_update', 'DESC')->where('check_full', null)->where('status_update', 2)->get();
        foreach ($cc as $pr) {
            if ($pr->day_update == 'null' || $pr->day_update == null) {
                $ml = [];
            } else {
                $ml = json_decode($pr->day_update);
            }
            if (in_array($homnaylathu, $ml)) {

            } else {
                $pr->status_update = 1;
                $pr->save();
            }
        }*/

        return view('admin.product.updating', compact('product', 'data', 'homnaylathu'));
    }

    public function checkNinja()
    {
        $product = Product::orderBy('date_update', 'DESC')->where('check_full', null)->where('status_update', 1)->get();

        foreach ($product as $p)
        {
            $linkNinja = Check_movie::where('product_id', $p->id)->where('link', 'like', '%hhninja%')->first();
            if ($linkNinja) {
                $client = new Client();
                $crawler = $client->request('GET', $linkNinja->link);
                $crawler->filter('strike')->each(function ($node) use ($p){
                    $text = $node->text();
                    $cut = explode('p ', $text)[1];
                    $cut2 = explode(' ∕', $cut)[0];
                    $p->ep_ninja = intval($cut2);
                    $p->save();
                });
            }
        }

        return redirect()->route('admin.product.chua_xong');
    }

    public function crawNinja()
    {
        $product = Product::orderBy('date_update', 'DESC')->where('check_full', null)->where('status_update', 1)->whereColumn('ep_ninja', '>', 'ep')->get();
        foreach ($product as $p)
        {
            $tap = $p->ep;
            $tapNinja = $p->ep_ninja;
            $linkNinja = Check_movie::where('product_id', $p->id)->where('link', 'like', '%hhninja%')->first();
            if ($linkNinja) {
                $client = new Client();
                $crawler = $client->request('GET', $linkNinja->link);
                $link = "https://www.hhninja.xyz".$crawler->filter('.btn-group a')->attr('href');

                $client2 = new Client();
                $crawler2 = $client2->request('GET', $link);
                $crawler2->filter('.post-content > script')->last()->each(function ($node) use ($tap, $tapNinja, $p){
                    $text = $node->text();
                    for ($i=$tap+1; $i<=$tapNinja; $i++)
                    {
                        if (strpos($text, 'link_1_'.$i.' = "') !== false) {
                            $cut = explode('link_1_'.$i.' = "', $text)[1];
                            $link1 = explode('"', $cut)[0];
                            $cut = explode('link_2_'.$i.' = "', $text)[1];
                            $link2 = explode('"', $cut)[0];
                            $cut = explode('link_3_'.$i.' = "', $text)[1];
                            $link3 = explode('"', $cut)[0];
                            $cut = explode('link_4_'.$i.' = "', $text)[1];
                            $link4 = explode('"', $cut)[0];

                            $episode                  = new Images;
                            $episode->slug            = 'tap-'.$i;
                            $episode->ep           = $i;
                            $episode->link1           = $link1;
                            $episode->link2           = $link2;
                            $episode->link3           = $link3;
                            $episode->link4           = $link4;
                            $episode->product_id = $p->id;
                            $episode->save();

                            $p->date_update = Carbon::now();
                            $p->ep = $i;
                            $p->save();
                        }
                    }
                });
            }
        }

        return back()->with('success', 'Xong xuôi');
    }

    public function full()
    {
        $product = Product::orderBy('id', 'DESC')->where('check_full', 1)->get();
        $data    = Cate_product::select('id','name','parent_id')->get();

        return view('admin.product.index', compact('product', 'data'));
    }

    public function comingsoon()
    {
        $product = Product::orderBy('id', 'DESC')->where('check_full', 3)->get();
        $data    = Cate_product::select('id','name','parent_id')->get();

        return view('admin.product.index', compact('product', 'data'));
    }

    public function SetStatusUpdate($id, Request $req)
    {
        $product = Product::where('id', $id)->first();
        $product->status_update = $req['status_update'];
        $product->save();

        return back()->with('success', 'Thành công');
    }

    public function crawAnimehay()
    {
        $product = Product::orderBy('date_update', 'DESC')->get();
        foreach ($product as $p)
        {
            $linkAnime = Check_movie::where('product_id', $p->id)->where('link', 'like', '%animehay%')->first();
            if ($linkAnime) {
                $client = new Client();
                $crawler = $client->request('GET', $linkAnime->link);
                $getLink = $crawler->filter('.list-item-episode a')->each(function ($node) {

                    return $node->attr('href');
                });
                $tongtap = count($getLink);
                foreach ($getLink as $key => $link) {
                    $crawler2 = $client->request('GET', $link);
                    $crawler2->filter('body')->each(function ($node) use ($key, $tongtap, $p){
                        $text = $node->text();
                        if (strpos($text, 'source_fbo: [{"file":"') !== false) {
                            $cut = explode('source_fbo: [{"file":"', $text)[1];
                            $vip = explode('"}]', $cut)[0];
                            $tap = $tongtap - $key;
                            $episode = Images::where('product_id', $p->id)->where('ep', $tap)->first();
                            if ($episode) {
                                $episode->vip           = $vip;
                                $episode->save();
                            }
                        }
                    });
                }
            }
        }

        return view('admin.product.test');
    }

    public function createAnimehay()
    {
        $product = Product::where('cate_product_id', 5)->orderBy('id', 'desc')->take(10)->get();
        foreach ($product as $p) {
            try {
                $client = new Client();
                $crawler = $client->request('GET', $p->url);
                $getLink = $crawler->filter('.list-item-episode a')->each(function ($node) {
                    return $node->attr('href');
                });
                $tongtap = count($getLink);
                foreach ($getLink as $key => $link) {
                    try {
                        $crawler2 = $client->request('GET', $link);
                        $html = '';
                        foreach ($crawler2 as $domElement) {
                            $html .= $domElement->ownerDocument->saveHTML($domElement);
                        }
                        if (strpos($html, 'source_fbo: [{"file":"') !== false) {
                            $cut = explode('source_fbo: [{"file":"', $html)[1];
                            $vip = explode('"}]', $cut)[0];
                        } else {
                            $vip = null;
                        }
                        if (strpos($html, "case 'Hydrax'") !== false) {
                            $cut2 = explode("case 'Hydrax'", $html)[1];
                            if (strpos($cut2, 'src="') !== false) {
                                $cut3 = explode('src="', $cut2)[1];
                                $link1 = explode('"', $cut3)[0];
                                $tap = $tongtap - $key;
                                $name = $crawler2->filter('.fs-17 .fw-700')->first()->text();

                                $episode                  = new Images;
                                $episode->slug            = 'tap-'.$tap;
                                $episode->name            = $name;
                                $episode->ep           = $tap;
                                $episode->vip           = $vip;
                                $episode->link1           = $link1;
                                $episode->product_id = $p->id;
                                $episode->save();
                            }
                        }
                    } catch (Exception $e) {
                        \Log::error($e->getMessage().$link);
                        continue;
                    }
                }
            } catch (Exception $e) {
                $link_error = $p->url;
                \Log::error($e->getMessage().$link_error);
                continue;
            }
        }
        dd(1);

        return view('admin.product.test');
    }

    function array_flatten($array) {
        if (!is_array($array)) {
            return FALSE;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value));
            }
            else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function createTvhay()
    {
        $product = Product::orderBy('id', 'DESC')->get();
        foreach ($product as $p)
        {
            $linkTvhay = Check_movie::where('product_id', $p->id)->where('link', 'like', '%tvhai%')->first();
            if ($linkTvhay) {
                $client = new Client();
                $crawler = $client->request('GET', $linkTvhay->link);
                $getLink = $crawler->filter('.server')->each(function ($node) {
                    $text = $node->filter('.label')->text();
                    if ($text == "H.PRO:") {
                        $link = $node->filter('.episodelist li a')->each(function ($ccc){
                            return $ccc->attr('href');
                        });
                        return $link;
                    } else {
                        return null;
                    }
                });
                $linksH = array_flatten(array_filter($getLink));
                if ($linksH == null) {
                    $client2 = new Client();
                    $crawler2 = $client2->request('GET', $linkTvhay->link);
                    $getLink = $crawler2->filter('.server')->each(function ($node) {
                        $text = $node->filter('.label')->text();
                        if ($text == "R.PRO:") {
                            $link = $node->filter('.episodelist li a')->each(function ($ccc){
                                return $ccc->attr('href');
                            });
                            return $link;
                        } else {
                            return null;
                        }
                    });
                    $linksR = array_flatten(array_filter($getLink));
                    $tongtap = count($linksR);
                    foreach ($linksR as $key => $link) {
                        $tap = $key+1;
                        $crawler2 = $client->request('GET', $link);
                        $html = '';
                        foreach ($crawler2 as $domElement) {
                            $html .= $domElement->ownerDocument->saveHTML($domElement);
                        }
                        if (strpos($html, 'embedss.php?link=') !== false) {
                            $cut = explode('embedss.php?link=', $html)[1];
                            $vip = explode('"', $cut)[0];
                            $episode                  = new Narration;
                            $episode->slug            = 'tap-'.$tap;
                            $episode->ep           = $tap;
                            $episode->link2           = $vip;
                            $episode->product_id = $p->id;
                            $episode->save();
                        }
                    }
                } else {
                    $tongtap = count($linksH);

                    foreach ($linksH as $key => $link) {
                        $tap = $key+1;
                        $crawler2 = $client->request('GET', $link);
                        $html = '';
                        foreach ($crawler2 as $domElement) {
                            $html .= $domElement->ownerDocument->saveHTML($domElement);
                        }
                        if (strpos($html, 'embedss.php?link=') !== false) {
                            $cut = explode('embedss.php?link=', $html)[1];
                            $vip = explode('"', $cut)[0];
                            $episode                  = new Narration;
                            $episode->slug            = 'tap-'.$tap;
                            $episode->ep           = $tap;
                            $episode->link1           = $vip;
                            $episode->product_id = $p->id;
                            $episode->save();
                        }
                    }
                    $client4 = new Client();
                    $crawler4 = $client4->request('GET', $linkTvhay->link);
                    $getLink = $crawler4->filter('.server')->each(function ($node) {
                        $text = $node->filter('.label')->text();
                        if ($text == "R.PRO:") {
                            $link = $node->filter('.episodelist li a')->each(function ($ccc){
                                return $ccc->attr('href');
                            });
                            return $link;
                        } else {
                            return null;
                        }
                    });
                    $linksR = array_flatten(array_filter($getLink));
                    if ($linksR !=null) {
                        foreach ($linksR as $key => $link) {
                            $tap = $key+1;
                            $crawler5 = $client->request('GET', $link);
                            $html = '';
                            foreach ($crawler5 as $domElement) {
                                $html .= $domElement->ownerDocument->saveHTML($domElement);
                            }
                            if (strpos($html, 'embedss.php?link=') !== false) {
                                $cut = explode('embedss.php?link=', $html)[1];
                                $vip = explode('"', $cut)[0];
                                $episode = Narration::where('ep', $tap)->where('product_id', $p->id)->first();
                                $episode->link2           = $vip;
                                $episode->save();
                            }
                        }
                    }
                }
                \Log::info("thành công");
            }
        }

        return view('admin.product.test', compact('product'));
    }
}
