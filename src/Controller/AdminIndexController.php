<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
