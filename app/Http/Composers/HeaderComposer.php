<?php
    namespace App\Http\Composers;

    use Illuminate\Contracts\View\View;
    use Cart;
    use App\Models\Banner;

    class HeaderComposer
    {
        public function compose(View $view)
        {
            $count = Cart::count();
            $total = Cart::total();
            $logo =  Banner::where('status', 1)->first();

            $datas = [
                'count' => $count,
                'total' => $total,
                'logo' => $logo,
            ];

            $view->with($datas);
        }
    }
