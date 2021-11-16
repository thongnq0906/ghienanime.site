<?php

namespace App\Console\Commands;

use App\Models\Check_movie;
use App\Models\Product;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\BrowserKit\HttpBrowser;
use Image, File;
use Exception;

class CheckNinja extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:ninja';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
        for ($i=104; $i>=1;$i--) {
            \Log::info("Ninja Bắt đầu check ");

            $client = new Client();
            $crawler = $client->request('GET', 'https://animehay.site/the-loai/anime-1/trang-'.$i.'.html');
            $getLink = $crawler->filter('.movie-item a')->each(function ($node) {
                return $node->attr('href');
            });
            foreach ($getLink as $link) {
                $client = new Client();
                $crawler = $client->request('GET', $link);
                $html = '';
                foreach ($crawler as $domElement) {
                    $html .= $domElement->ownerDocument->saveHTML($domElement);
                }
                try {
                    $name = $crawler->filter('.heading_movie')->first()->html();
                } catch (Exception $e) {
                    $name = null;
                }
                try {
                    $nameOther = $crawler->filter('.name_other div')->last()->html();
                } catch (Exception $e) {
                    $nameOther = null;
                }
                try {
                    $category = $crawler->filter('.list_cate div a')->each(function ($node) {
                        $string = trim($node->html());

                        return $string;
                    });
                } catch (Exception $e) {
                    $category = null;
                }
                try {
                    $status = $crawler->filter('.status div')->last()->html();
                    if (strpos($status, 'Hoàn') !== false) {
                        $status = 1;
                    } else {
                        $status = 2;
                    }
                } catch (Exception $e) {
                    $status = 3;
                }

                try {
                    $updateTime = $crawler->filter('.update_time div')->last()->text();
                } catch (Exception $e) {
                    $updateTime = null;
                }

                $description = '';
                $zz = $crawler->filter('.desc div')->last();
                foreach ($zz as $domElement) {
                    $description .= $domElement->ownerDocument->saveHTML($domElement);
                }
                try {
                    $duration = $crawler->filter('.duration div')->last()->text();
                } catch (Exception $e) {
                    $duration = null;
                }
                try {
                    $img = $crawler->filter('.first img')->attr('src');
                } catch (Exception $e) {
                    $img = null;
                }

                $product                  = new Product;
                $product->name            = $name;
                $product->name2            = vn_to_str($name);
                $product->name3            = $nameOther;
                $product->slug            = str_slug($name);
                if (strpos($duration, 'phút') !== false) {
                    $product->cate_product_id = 6;
                } else {
                    $product->cate_product_id = 5;
                }
                $product->tag = json_encode($category, JSON_UNESCAPED_UNICODE);
                $product->status          = 1;
                $product->is_home         = 0;
                $product->description     = $description;
                $product->check_full     = $status;
                $product->update_time     = $updateTime;
                $product->duration     = $duration;

                if ($img != null) {
                    $filename = basename($img);
                    try {
                        Image::make($img)->save(public_path('upload/product/'.$filename));
                    } catch (Exception $e) {
                    }
                    $product->image = ('upload/product/'.$filename);
                }
                $product->url = $link;
                $product->save();
            }
            \Log::info("Ninja Check thành công");
        }
    }
}
