<?php

namespace Crawler\Interfaces;

/**
 * Interface CrawlerInterface
 * @package JeffersonSouza\Crawler\Interfaces
 */
interface CrawlerInterface
{
    /**
     * @param string $term
     *
     * @return mixed
     */
    public function setTerms(string $term);

    /**
     * @return mixed
     */
    public function search();

    /**
     * @param \HttpResponse $response
     *
     * @return mixed
     */
    public function processResponse(\HttpResponse $response);
}