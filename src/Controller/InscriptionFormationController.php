<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Entity\Formation;
use App\Entity\InscriptionFormation;
use App\Form\InscriptionFormationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionFormationController extends AbstractController
{
    /**
     * @Route("/inscription/formation/{enseignant}/{formations}", name="inscription_formation")
     */
    public function indexInscriptionFormation(Formation $formations, Enseignant $enseignant, Request $request, EntityManagerInterface $manager)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Enseignant::class);
        $enseignant = $repository->find($enseignant);

        $repo = $this->getDoctrine()->getManager()->getRepository(Formation::class);
        $formations = $repo->find($formations);

        $inscriptionformation = new InscriptionFormation();
        $form = $this->createForm(InscriptionFormationType::class, $inscriptionformation);
        $form->handleRequest($request);
        $inscriptionformation->setEnseignant($enseignant);
        $inscriptionformation->setFormation($formations);

        if ($form->isSubmitted() && $form->isValid()){
            $FormData = $form->getData();
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($inscriptionformation);
            $manager->flush();

            $this->addFlash('success','Vous êtes incrit à cette formation');
            return $this->redirectToRoute('formation');
        }

        return $this->render('inscription_formation/index.html.twig', [
            'formations' => $formations,
            'enseignant' => $enseignant,
            'formInscriptionFormation' =>$form->createView(),
        ]);
    }
}
