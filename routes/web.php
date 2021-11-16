<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'web'], function() {
    Route::get('loginadmin', 'Admin\LoginController@getLogin')->name('admin.getLogin');
    Route::post('loginadmin', 'Admin\LoginController@postLogin')->name('admin.postLogin');
    Route::get('/', 'Frontend\HomeController@index')->name('index');
    Route::get('gioi-thieu', 'Frontend\IntroController@index')->name('intro');
    Route::get('lich-phim', 'Frontend\ProductController@lichphim')->name('lich_phim');
    Route::get('lien-he', 'Frontend\ContactController@index')->name('contact');
    Route::post('lien-he', 'Frontend\ContactController@postContact')->name('post_contact');
    Route::get('tim-kiem', 'Frontend\PostController@postSearch')->name('postSearch');
    Route::group(['prefix' => 'phim-hoat-hinh'], function() {
        Route::get('/', 'Frontend\ProductController@allProduct')->name('allProduct');
        Route::get('/{slug}', 'Frontend\ProductController@productByCate')->name('productByCate');
        Route::get('/xem-phim/{slug}', 'Frontend\ProductController@detailProduct')->name('detail_product');
        Route::get('/xem-phim/{slug}/{slug_ep}', 'Frontend\ProductController@viewMovie')->name('view_movie');
        Route::get('/xem-phim-thuyet-minh/{slug}/{slug_ep}', 'Frontend\ProductController@viewMovieTM')->name('view_movie_tm');
        Route::get('/get-server/dm/cc/lol', 'Frontend\ProductController@getSever')->name('getSever');
    });
    Route::group(['prefix' => 'bai-viet'], function() {
        Route::get('/{slug}', 'Frontend\PostController@listPost')->name('list_post');
        Route::get('/chi-tiet/{slug}', 'Frontend\PostController@detail')->name('detail');
    });
    Route::group(['prefix' => 'cart'], function() {
        Route::get('/', 'Frontend\CartController@index')->name('cart.index');
        Route::get('add-cart/{id}', 'Frontend\CartController@addCart')->name('add-cart');
        Route::get('destroy-cart/{id}', 'Frontend\CartController@destroyCart')->name('destroy_cart');
        Route::get('order', 'Frontend\CartController@order')->name('order');
        Route::post('order', 'Frontend\CartController@postOrder')->name('postOrder');
        Route::get('update', 'Frontend\CartController@updateCart')->name('updateCart');
    });
});

Route::group(['middleware' => ['adminLogin', 'web']], function() {
    Route::get('ckfinder-customer', 'Admin\CkfinderController@ckfinderView')->name('ckfinder-customer');
    Route::any('connector', 'Admin\CkfinderController@connector')->name('kakaka');
    Route::group(['prefix' => 'admin'], function() {
        Route::get('/home', function () {return view('admin/index');})->name('admin.index');
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('log-view');
        Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');
        Route::group(['prefix' => 'cart'], function() {
            Route::get('bill', 'Admin\OrderController@order')->name('admin.order');
            Route::get('bill/{id}', 'Admin\OrderController@bill')->name('admin.bill');
            Route::get('order/destroy/{id}', 'Admin\OrderController@destroyOrder')->name('admin.destroyOrder');
            Route::post('postStatus/{id}', 'Admin\OrderController@postStatus')->name('admin.postStatus');
            Route::post('/checkbox', 'Admin\OrderController@checkbox')->name('admin.cart.checkbox');
        });
        Route::group(['prefix' => 'cate_product'], function() {
            Route::get('/', 'Admin\CateProductController@index')->name('admin.cate_product.home');
            Route::get('/create', 'Admin\CateProductController@create')->name('admin.cate_product.create');
            Route::post('/create', 'Admin\CateProductController@postCreate')->name('admin.cate_product.createPost');
            Route::get('/update/{slug}', 'Admin\CateProductController@update')->name('admin.cate_product.update');
            Route::post('/update/{slug}', 'Admin\CateProductController@postUpdate')->name('admin.cate_product.postUpdate');
            Route::get('/destroy/{id}', 'Admin\CateProductController@destroy')->name('admin.cate_product.destroy');
            Route::post('/status', 'Admin\CateProductController@status')->name('admin.cate_product.status');
        });
        Route::group(['prefix' => 'product'], function() {
            Route::get('/', 'Admin\ProductController@index')->name('admin.product.index');
            Route::get('/chua-xong', 'Admin\ProductController@chuaXong')->name('admin.product.chua_xong');
            Route::post('/set_status_update/{id}', 'Admin\ProductController@SetStatusUpdate')->name('set_status_update');
            Route::get('/full', 'Admin\ProductController@full')->name('admin.product.full');
            Route::get('/comingsoon', 'Admin\ProductController@comingsoon')->name('admin.product.comingsoon');
            Route::get('/create', 'Admin\ProductController@create')->name('admin.product.create');
            Route::post('/create', 'Admin\ProductController@postCreate')->name('admin.product.createPost');
            Route::get('/update/{id}', 'Admin\ProductController@update')->name('admin.product.update');
            Route::post('/update/{id}', 'Admin\ProductController@postUpdate')->name('admin.product.postUpdate');
            Route::get('/destroy/{id}', 'Admin\ProductController@destroy')->name('admin.product.destroy');
            Route::get('/search', 'Admin\ProductController@search')->name('admin.product.search');
            Route::post('/gomnhom', 'Admin\ProductController@gomnhom')->name('gomnhom');
            Route::post('/checkbox', 'Admin\ProductController@checkbox')->name('checkbox');
            Route::post('/status', 'Admin\ProductController@status')->name('admin.product.status');
            Route::post('/is_home', 'Admin\ProductController@is_home')->name('admin.product.is_home');
            Route::get('delImage','Admin\ProductController@delImage')->name('admin.product.dellimg');
            Route::post('delImage','Admin\ProductController@checkFull')->name('admin.product.check_full');
            Route::post('import','Admin\EpisodeController@import')->name('import');
            Route::group(['prefix' => 'episode'], function() {
                Route::get('hack-animehay','Admin\EpisodeController@hackAnimehay')->name('hack-animehay');
                Route::post('hack-animehay','Admin\EpisodeController@postHackAnimehay')->name('post-hack-animehay');
                Route::get('/{id}', 'Admin\EpisodeController@index')->name('admin.product.episode.index');
                Route::post('/create', 'Admin\EpisodeController@create')->name('admin.product.episode.create');
                Route::get('/{id}/{ep_id}', 'Admin\EpisodeController@edit')->name('admin.product.episode.edit');
                Route::post('/{id}/{ep_id}', 'Admin\EpisodeController@postEdit')->name('admin.product.episode.postEdit');
                Route::get('/destroy/ep/{id}', 'Admin\EpisodeController@dellEp')->name('admin.product.episode.dellEp');
                Route::post('import','Admin\EpisodeController@import')->name('import');

            });
            Route::group(['prefix' => 'thuyetminh'], function() {
                Route::post('/create', 'Admin\EpisodeController@createTM')->name('admin.product.episode.create_tm');
                Route::get('/{id}/{ep_id}', 'Admin\EpisodeController@editTM')->name('admin.product.episode.edit_tm');
                Route::post('/{id}/{ep_id}', 'Admin\EpisodeController@postEditTM')->name('admin.product.episode.postEditTM');
                Route::get('/destroy/ep/{id}', 'Admin\EpisodeController@dellEpTM')->name('admin.product.episode.dellEpTM');
            });
            Route::get('/check-ninja', 'Admin\ProductController@checkNinja')->name('check_ninja');
            Route::get('/craw-ninja', 'Admin\ProductController@crawNinja')->name('craw_ninja');
            Route::get('/craw-animehay', 'Admin\ProductController@crawAnimehay')->name('craw_animehay');
            Route::get('/create-animehay', 'Admin\ProductController@createAnimehay')->name('create_animehay');
            Route::get('/create-tvhay', 'Admin\ProductController@createTvhay')->name('create_tvhay');
        });
        Route::group(['prefix' => 'cate_post'], function() {
            Route::get('/', 'Admin\CatePostController@index')->name('admin.cate_post.home');
            Route::get('/create', 'Admin\CatePostController@create')->name('admin.cate_post.create');
            Route::post('/create', 'Admin\CatePostController@postCreate')->name('admin.cate_post.createPost');
            Route::get('/update/{slug}', 'Admin\CatePostController@update')->name('admin.cate_post.update');
            Route::post('/update/{slug}', 'Admin\CatePostController@postUpdate')->name('admin.cate_post.postUpdate');
            Route::get('/destroy/{id}', 'Admin\CatePostController@destroy')->name('admin.cate_post.destroy');
            Route::post('/status', 'Admin\CatePostController@status')->name('admin.cate_post.status');
        });
        Route::group(['prefix' => 'post'], function() {
            Route::get('/', 'Admin\PostController@index')->name('admin.post.index');
            Route::get('/create', 'Admin\PostController@create')->name('admin.post.create');
            Route::post('/create', 'Admin\PostController@postCreate')->name('admin.post.createPost');
            Route::get('/update/{slug}', 'Admin\PostController@update')->name('admin.post.update');
            Route::post('/update/{slug}', 'Admin\PostController@postUpdate')->name('admin.post.postUpdate');
            Route::get('/destroy/{id}', 'Admin\PostController@destroy')->name('admin.post.destroy');
            Route::get('/search', 'Admin\PostController@search')->name('admin.post.search');
            Route::post('/checkbox', 'Admin\PostController@checkbox')->name('post.checkbox');
            Route::post('/status', 'Admin\PostController@status')->name('admin.post.status');
            Route::post('/is_home', 'Admin\PostController@is_home')->name('admin.post.is_home');
        });
        Route::group(['prefix' => 'intro'], function() {
            Route::get('/', 'Admin\IntroController@index')->name('admin.intro.index');
            // Route::get('data', 'Admin\IntroController@loadData')->name('admin.intro.loadData');
            // Route::post('store', 'Admin\IntroController@store')->name('admin.intro.store');
            // Route::post('delete', 'Admin\IntroController@delete')->name('admin.intro.delete');
            // Route::get('getUpdate', 'Admin\IntroController@getUpdate')->name('admin.intro.getUpdate');
            // Route::post('updates', 'Admin\IntroController@updates')->name('admin.intro.updates');
            Route::get('/create', 'Admin\IntroController@create')->name('admin.intro.create');
            Route::post('/create', 'Admin\IntroController@postCreate')->name('admin.intro.createPost');
            Route::get('/update/{slug}', 'Admin\IntroController@update')->name('admin.intro.update');
            Route::post('/update/{slug}', 'Admin\IntroController@postUpdate')->name('admin.intro.postUpdate');
            Route::get('/destroy/{slug}', 'Admin\IntroController@destroy')->name('admin.intro.destroy');
            Route::post('/status', 'Admin\IntroController@status')->name('admin.intro.status');

        });
        Route::group(['prefix' => 'contact'], function() {
            Route::get('/', 'Admin\ContactController@index')->name('admin.contact.index');
            Route::get('/destroy/{id}', 'Admin\ContactController@destroy')->name('admin.contact.destroy');
        });
        Route::group(['prefix' => 'slide'], function() {
            Route::get('/', 'Admin\SlideController@index')->name('admin.slide.index');
            Route::get('/create', 'Admin\SlideController@create')->name('admin.slide.create');
            Route::post('/create', 'Admin\SlideController@postCreate')->name('admin.slide.createPost');
            Route::get('/update/{id}', 'Admin\SlideController@update')->name('admin.slide.update');
            Route::post('/update/{id}', 'Admin\SlideController@postUpdate')->name('admin.slide.postUpdate');
            Route::get('/destroy/{id}', 'Admin\SlideController@destroy')->name('admin.slide.destroy');
            Route::post('/status', 'Admin\SlideController@status')->name('admin.slide.status');
        });
        Route::group(['prefix' => 'administrator'], function() {
            Route::get('/', 'Admin\LoginController@index')->name('admin.administrator.home');
            Route::get('/anyData', 'Admin\LoginController@anyData')->name('anyData');
            Route::get('/create', 'Admin\LoginController@create')->name('admin.administrator.create');
            Route::post('/create', 'Admin\LoginController@postCreate')->name('admin.administrator.createPost');
            Route::get('/update/{id}', 'Admin\LoginController@update')->name('admin.administrator.update');
            Route::post('/update/{id}', 'Admin\LoginController@postUpdate')->name('admin.administrator.postUpdate');
            Route::get('/destroy/{id}', 'Admin\LoginController@destroy')->name('admin.administrator.destroy');
        });
        Route::get('setting', 'Admin\SettingController@index')->name('admin.setting');
        Route::post('setting/update', 'Admin\SettingController@update')->name('admin.setting.update');
    });
});
