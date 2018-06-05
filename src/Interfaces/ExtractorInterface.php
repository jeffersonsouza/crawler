<?php

namespace Crawler\Interfaces;

/**
 * Interface ExtractorInterface
 * @package Crawler\Interfaces
 */
interface ExtractorInterface
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