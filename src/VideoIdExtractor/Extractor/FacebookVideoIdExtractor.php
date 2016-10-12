<?php

namespace VideoIdExtractor\Extractor;

use VideoIdExtractor\Exception\VideoIdExtractException;

class FacebookVideoIdExtractor implements VideoIdExtractorInterface
{
    const PATTERN = '/videos\/(\d+)|v=(\d+)|vb.\d+\/(\d+)/';

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
            throw new VideoIdExtractException('Video id can not be extracted');
        } elseif ($result === 0) {
            throw new VideoIdExtractException(sprintf('This link %s is not a valid facebook link', $link));
        }

        return !empty($matches[1]) ? $matches[1] : (!empty($matches[2]) ? $matches[2] : $matches[3]);
    }
}
