<?php

namespace App\Http\Controllers;

use DOMDocument;
use EduLazaro\Larablog\Larablog;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $xml = new DOMDocument('1.0', 'UTF-8');
        $root = $xml->appendChild($xml->createElement('urlset'));
        $root->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach (Larablog::collection('blog')->sitemap() as $entry) {
            $url = $root->appendChild($xml->createElement('url'));
            $url->appendChild($xml->createElement('loc'))->appendChild($xml->createTextNode($entry['loc']));
            if ($entry['lastmod'] !== null) {
                $url->appendChild($xml->createElement('lastmod'))->appendChild($xml->createTextNode($entry['lastmod']));
            }
        }

        return response($xml->saveXML(), 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
