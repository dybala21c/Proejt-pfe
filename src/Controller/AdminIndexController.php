<?php

namespace App\Controller;

use App\Entity\Conge;
use App\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 
class AdminIndexController extends AbstractController
{
    /**
     * @Route("/admin/index", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin_index/index.html.twig', [
            'controller_name' => 'AdminIndexController',
        ]);
    }

    /**
     * @Route("/list", name="conge_cote_admin", methods={"GET"})
     */
    public function list(): Response
    {
        $conge= new Conge();
        $conge = $this->getDoctrine()->getRepository(Conge::class)->findAll();
        return $this->render('conge/index_admin.html.twig', [
            'conges' => $conge,
        ]);
    }

    /**
     * @Route("/Viewcv", name="conge_admin", methods={"GET"})
     */
    public function voirCv(): Response
    {
        
        $enseignant = $this->getDoctrine()->getRepository(Enseignant::class)->findAll();
        return $this->render('conge/VoirCv.html.twig', [
            'enseignant' => $enseignant,
        ]);
    }

}
