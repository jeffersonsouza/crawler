<?php

namespace Crawler;

use Crawler\Interfaces\CrawlerInterface;
use Nyholm\Psr7\Response;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class ClawlerClient
 * @package Crawler
 */
abstract class CrawlerClient implements CrawlerInterface
{
    /**
     * @var Endpoint to get the search results
     */
    protected $searchUri;

    /**
     * @var \Buzz\Browser
     */
    protected $browser;

    /**
     * @var array with a list of User-Agents
     */
    protected $userAgents;

    /**
     * @var Selector to be used in DOM Search
     */
    protected $selector;

    /**
     * @var Class responsible to process the results
     */
    protected $extractor;

    public function __construct()
    {
        $this->browser = new \Buzz\Browser();
        $this->userAgents = file(__DIR__ . '/../user_agents.txt');
    }

    /**
     * @return mixed|\DOMNode
     */
    public function search($term)
    {
        return $this->processResponse(
            $this->browser->get(sprintf($this->searchUri, $term), [
                'User-Agent' => $this->userAgents[array_rand($this->userAgents, 1)]
            ])
        );
    }

    /**
     * @param \Response $response
     *
     * @return mixed|void
     */
    public function processResponse(Response $response)
    {
        return $this->extractor->extract($response);
    }
}