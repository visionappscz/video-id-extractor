<?php

namespace VideoIdExtractor\Extractor;

interface VideoIdExtractorInterface
{
    /**
     * @param string $link
     * @return string
     */
    public function extract($link);
}
