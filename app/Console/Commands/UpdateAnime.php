<?php

namespace App\Console\Commands;

use App\Models\Check_movie;
use App\Models\Images;
use App\Models\Product;
use Goutte\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use function Aws\filter;
use Carbon\Carbon;
use Exception;

class UpdateAnime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:anime';

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
        \Log::info("Animehay Bắt đầu Update ");
        $product = Product::orderBy('date_update', 'DESC')->get();
        foreach ($product as $p)
        {
            $linkAnime = Check_movie::where('product_id', $p->id)->where('link', 'like', '%animehay%')->first();
            if ($linkAnime) {
                try {
                    $client = new Client();
                    $crawler = $client->request('GET', $linkAnime->link);
                    $getLink = $crawler->filter('.list-item-episode a')->each(function ($node) {

                        return $node->attr('href');
                    });
                    $tongtap = count($getLink);
                    foreach ($getLink as $key => $link) {
                        try {
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
                        } catch (Exception $e) {
                            \Log::error($e->getMessage().$link);
                            continue;
                        }
                    }
                } catch (Exception $e) {
                    $link_error = $linkAnime->link;
                    \Log::error($e->getMessage().$link_error);
                    continue;
                }
            }
        }
        \Log::info("Animehay Update thành công");
    }
}
