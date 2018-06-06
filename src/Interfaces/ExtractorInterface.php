<?php

namespace Crawler\Interfaces;

use Nyholm\Psr7\Response;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Interface ExtractorInterface
 * @package Crawler\Interfaces
 */
interface ExtractorInterface
{
    /**
     * @param Response $response
     *
     * @return mixed
     */
    public function extract(Response $response);
}