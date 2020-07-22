<?php

namespace App\Controller;

use App\Entity\Sanction;
use App\Form\SanctionType;
use App\Repository\SanctionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sanction")
 */
class SanctionController extends AbstractController
{
    /**
     * @Route("/", name="sanction_index", methods={"GET"})
     */
    public function index(SanctionRepository $sanctionRepository): Response
    {
        return $this->render('sanction/index.html.twig', [
            'sanctions' => $sanctionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sanction_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sanction = new Sanction();
        $form = $this->createForm(SanctionType::class, $sanction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sanction);
            $entityManager->flush();

            return $this->redirectToRoute('sanction_index');
        }

        return $this->render('sanction/new.html.twig', [
            'sanction' => $sanction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sanction_show", methods={"GET"})
     */
    public function show(Sanction $sanction): Response
    {
        return $this->render('sanction/show.html.twig', [
            'sanction' => $sanction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sanction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sanction $sanction): Response
    {
        $form = $this->createForm(SanctionType::class, $sanction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sanction_index');
        }

        return $this->render('sanction/edit.html.twig', [
            'sanction' => $sanction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sanction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sanction $sanction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sanction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sanction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sanction_index');
    }
}
