<?php

namespace App\Console\Commands;

use App\Models\Check_movie;
use App\Models\Images;
use App\Models\Product;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Console\Command;

class ResetNinja extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:ninja';

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
        \Log::info("Ninja Bắt đầu Reset ");
        $product2 = Product::orderBy('date_update', 'DESC')->where('check_full', null)->get();
        foreach ($product2 as $p)
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
                    for ($i=1; $i<=$tapNinja; $i++)
                    {
                        if (strpos($text, 'link_1_'.$i.' = "') !== false) {
                            $cut = explode('link_1_'.$i.' = "', $text)[1];
                            $link1 = explode('"', $cut)[0];
                            if (strpos($link1, 'i2001storage') !== false){
                                $link1 = null;
                            }
                            $cut = explode('link_2_'.$i.' = "', $text)[1];
                            $link2 = explode('"', $cut)[0];
                            if (strpos($link2, 'i2001storage') !== false){
                                $link2 = null;
                            }
                            $cut = explode('link_3_'.$i.' = "', $text)[1];
                            $link3 = explode('"', $cut)[0];
                            if (strpos($link3, 'i2001storage') !== false){
                                $link3 = null;
                            }
                            $cut = explode('link_4_'.$i.' = "', $text)[1];
                            $link4 = explode('"', $cut)[0];
                            if (strpos($link4, 'i2001storage') !== false){
                                $link4 = null;
                            }

                            $episode = Images::where('ep', $i)->where('product_id', $p->id)->first();
                            if ($episode) {
                                $episode->slug            = 'tap-'.$i;
                                $episode->ep           = $i;
                                $episode->link1           = $link1;
                                $episode->link2           = $link2;
                                $episode->link3           = $link3;
                                $episode->link4           = $link4;
                                $episode->product_id = $p->id;
                                $episode->save();
                            }
                        }
                    }
                });
            }
        }
        \Log::info("Ninja reset thành công");
    }
}
