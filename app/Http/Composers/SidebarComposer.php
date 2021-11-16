<?php
    namespace App\Http\Composers;

    use App\Models\Product;
    use Illuminate\Contracts\View\View;
    use App\Models\Cate_product;
    use App\Models\Support;
    use App\Models\Post;
    use App\Models\Cate_post;
    use App\Models\Slide;

    class SidebarComposer
    {
        public function compose(View $view)
        {
            $sidebar = Product::where('status', 1)->where('is_home', 1)->orderBy('position', 'ASC')->take(10)->get();

            $data = [
                'sidebar' => $sidebar,
            ];

            $view->with($data);
        }
    }
