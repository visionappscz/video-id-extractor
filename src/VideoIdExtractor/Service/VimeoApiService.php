<?php

namespace VideoIdExtractor\Service;

class VimeoApiService
{
    const API_URL = 'https://vimeo.com/api/oembed.json?url=%s';

    /**
     * @var int
     */
    private $httpCode;

    /**
     * @var mixed
     */
    private $response;

    /**
     * VimeoService constructor.
     *
     * @param string $link
     */
    public function __construct($link)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, sprintf(self::API_URL, urlencode($link)));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, false);
        $this->response = curl_exec($c);
        $this->httpCode = (int) curl_getinfo($c, CURLINFO_HTTP_CODE);
        curl_close($c);
    }

    /**
     * @return int
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}
