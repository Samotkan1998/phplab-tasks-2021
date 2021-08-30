<?php

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;

class FilmixParserStrategy implements ParserInterface
{
    private Movie $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * @param string $siteContent
     * @return Movie
     */
    public function parseContent(string $siteContent): Movie
    {
        mb_internal_encoding("UTF-8");

        preg_match('%h1 class="name" itemprop="name">(.*?)</h1>%', $siteContent, $matches);
        $title = iconv('windows-1251', 'utf-8', $matches[1]);

        preg_match('%<a class="fancybox".*href="([^"]*)"%', $siteContent, $matches);
        $poster = $matches[1];

        preg_match('%<div class="full-story">(.*?)<\/div>%', $siteContent, $matches);
        $description = iconv('windows-1251', 'utf-8', $matches[1]);

        return $this->movie->setTitle($title)
            ->setPoster($poster)
            ->setDescription($description);
    }
}
