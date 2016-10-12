<?php

namespace unit\VideoIdExtractor;

use Prophecy\Prophet;
use VideoIdExtractor\Exception\VideoIdExtractException;
use VideoIdExtractor\Service\VimeoApiService;
use VideoIdExtractor\Service\VimeoService;

class VimeoServiceCest
{
    /**
     * @param \UnitTester $I
     */
    public function testExtractVideoIdFromValidLink(\UnitTester $I)
    {
        $prophet = new Prophet();
        $vimeoApiService = $prophet->prophesize(VimeoApiService::class);
        $vimeoApiService->getHttpCode()->willReturn(200);
        $vimeoApiService->getResponse()->willReturn('{"video_id": "abcd"}');
        $I->assertEquals('abcd', (new VimeoService($vimeoApiService->reveal()))->extract('link'));
    }

    /**
     * @param \UnitTester $I
     */
    public function testExtractVideoIdFromInvalidLink(\UnitTester $I)
    {
        $I->expectException(VideoIdExtractException::class, function () {
            $prophet = new Prophet();
            $vimeoApiService = $prophet->prophesize(VimeoApiService::class);
            $vimeoApiService->getHttpCode()->willReturn(404);
            (new VimeoService($vimeoApiService->reveal()))->extract('link');
        });
    }

    /**
     * @param \UnitTester $I
     */
    public function testExtractVideoIdFromInvalidId(\UnitTester $I)
    {
        $I->expectException(VideoIdExtractException::class, function () {
            $prophet = new Prophet();
            $vimeoApiService = $prophet->prophesize(VimeoApiService::class);
            $vimeoApiService->getHttpCode()->willReturn(200);
            $vimeoApiService->getResponse()->willReturn('{}');
            (new VimeoService($vimeoApiService->reveal()))->extract('link');
        });
    }
}
