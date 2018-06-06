<?php

namespace Crawler\Extractors;

use Crawler\Interfaces\ExtractorInterface;
use Nyholm\Psr7\Response;
use Symfony\Component\DomCrawler\Crawler;

class YahooExtractor implements ExtractorInterface
{
    protected $selector = '#web ol li h3';
    protected $source = 'Yahoo';

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

            // Workaround to clean yahoo result URL
            $url = $node->getElementsByTagName('a')->item(0)->getAttribute('href');

            $url = urldecode(substr(
                $url,
                strpos($url, 'RU=') + 3,
                (strpos($url, 'RK=2') - strpos($url, 'RU=')) - 3
            ));

            // This workaround is because sometimes the result comes with double slashes :(
            $pieces = explode('://', $url);
            $pieces[1] = str_replace('//', '/', $pieces[1]);
            $url = implode('://', $pieces);

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