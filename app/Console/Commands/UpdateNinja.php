<?php

namespace App\Console\Commands;

use App\Models\Check_movie;
use App\Models\Images;
use App\Models\Product;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\BrowserKit\HttpBrowser;

class UpdateNinja extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:ninja';

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
        \Log::info("Ninja Bắt đầu Update ");
        $product = Product::where('cate_product_id', 5)->orderBy('id', 'desc')->get();

        foreach ($product as $p) {
            $checkEp = Images::where('product_id', $p->id)->get();
            if (count($checkEp) == 0) {
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
        }
        \Log::info("Ninja Update thành công");
    }
}
