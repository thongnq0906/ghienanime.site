<?php

namespace App\Scraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class TGDD
{

    public function scrape()
    {
        $url = 'https://www.hhninja.xyz/2021/01/vo-than-chua-te.html';

        $client = new Client();

        $crawler = $client->request('GET', $url);
    }
}