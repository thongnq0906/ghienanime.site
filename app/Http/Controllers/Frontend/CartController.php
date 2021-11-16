<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;
use App\Http\Requests\OrderRequest;
use App\Models\Bill;
use App\Models\BillDetail;
use Session;

class CartController extends Controller
{
    public function index()
    {
        $content = Cart::content();
        $total   = Cart::total();

        return view('frontend.carts.index', compact('content', 'total'));
    }

    public function addCart($id, Request $req)
    {
        $query = Product::where('id', $id)->first();
        if($req->quantity == null)
        {
            Cart::add(array(
                'id'      => $query->id,
                'name'    => $query->name,
                'qty'     => 1,
                'price'   => $query->price,
                'options' => array('img' => $query->image),
            ));

            return redirect()->route('cart.index');
        }else{
            Cart::add(array(
                'id'      => $query->id,
                'name'    => $query->name,
                'qty'     => $req->quantity,
                'price'   => $query->price,
                'options' => array('img' => $query->image),
            ));

            return redirect()->route('cart.index');
        }

    }

    public function updateCart(Request $request)
    {
        $id    = $request->id;
        $qty   = $request->qty;
        $rowId = $request->rowId;
        Cart::update($rowId,$qty);
        $data['TongGiaTriDonHang'] = Cart::total();
        foreach (Cart::content() as $key => $value) {
            if($value->rowId ==  $rowId)
            {
                $data['TongTien'] = number_format($value->price*$value->qty).'VND';
            }
        }
        echo json_encode($data);
    }

    public function destroyCart($id)
    {
        Cart::remove($id);

        return back();
    }

    public function order()
    {
        $total   = Cart::total();

        return view('frontend.carts.order', compact('total'));
    }

    public function postOrder(OrderRequest $req)
    {
        $content = Cart::content();
        $total   = Cart::total(null,null,'');
        // dd($total);
        if ($total > 0)
        {
            $bill          = new Bill;
            $bill->name    = $req['name'];
            $bill->email   = $req['email'];
            $bill->address = $req['address'];
            $bill->phone   = $req['phone'];
            $bill->total   = $total;
            $bill->note    = $req['note'];
            $bill->payment = $req['payment'];
            $bill->status  = 1;
            $bill->save();

            foreach ($content as $c) {
                $bill_detail             = new BillDetail;
                $bill_detail->bill_id    = $bill->id;
                $bill_detail->product_id = $c->id;
                $bill_detail->product_id = $c->id;
                $bill_detail->quantity   = $c->qty;
                $bill_detail->price      = $c->price;
                $bill_detail->save();
            }
            Session::forget('cart');

            return view('frontend.layouts.cart_success');
        }else{

            return back()->with('message', 'Giỏ hàng rỗng, xin vui lòng thêm sản phẩm rồi đặt hàng');
        }

        return back();
    }
}
