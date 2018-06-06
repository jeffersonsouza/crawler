<?php

namespace Crawler\Clients;

use Crawler\CrawlerClient;
use Crawler\Extractors\YahooExtractor;
use Crawler\Interfaces\CrawlerInterface;

/**
 * Class ClawlerClient
 * @package Crawler
 */
class YahooSearchClient extends CrawlerClient
{
    public function __construct()
    {
        parent::__construct();

        $this->searchUri = 'https://search.yahoo.com/search?p=%s&fr=yfp-t&fp=1&toggle=1&cop=mss&ei=UTF-8';
        $this->extractor = new YahooExtractor();
    }

}