<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Entity\Formation;
use App\Entity\InscriptionFormation;
use App\Form\InscriptionFormationType;
use App\Repository\InscriptionFormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

     /**
     * @Route("/show/inscription/{id}", name="inscription_show")
     */
    public function showFormation(InscriptionFormation $inscriptionformation, $id, Request $request, EntityManagerInterface $manager)
    {
     
        return $this->render('inscription_formation/show.html.twig', [
            'inscriptionformation' => $inscriptionformation,
        ]);
    }


    /**
     * @Route("/{id}/inscrit", name="inscription_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InscriptionFormation $inscriptionformation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscriptionformation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inscriptionformation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('list_inscription');
    }


      /**
     * @Route("/list_inscription", name="list_inscription")
     */
    public function list(Request $request, InscriptionFormationRepository $inscriptionFormationRepository)
    {
        $repo = $this->getDoctrine()->getRepository(InscriptionFormation::class);
        $inscriptionFormation = $repo->findAll();

      
        return $this->render('inscription_formation/list.html.twig', [
            'list_formations' => $inscriptionFormation
        ]);
    }

}
