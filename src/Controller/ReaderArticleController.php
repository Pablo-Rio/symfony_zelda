<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/article')]
class ReaderArticleController extends AbstractController
{
    #[Route('/', name: 'app_reader_article_index', methods: ['GET'])]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('reader_article/index.html.twig', [
            'articles' => $articlesRepository->createQueryBuilder('a')
                ->orderBy('a.id', 'DESC')
                ->getQuery()
                ->getResult()
        ]);
    }

    #[Route('/{id}', name: 'app_reader_article_show', methods: ['GET'])]
    public function show(Articles $article): Response
    {
        if ($article->getUser() === $this->getUser()) {
            return $this->render('profile_articles/show.html.twig', [
                'article' => $article,
            ]);
        }

        return $this->render('reader_article/show.html.twig', [
            'article' => $article,
        ]);
    }
}

/*
                    &.@.
                    &%(.
                    &&(.
                    &&%.
                    &((.
               *#.*@/%#@. @.
             .@  ( @ &.&,,  @.
                   /.,**
         @@@@@@@@@@@ # @@@@@@@@@@@*
       .@@@@.    ..% # @.*@@@%@@,
       @@,       ..@...@@@@ @@@   ,@@@@@@@@@@@@ (@@@@@%     (@@@@@@@@#(.     @@@@@%
                 ..@&.@@&./@@,    .(@@@@.  .@@@  @@@@@      .&@@@&. @@@@(    %@@@@@,.
                 ..@#@@@.@@&      .&@@@@   (.#@  @@@@@      .&@@@@   @@@@(   @@@@@@@.
                 ..@@@@@@@ ..*    .&@@@@&@@@.    @@@@@      .&@@@@  .&@@@@..@@@*@@@@#
               . @@@/&@@,,@@@@@*  .(@@@@ .@@..(  *@@@@    ,*.%@@@@  .#@@@@.#@@( (@@@@
               %@& @@@%@  .#%#  //,%@@@@   . @@  @@@@@   (@ .&@@@@   @@@@(%@@&%%%@@@@@.
             .@@ .@@@ .@    *@    .&@@@@   .@@(  @@@@@ .#@@*.&@@@@. @@@@#*@@%    @@@@@#
           .@@@ @@@/#.@(   ,@(    @@@@@@@@@@@@@ /@@@@@@@@@@**@@@@@@@@&( &@@@%    #@@@@@
         .#@@/@@@ .@..(@  (.   @@@&,                                                       ,
        .@@@@@@@@@@@...@@@@@@@@@@@   @ &@@@ @@ % @ @@@@ @ @@*@ @ @   @ ( @,,@ @ @@@ @@&@%@@,
                   #/..&                    @@ @ @@@ @@ @ @@@  @     @ % @ ,@.@@@ @ @@&@* @,
                 ..@...@
                 ..@ ..@
                   *(.*,
                    &.(.
                     *
*/
