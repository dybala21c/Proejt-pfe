<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantHomeController extends AbstractController
{
    /**
     * @Route("/enseignant/home", name="enseignant_home")
     */
    public function index()
    {
        return $this->render('enseignant_home/index.html.twig', [
            'controller_name' => 'EnseignantHomeController',
        ]);
    }
}
