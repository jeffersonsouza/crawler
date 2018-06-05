<?php

namespace Crawler;

use Buzz\Browser;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Crawler
 * @package JeffersonSouza\Crawler
 */
class SearchCrawler
{
    public $extractor;
    public function __construct()
    {
        $this->extractor = new \Buzz\Browser();
    }

    public function search($term)
    {
        $googleSearch = "https://www.google.com/search?hl=en&q=$term&btnG=Search&gbv=1";
        $yahooSearch = "https://search.yahoo.com/search?p=$term&fr=yfp-t&fp=1&toggle=1&cop=mss&ei=UTF-8";

        $usergents = file(__DIR__ . '/../user_agents.txt');

        $browser = new Browser();
        $response = $browser->get($googleSearch, ['User-Agent' => $usergents[array_rand($usergents, 1)]]);

        return $response->getBody()->getContents();
    }
}
