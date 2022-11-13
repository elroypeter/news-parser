<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

define('NEWS_API', 'https://newsapi.org/v2/everything?domains=wsj.com&apiKey=becf248a49bb4e7c805298516394177b');

class NewsParserService
{
    private $client;
    private $entityManager;
    private $articleRepository;

    public function __construct(
        ManagerRegistry $doctrine,
        HttpClientInterface $client,
        ArticleRepository $articleRepository
    ) {
        $this->client = $client;
        $this->articleRepository = $articleRepository;
        $this->entityManager = $doctrine->getManager();
    }
    private function fetchNews()
    {
        try {
            $response = $this->client->request('GET', NEWS_API);
        } catch (ExceptionInterface $exception) {
            throw $exception;
        }

        return json_decode($response->getContent());
    }

    private function findArticle(string $title): ?Article
    {
        $article = $this->articleRepository->findByTitle($title);
        return $article;
    }

    public function parseNews()
    {
        $news = $this->fetchNews();
        foreach ($news->articles as $key => $article) {
            $newArticle = $this->findArticle($article->title);

            if (is_null($newArticle)) {
                $this->saveNews(new Article(
                    $article->title,
                    $article->description,
                    $article->urlToImage,
                    $article->publishedAt
                ));
            } else {
                $newArticle->setLastUpdated($article->publishedAt);
                $this->saveNews($newArticle);
            }
        }
        $this->entityManager->flush();
    }

    public function saveNews(Article $article)
    {
        $this->entityManager->persist($article);
    }
}
