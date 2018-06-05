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

        $userAgents = file(__DIR__ . '/../user_agents.txt');

        $browser = new Browser();
        $response = $browser->get($googleSearch, ['User-Agent' => $userAgents[array_rand($userAgents, 1)]]);

        $parser = new Crawler($response->getBody()->getContents(), null, '.srg');

        foreach ($parser->filter('.g .r') as $node) {
            var_dump($node->getElementsByTagName('a')->item(0)->textContent);
            var_dump($node->getElementsByTagName('a')->item(0)->getAttribute('href'));
        }

    }
}
