<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Images;
use App\Models\Check_movie;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use function Aws\filter;
use App\Models\Product;
use Carbon\Carbon;

class CreateAnime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:anime';

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
        $product = Product::orderBy('id', 'DESC')->where('check_full', 3)->get();
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

                            $episode                  = new Images;
                            $episode->slug            = 'tap-'.$tap;
                            $episode->ep           = $tap;
                            $episode->vip           = $vip;
                            $episode->link1           = $link1;
                            $episode->product_id = $p->id;
                            $episode->save();
                        }
                    }
                }
            }
        }
    }
}
