<?php

namespace Tests\Feature;

use Tests\TestCase;

class BlogTest extends TestCase
{
    public function test_lists_published_articles_without_a_database(): void
    {
        config(['database.default' => 'unconfigured']);
        $this->withoutVite();

        $this->get('/')->assertOk()
            ->assertSee('Un blog que cabe en tu repositorio')
            ->assertSee('Escribir con Markdown sin perder el hilo')
            ->assertDontSee('Un borrador sin publicar')
            ->assertDontSee('Una entrada programada');
    }

    public function test_renders_an_article_with_its_author_and_social_card(): void
    {
        $this->withoutVite();

        $this->get('/un-blog-en-tu-repositorio')->assertOk()
            ->assertSee('Una carpeta por artículo')
            ->assertSee('Edu Lázaro')
            ->assertSee('images/blog/es/un-blog-en-tu-repositorio.png')
            ->assertSee('property="og:image"', false)
            ->assertSee('rel="canonical"', false);
    }

    public function test_category_only_lists_its_articles(): void
    {
        $this->withoutVite();

        $this->get('/categoria/escritura')->assertOk()
            ->assertSee('Escribir con Markdown sin perder el hilo')
            ->assertDontSee('Un blog que cabe en tu repositorio');
    }

    public function test_tag_lists_matching_articles(): void
    {
        $this->withoutVite();

        $this->get('/etiqueta/markdown')->assertOk()
            ->assertSee('Un blog que cabe en tu repositorio')
            ->assertSee('Escribir con Markdown sin perder el hilo')
            ->assertDontSee('Portadas que acompañan al contenido');
    }

    public function test_drafts_and_future_articles_return_404(): void
    {
        $this->get('/borrador')->assertNotFound();
        $this->get('/proximo-articulo')->assertNotFound();
    }

    public function test_unknown_articles_and_categories_return_404(): void
    {
        $this->get('/articulo-inexistente')->assertNotFound();
        $this->get('/categoria/inexistente')->assertNotFound();
    }

    public function test_feed_is_valid_xml_and_excludes_unpublished_content(): void
    {
        $response = $this->get('/feed')->assertOk()
            ->assertHeader('Content-Type', 'application/rss+xml; charset=UTF-8')
            ->assertDontSee('Un borrador sin publicar')
            ->assertDontSee('Una entrada programada');

        $feed = simplexml_load_string($response->getContent());
        $this->assertCount(3, $feed->channel->item);
        $this->assertSame('Un blog que cabe en tu repositorio', (string) $feed->channel->item[0]->title);
    }

    public function test_sitemap_only_contains_public_urls(): void
    {
        $response = $this->get('/sitemap.xml')->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertDontSee('borrador')->assertDontSee('proximo-articulo');

        $sitemap = simplexml_load_string($response->getContent());
        $sitemap->registerXPathNamespace('s', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $this->assertCount(4, $sitemap->xpath('//s:url'));
        $this->assertCount(3, $sitemap->xpath('//s:lastmod'));
    }
}
