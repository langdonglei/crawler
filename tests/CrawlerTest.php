<?php


use langdonglei\Crawler;
use PHPUnit\Framework\TestCase;

class CrawlerTest extends TestCase
{

    public function testGetMaxPageNumber()
    {
        $url = 'https://www.baidu.com/s?ie=UTF-8&wd=php';
        Crawler::getMaxPageNumber($url);
    }
}
