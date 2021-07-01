<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SerieRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Serie;
use App\Form\SerieType;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(SerieRepository $repo): Response
    {
      
        $series = $repo->findAll();
        return $this->render('main/index.html.twig', [
            'series' => $series,
        ]);
    }

     /**
     * @Route("/ajouter", name="ajouter")
     */
    public function ajouter(Request $request): Response
    {
        $serie = new Serie(); // je crée un objet vide
        $form =  $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request); // hydrater $serie : $serie->Set*
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($serie);
            $em->flush();
            return $this->redirectToRoute('main');
        }
        return $this->render('main/ajouter.html.twig', [
            'formSerie' => $form->createView()
        ]);
    }
}
