<?php

namespace langdonglei;

use GuzzleHttp\Client;


class Crawler
{
    static function run($url, $maxPageNumber)
    {
        $htmlString = (new Client(['verify' => false]))->get($url)->getBody()->getContents();
        for ($i = 1; $i <= $maxPageNumber; $i++) {
            (new \Symfony\Component\DomCrawler\Crawler($htmlString))->filter('h4')->each(function ($v) {
                preg_match('|tid:(\d+)|', $v->text(), $match);
            });
        }
    }

    static function getMaxPageNumber($url)
    {
        $htmlString = (new Client(['verify' => false]))->get($url)->getBody()->getContents();
        $pages      = (new \Symfony\Component\DomCrawler\Crawler($htmlString))->filter('li')->reduce(function ($v) {
            return is_numeric($v->text());
        })->each(function ($v) {
            return $v->text();
        });
        return max($pages ?: [0]);
    }
}