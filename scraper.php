<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


$fetchUrl = "https://tamilblasters.proxyboy.site/";
$selector = "#ipsLayout_mainArea > div.cWidgetContainer > ul > li:nth-child(3) > div";

try {
    $client = new Client();
    $response = $client->request('GET', $fetchUrl);

    if ($response->getStatusCode() !== 200) {
        throw new Exception("Failed to fetch content. Status code: " . $response->getStatusCode());
    }

    $crawler = new Crawler($response->getBody()->getContents());
    $content = $crawler->filter($selector)->first();

    if ($content->count() > 0) {
        $htmlContent = $content->html();
        $htmlContent = str_replace("old_text_2", "new_text_2", $htmlContent);
        echo $htmlContent;
    } else {
        echo "Content not found";
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
