<?php

namespace unit\VideoIdExtractor;

use VideoIdExtractor\Exception\VideoIdExtractException;
use VideoIdExtractor\Extractor\FacebookVideoIdExtractor;

class FacebookVideoIdExtractorCest
{
    /**
     * @param \UnitTester $I
     */
    public function testExtractVideoIdFromValidLink(\UnitTester $I)
    {
        $links = [
            'http://www.facebook.com/facebook/videos/10153231379946729/' => '10153231379946729',
            // @codingStandardsIgnoreLine
            'http://www.facebook.com/username/videos/vb.100000724987616/709948045706022/?type=2&theater' => '709948045706022',
            'http://www.facebook.com/username/videos/426337427566302/?theater' => '426337427566302',
            'http://www.facebook.com/photo.php?v=426337427566302&type=2&theater' => '426337427566302',
            'https://www.facebook.com/facebook/videos/10153231379946729/' => '10153231379946729',
            // @codingStandardsIgnoreLine
            'https://www.facebook.com/username/videos/vb.100000724987616/709948045706022/?type=2&theater' => '709948045706022',
            'https://www.facebook.com/username/videos/426337427566302/?theater' => '426337427566302',
            'https://www.facebook.com/photo.php?v=426337427566302&type=2&theater' => '426337427566302',
        ];
        $extractor = new FacebookVideoIdExtractor();
        foreach ($links as $link => $expectedId) {
            $I->assertEquals($expectedId, $extractor->extract($link));
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function testExtractVideoIdFromInvalidLink(\UnitTester $I)
    {
        $I->expectException(VideoIdExtractException::class, function () {
            (new FacebookVideoIdExtractor())->extract('invalid_link');
        });
    }
}
