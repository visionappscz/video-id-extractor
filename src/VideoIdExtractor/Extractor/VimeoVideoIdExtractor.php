<?php

namespace VideoIdExtractor\Extractor;

use VideoIdExtractor\Exception\VideoIdExtractException;
use VideoIdExtractor\Service\VimeoApiService;
use VideoIdExtractor\Service\VimeoService;

class VimeoVideoIdExtractor implements VideoIdExtractorInterface
{
    /**
     * @param string $link
     * @throws VideoIdExtractException
     * @return string
     */
    public function extract($link)
    {
        $vimeoService = new VimeoService(new VimeoApiService($link));

        return $vimeoService->extract();
    }
}
