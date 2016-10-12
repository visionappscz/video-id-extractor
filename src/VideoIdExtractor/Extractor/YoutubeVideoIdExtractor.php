<?php

namespace VideoIdExtractor\Extractor;

use VideoIdExtractor\Exception\VideoIdExtractException;

class YoutubeVideoIdExtractor implements VideoIdExtractorInterface
{
    const PATTERN = '/^http[s]?\:\/\/[a-zA-Z0-9_\-\.\/\?#\=\&]+(youtu.be\/|v\/|e\/|u\/\w+\/|embed\/|v=)([^#\&\?]+)[\?#]?[^#]*[#]?.*/';

    /**
     * @param string $link
     * @throws VideoIdExtractException
     * @return string
     */
    public function extract($link)
    {
        $matches = [];
        $result = preg_match(self::PATTERN, $link, $matches);
        if ($result === false) {
            throw new VideoIdExtractException('Cannot analyse the link');
        } elseif ($result === 0) {
            throw new VideoIdExtractException(sprintf('This link %s is not a valid youtube link', $link));
        }

        return $matches[2];
    }
}
