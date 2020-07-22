<?php

namespace App\Controller;

use App\Entity\Conge;
use App\Form\CongeType;
use App\Repository\CongeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/conge")
 */
class CongeController extends AbstractController
{
    /**
     * @Route("/", name="conge_index", methods={"GET"})
     */
    public function index(CongeRepository $congeRepository): Response
    {
        return $this->render('conge/index.html.twig', [
            'conges' => $congeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="conge_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $conge = new Conge();
        $form = $this->createForm(CongeType::class, $conge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($conge);
            $entityManager->flush();

            return $this->redirectToRoute('conge_index');
        }

        return $this->render('conge/new.html.twig', [
            'conge' => $conge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conge_show", methods={"GET"})
     */
    public function show(Conge $conge): Response
    {
        return $this->render('conge/show.html.twig', [
            'conge' => $conge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="conge_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Conge $conge): Response
    {
        $form = $this->createForm(CongeType::class, $conge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conge_index');
        }

        return $this->render('conge/edit.html.twig', [
            'conge' => $conge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conge_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Conge $conge): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($conge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('conge_index');
    }
}
