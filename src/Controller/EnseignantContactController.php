<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantContactController extends AbstractController
{
    /**
     * @Route("/enseignant/contact", name="enseignant_contact")
     */
    public function index()
    {
        return $this->render('enseignant_contact/index.html.twig', [
            'controller_name' => 'EnseignantContactController',
        ]);
    } 
}
