<?php

namespace App\Scrape;

use App\Model\Job;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Scrape
{

    public function scrapeIbusJobs(){
        $url = "http://www.ibusmedia.com/career.htm";

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);
        $contents = $response->getBody()->getContents();

        $crawler = new Crawler($contents);
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $jobs = [];

        $crawler->filter('.career > .widget')->each(function (Crawler $node, $i) use (&$jobs, $serializer){

            $title = $node->filter('.media-heading')->text();
            $location = $node->filter('.location')->text();
            $link = $node->filter('.btn')->attr('href');
            $date = $node->filter('.date')->text();
            $description = $this->getDescription($node->filter('article')->text());
            $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());

            $job = New Job();

            $job->setTitle($title);
            $job->setLocation($location);
            $job->setApplyLink($link);
            $job->setDate($date);
            $job->setContent($description);

            $job = $normalizer->normalize($job);

            $jsonContent = $serializer->serialize($job, 'json');
            file_put_contents('var/jobs/results.json', $jsonContent);
        });
    }

    private function getDescription($text)
    {
        $rawText = preg_replace('/(\v|\s)+/', ' ', $text);
        $description = trim(str_replace('Apply For This Position', '', $rawText));

        return $description;
    }
}

