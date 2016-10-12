<?php

namespace integration\VideoIdExtractor;

use VideoIdExtractor\Exception\VideoIdExtractException;
use VideoIdExtractor\Extractor\VimeoVideoIdExtractor;

class VimeoVideoIdExtractorCest
{
    /**
     * @param \IntegrationTester $I
     */
    public function testExtractVideoIdFromValidLink(\IntegrationTester $I)
    {
        $links = [
            'http://vimeo.com/179937366' => '179937366',
            'http://player.vimeo.com/video/179937366' => '179937366',
            'https://vimeo.com/179937366' => '179937366',
            'https://player.vimeo.com/video/179937366' => '179937366',
        ];
        $extractor = new VimeoVideoIdExtractor();
        foreach ($links as $link => $expectedId) {
            $I->assertEquals($expectedId, $extractor->extract($link));
        }
    }

    /**
     * @param \IntegrationTester $I
     */
    public function testExtractVideoIdFromInvalidLink(\IntegrationTester $I)
    {
        $I->expectException(VideoIdExtractException::class, function () {
            (new VimeoVideoIdExtractor())->extract('invalid_link');
        });
    }
}
