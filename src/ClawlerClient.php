<?php

namespace Crawler;

use Crawler\Interfaces\CrawlerInterface;

/**
 * Class ClawlerClient
 * @package Crawler
 */
abstract class ClawlerClient implements CrawlerInterface
{
    /**
     * @var Endpoint to get the search results
     */
    protected $searchUri;

    /**
     * @var \Buzz\Browser
     */
    protected $extractor;

    /**
     * @var array with a list of User-Agents
     */
    protected $userAgents;

    /**
     * @var Results from Buzz
     */
    protected $data;

    public function __construct()
    {
        $this->extractor = new \Buzz\Browser();
        $this->userAgents = file(__DIR__ . '/../user_agents.txt');
    }

    /**
     * Term to be searched
     *
     * @param string $term
     */
    public function setTerm(string $term)
    {
        // TODO: Implement setTerms() method.
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function search()
    {
        return $this->extractor->get($searchUri, ['User-Agent' => $this->userAgents[array_rand($this->userAgents, 1)]]);
    }

    /**
     * @param \DOMNode $elements
     *
     * @return mixed|void
     */
    public function processResponse(\DOMNode $elements)
    {
        // TODO: Implement processResponse() method.
    }
}