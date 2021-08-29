<?php

namespace src\oop\app\src\Parsers;

use Symfony\Component\DomCrawler\Crawler;
use src\oop\app\src\Models\Movie;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    private Movie $movie;
    private Crawler $crawler;

    public function __construct(Movie $movie, Crawler $crawler)
    {
        $this->movie = $movie;
        $this->crawler = $crawler;
    }

    /**
     * @param string $siteContent
     * @return Movie
     */
    public function parseContent(string $siteContent): Movie
    {
        $this->crawler->addHtmlContent($siteContent);

        $title = $this->crawler->filter('.ftitle > h1')->text();
        $poster = $this->crawler->filter('.fposter > a')->attr('href');
        $description = $this->crawler->filter('.fdesc')->text();

        return $this->movie->setTitle($title)
            ->setPoster($poster)
            ->setDescription($description);
    }
}
