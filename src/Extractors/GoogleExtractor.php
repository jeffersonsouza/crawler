<?php

namespace Crawler\Extractors;

use Crawler\Interfaces\ExtractorInterface;
use Nyholm\Psr7\Response;
use Symfony\Component\DomCrawler\Crawler;

class GoogleExtractor implements ExtractorInterface
{
    protected $selector = '.g h3.r';
    protected $source = 'Google';

    /**
     * @param Response $response
     *
     * @return array
     */
    public function extract(Response $response)
    {
        $results = [];

        $parser = new Crawler($response->getBody()->getContents());

        /**
         * Here I need to loop into results using the selector in DOM. Every Extractor could have they own DOM selector
         */
        foreach ($parser->filter($this->selector) as $node) {

            // Workaround to clean google's result URL
            $url = strtok(
                str_replace(
                    '/url?q=',
                    '',
                    $node->getElementsByTagName('a')->item(0)->getAttribute('href')
                ),
            '&');

            if(filter_var($url, FILTER_VALIDATE_URL)) {
                // we can use md5 as key for our array, the chances of collision is short
                $results[md5($url)]['title'] = $node->getElementsByTagName('a')->item(0)->textContent;
                $results[md5($url)]['url'] = $url;
                $results[md5($url)]['source'][] = $this->source;
            }
        }

        return $results;
    }
}