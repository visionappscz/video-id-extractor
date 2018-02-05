<?php

namespace VideoIdExtractor\Service;

use VideoIdExtractor\Exception\VideoIdExtractException;

class VimeoService
{
    /**
     * @var \VideoIdExtractor\Service\VimeoApiService
     */
    private $vimeoApiService;

    /**
     * VimeoService constructor.
     *
     * @param \VideoIdExtractor\Service\VimeoApiService $vimeoApiService
     */
    public function __construct(VimeoApiService $vimeoApiService)
    {
        $this->vimeoApiService = $vimeoApiService;
    }

    /**
     * @throws \VideoIdExtractor\Exception\VideoIdExtractException
     * @return string
     */
    public function extract()
    {
        if ($this->vimeoApiService->getHttpCode() !== 200) {
            throw new VideoIdExtractException('This link is not a valid vimeo link.');
        }

        $response = $this->vimeoApiService->getResponse();
        if ($response) {
            $jsonData = json_decode($response, true, 512, JSON_OBJECT_AS_ARRAY);
            if ($jsonData) {
                if (isset($jsonData['video_id'])) {
                    return (string) $jsonData['video_id'];
                }
            }
        }

        throw new VideoIdExtractException('The video id is not valid.');
    }
}
