<?php

namespace App\Controller;

use App\Entity\Annonce;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantHomeController extends AbstractController
{
    /**
     * @Route("/enseignant/home", name="enseignant_home")
     */
    public function index(Request $request, PaginatorInterface $paginatorInterface)
    {
        $annonce_enseignant = new Annonce();

        $donnee = $this->getDoctrine()->getRepository(Annonce::class)->findAll();

        $annonce_enseignant = $paginatorInterface->paginate(
            $donnee,
            $request->query->getInt('page',1),
            5
        );
        return $this->render('enseignant_home/index.html.twig', [
            'annonce_enseignants'=> $annonce_enseignant,
        ]);
    }

    
    /**
     * @Route("/{id}/enseignant/annonce", name="annonce_enseignant_show", methods={"GET"})
     */
    public function show(Annonce $annonce_enseignant): Response
    {
        return $this->render('enseignant_home/show.html.twig', [
            'annonce' => $annonce_enseignant,
        ]);
    }



}
