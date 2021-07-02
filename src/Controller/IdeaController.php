<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use App\Repository\IdeaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IdeaController extends AbstractController
{
    /**
     * @Route("/admin/idea", name="idea_home")
     */
    public function index(IdeaRepository $repo,Request $request,EntityManagerInterface $em): Response
    {
        $idea = new Idea();
        $form = $this->createForm(IdeaType::class,$idea);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($idea);
            $em->flush();
            return $this->redirectToRoute('idea_home'); 

        }

        return $this->render('idea/index.html.twig', [
            'ideas' => $repo->findAll(),
            'formIdea' => $form->createView()
        ]);
    }
}
