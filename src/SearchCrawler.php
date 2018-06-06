<?php

namespace Crawler;

use Buzz\Browser;
use Crawler\Clients\GoogleSearchClient;
use Crawler\Clients\YahooSearchClient;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Crawler
 * @package Crawler
 */
class SearchCrawler
{
    public $extractor;
    public $clients = [];
    public $data = [];

    public function __construct()
    {
        $this->extractor = new \Buzz\Browser();
        $this->clients = [
            'Google' =>  new GoogleSearchClient(),
            'Yahoo' =>  new YahooSearchClient()
        ];
    }

    public function search($term)
    {
        $this->setData($this->clients['Google']->search($term));
        $this->setData($this->clients['Yahoo']->search($term));

        return $this->data;
    }

    public function setData(array $items)
    {
        foreach ($items as $key => $item) {
            if(array_key_exists($key, $this->data)) {
                array_merge($this->data[$key]['source'], $item['source']);
            } else {
                $this->data[$key] = $item;
            }
        }
    }
}
