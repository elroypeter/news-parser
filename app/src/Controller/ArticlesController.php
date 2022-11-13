<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Service\PaginatorService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticlesController extends AbstractController
{
    #[Route('/', name: 'all_articles')]
    public function index(
        Request $request,
        PaginatorService $paginatorService,
        ArticleRepository $articleRepository
    ): Response {
        $query = $articleRepository->findAllArticles();
        $paginatorService->paginate($query, $request->query->getInt('page', 1));

        return $this->render('articles/index.html.twig', [
            'paginator' => $paginatorService,
        ]);
    }

    #[Route('/articles', name: 'delete_article', methods: ['post'])]
    public function deleteArticle(
        Request $request,
        ArticleRepository $articleRepository,
        ManagerRegistry $doctrine
    ) {
        $article = $articleRepository->find((int)$request->query->get('id'));

        if (!is_null($article)) {
            $doctrine->getManager()->remove($article);
            $doctrine->getManager()->flush();
        }

        return $this->redirectToRoute('all_articles', ['page' => (int)$request->query->get('page')]);
    }
}
