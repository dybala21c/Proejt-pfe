<?php

namespace App\Controller;

use App\Entity\Annonce;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePersonnelController extends AbstractController
{
    /**
     * @Route("/home/personnel", name="home_personnel")
     */
    public function index(Request $request, PaginatorInterface $paginatorInterface)
    {
        $annonce_personnel = new Annonce();

        $donnee = $this->getDoctrine()->getRepository(Annonce::class)->findAll();

        $annonce_personnel = $paginatorInterface->paginate(
            $donnee,
            $request->query->getInt('page',1),
            5
        );
        return $this->render('home_personnel/index.html.twig', [
            'annonce_personnels'=> $annonce_personnel,
        ]);
    }

    /**
     * @Route("/{id}/personnel/annonce", name="annonce_personnel_show", methods={"GET"})
     */
    public function show(Annonce $annonce_personnel): Response
    {
        return $this->render('home_personnel/show.html.twig', [
            'annonce' => $annonce_personnel,
        ]);
    }
   
}
