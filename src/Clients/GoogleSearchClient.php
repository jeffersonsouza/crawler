<?php

namespace Crawler\Clients;

use Crawler\CrawlerClient;
use Crawler\Extractors\GoogleExtractor;
use Nyholm\Psr7\Response;

/**
 * Class GoogleSearchClient
 * @package Crawler
 */
class GoogleSearchClient extends CrawlerClient
{
    public function __construct()
    {
        parent::__construct();

        $this->searchUri = 'https://www.google.com/search?q=%s&btnG=Search&gbv=1';
        $this->extractor = new GoogleExtractor();
    }

}