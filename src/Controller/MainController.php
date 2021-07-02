<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(CategoryRepository $repo): Response
    {
        return $this->render('main/index.html.twig', [
            'categs' => $repo->findAll(),
        ]);
    }
}
