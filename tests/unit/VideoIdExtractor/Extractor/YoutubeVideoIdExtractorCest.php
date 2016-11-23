<?php

namespace unit\VideoIdExtractor;

use VideoIdExtractor\Exception\VideoIdExtractException;
use VideoIdExtractor\Extractor\YoutubeVideoIdExtractor;

class YoutubeVideoIdExtractorCest
{
    /**
     * @param \UnitTester $I
     */
    public function testExtractVideoIdFromValidLink(\UnitTester $I)
    {
        $links = [
            'http://www.youtube.com/v/0zM3nApSvMg?fs=1&hl=en_US&rel=0' => '0zM3nApSvMg',
            'http://www.youtube.com/embed/0zM3nApSvMg?rel=0' => '0zM3nApSvMg',
            'http://www.youtube.com/watch?v=0zM3nApSvMg&feature=feedrec_grec_index' => '0zM3nApSvMg',
            'http://www.youtube.com/watch?v=0zM3nApSvMg' => '0zM3nApSvMg',
            'http://youtu.be/0zM3nApSvMg' => '0zM3nApSvMg',
            'http://www.youtube.com/watch?v=0zM3nApSvMg#t=0m10s' => '0zM3nApSvMg',
            'http://www.youtube.com/user/IngridMichaelsonVEVO#p/a/u/1/KdwsulMb8EQ' => 'KdwsulMb8EQ',
            'http://youtu.be/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'http://www.youtube.com/embed/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'http://www.youtube.com/v/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'http://www.youtube.com/e/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'http://www.youtube.com/watch?v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'http://www.youtube.com/?v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'http://www.youtube.com/watch?feature=player_embedded&v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'http://www.youtube.com/?feature=player_embedded&v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'http://www.youtube.com/user/IngridMichaelsonVEVO#p/u/11/KdwsulMb8EQ' => 'KdwsulMb8EQ',
            'http://www.youtube-nocookie.com/v/6L3ZvIMwZFM?version=3&hl=en_US&rel=0' => '6L3ZvIMwZFM',
            'https://www.youtube.com/v/0zM3nApSvMg?fs=1&hl=en_US&rel=0' => '0zM3nApSvMg',
            'https://www.youtube.com/embed/0zM3nApSvMg?rel=0' => '0zM3nApSvMg',
            'https://www.youtube.com/watch?v=0zM3nApSvMg&feature=feedrec_grec_index' => '0zM3nApSvMg',
            'https://www.youtube.com/watch?v=0zM3nApSvMg' => '0zM3nApSvMg',
            'https://youtu.be/0zM3nApSvMg' => '0zM3nApSvMg',
            'https://www.youtube.com/watch?v=0zM3nApSvMg#t=0m10s' => '0zM3nApSvMg',
            'https://www.youtube.com/user/IngridMichaelsonVEVO#p/a/u/1/KdwsulMb8EQ' => 'KdwsulMb8EQ',
            'https://youtu.be/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'https://www.youtube.com/v/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'https://www.youtube.com/e/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'https://www.youtube.com/watch?v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'https://www.youtube.com/?v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'https://www.youtube.com/watch?feature=player_embedded&v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'https://www.youtube.com/?feature=player_embedded&v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'https://www.youtube.com/user/IngridMichaelsonVEVO#p/u/11/KdwsulMb8EQ' => 'KdwsulMb8EQ',
            'https://www.youtube-nocookie.com/v/6L3ZvIMwZFM?version=3&hl=en_US&rel=0' => '6L3ZvIMwZFM',
            'www.youtube.com/v/0zM3nApSvMg?fs=1&hl=en_US&rel=0' => '0zM3nApSvMg',
            'www.youtube.com/embed/0zM3nApSvMg?rel=0' => '0zM3nApSvMg',
            'www.youtube.com/watch?v=0zM3nApSvMg&feature=feedrec_grec_index' => '0zM3nApSvMg',
            'www.youtube.com/watch?v=0zM3nApSvMg' => '0zM3nApSvMg',
            'youtu.be/0zM3nApSvMg' => '0zM3nApSvMg',
            'www.youtube.com/watch?v=0zM3nApSvMg#t=0m10s' => '0zM3nApSvMg',
            'www.youtube.com/user/IngridMichaelsonVEVO#p/a/u/1/KdwsulMb8EQ' => 'KdwsulMb8EQ',
            'youtu.be/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'www.youtube.com/embed/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'www.youtube.com/v/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'www.youtube.com/e/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'www.youtube.com/watch?v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'www.youtube.com/?v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'www.youtube.com/watch?feature=player_embedded&v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'www.youtube.com/?feature=player_embedded&v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'www.youtube.com/user/IngridMichaelsonVEVO#p/u/11/KdwsulMb8EQ' => 'KdwsulMb8EQ',
            'www.youtube-nocookie.com/v/6L3ZvIMwZFM?version=3&hl=en_US&rel=0' => '6L3ZvIMwZFM',
            'youtube.com/v/0zM3nApSvMg?fs=1&hl=en_US&rel=0' => '0zM3nApSvMg',
            'youtube.com/embed/0zM3nApSvMg?rel=0' => '0zM3nApSvMg',
            'youtube.com/watch?v=0zM3nApSvMg&feature=feedrec_grec_index' => '0zM3nApSvMg',
            'youtube.com/watch?v=0zM3nApSvMg' => '0zM3nApSvMg',
            'youtube.com/watch?v=0zM3nApSvMg#t=0m10s' => '0zM3nApSvMg',
            'youtube.com/user/IngridMichaelsonVEVO#p/a/u/1/KdwsulMb8EQ' => 'KdwsulMb8EQ',
            'youtube.com/embed/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'youtube.com/v/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'youtube.com/e/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'youtube.com/watch?v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'youtube.com/?v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'youtube.com/watch?feature=player_embedded&v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'youtube.com/?feature=player_embedded&v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'youtube.com/user/IngridMichaelsonVEVO#p/u/11/KdwsulMb8EQ' => 'KdwsulMb8EQ',
            'youtube-nocookie.com/v/6L3ZvIMwZFM?version=3&hl=en_US&rel=0' => '6L3ZvIMwZFM',
        ];
        $extractor = new YoutubeVideoIdExtractor();
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
            (new YoutubeVideoIdExtractor())->extract('invalid_link');
        });
    }
}
