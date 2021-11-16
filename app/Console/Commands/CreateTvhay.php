<?php

namespace App\Console\Commands;

use App\Models\Check_movie;
use App\Models\Narration;
use Goutte\Client;
use Illuminate\Console\Command;
use App\Models\Product;

class CreateTvhay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:tvhay';

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
                                if ($episode) {
                                    $episode->link2           = $vip;
                                    $episode->save();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
