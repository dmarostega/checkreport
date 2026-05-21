<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = $this->generateSitemap();

        return Response::make($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function generateSitemap()
    {
        $baseUrl = config('app.url');
        
        $urlEntries = [
            // Static public pages
            [
                'url' => $baseUrl,
                'changefreq' => 'weekly',
                'priority' => '1.0',
                'lastmod' => now()->toAtomString()
            ],
            [
                'url' => "{$baseUrl}/recursos",
                'changefreq' => 'monthly',
                'priority' => '0.9',
                'lastmod' => now()->toAtomString()
            ],
            [
                'url' => "{$baseUrl}/precos",
                'changefreq' => 'monthly',
                'priority' => '0.9',
                'lastmod' => now()->toAtomString()
            ],
            [
                'url' => "{$baseUrl}/termos",
                'changefreq' => 'yearly',
                'priority' => '0.5',
                'lastmod' => now()->toAtomString()
            ],
            [
                'url' => "{$baseUrl}/privacidade",
                'changefreq' => 'yearly',
                'priority' => '0.5',
                'lastmod' => now()->toAtomString()
            ],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urlEntries as $entry) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($entry['url'], ENT_XML1) . '</loc>';
            $xml .= '<lastmod>' . $entry['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>' . $entry['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $entry['priority'] . '</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
