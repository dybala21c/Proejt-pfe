<?php

namespace App\Controller;

use App\Entity\NiveauEtude;
use App\Form\NiveauEtudeType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/niveau/etude")
 */
class NiveauEtudeController extends AbstractController
{
    /**
     * @Route("/", name="niveau_etude_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginatorInterface): Response
    { 
        
        $niveauEtude = new NiveauEtude();

        $donnee = $this->getDoctrine()->getRepository(NiveauEtude::class)->findAll();

        $niveauEtude = $paginatorInterface->paginate(
            $donnee,
            $request->query->getInt('page',1),
            5
        );


        return $this->render('niveau_etude/index.html.twig', [
            'niveau_etudes' => $niveauEtude,
        ]);
    }

    /**
     * @Route("/new", name="niveau_etude_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $niveauEtude = new NiveauEtude();
        $form = $this->createForm(NiveauEtudeType::class, $niveauEtude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($niveauEtude);
            $entityManager->flush();

            return $this->redirectToRoute('niveau_etude_index');
        }

        return $this->render('niveau_etude/new.html.twig', [
            'niveau_etude' => $niveauEtude,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="niveau_etude_show", methods={"GET"})
     */
    public function show(NiveauEtude $niveauEtude): Response
    {
        return $this->render('niveau_etude/show.html.twig', [
            'niveau_etude' => $niveauEtude,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="niveau_etude_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NiveauEtude $niveauEtude): Response
    {
        $form = $this->createForm(NiveauEtudeType::class, $niveauEtude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('niveau_etude_index');
        }

        return $this->render('niveau_etude/edit.html.twig', [
            'niveau_etude' => $niveauEtude,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="niveau_etude_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NiveauEtude $niveauEtude): Response
    {
        if ($this->isCsrfTokenValid('delete'.$niveauEtude->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($niveauEtude);
            $entityManager->flush();
        }

        return $this->redirectToRoute('niveau_etude_index');
    }
}
