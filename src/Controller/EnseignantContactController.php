<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Enseignant;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantContactController extends AbstractController
{


     /**
     * @Route("/add/{id}", name="add_contact_enseignant", methods={"GET","POST"})
     */
    public function new(Request $request,$id): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Enseignant::class);
        $enseignant = $repository->find($id);

        $enseignantcontact = new Contact();
        $form = $this->createForm(ContactType::class, $enseignantcontact);
        $form->handleRequest($request);
        $enseignantcontact->setEnseignant($enseignant);

        if ($form->isSubmitted() && $form->isValid()) {
            $FormData = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enseignantcontact);
            $entityManager->flush();

            return $this->redirectToRoute('enseignant_home'); 
        }

        return $this->render('enseignant_contact/new.html.twig', [
            'contact' => $enseignantcontact,
            'form' => $form->createView(),
        ]);
    }



  
}
