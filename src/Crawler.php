<?php

namespace Crawler;

/**
 * Class Crawler
 * @package JeffersonSouza\Crawler
 */
class Crawler
{
    public $extractor;
    public function __construct()
    {
        $this->extractor = new \Buzz\Browser();
    }

    public function search($term)
    {
        $response = $browser->sendRequest('https://google.com/?q=' + $term);

        return $response;
    }
}
