<?php

namespace Crawler\Interfaces;

use Nyholm\Psr7\Response;

/**
 * Interface CrawlerInterface
 * @package Crawler\Interfaces
 */
interface CrawlerInterface
{
    /**
     * @param $term
     *
     * @return mixed
     */
    public function search($term);

    /**
     * @param Nyholm\Psr7\Response $response
     *
     * @return mixed
     */
    public function processResponse(Response $response);
}