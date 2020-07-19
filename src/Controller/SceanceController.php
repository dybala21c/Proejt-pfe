<?php

namespace App\Controller;

use App\Entity\Sceance;
use App\Form\SceanceType;
use App\Repository\SceanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sceance")
 */
class SceanceController extends AbstractController
{
    /**
     * @Route("/", name="sceance_index", methods={"GET"})
     */
    public function index(SceanceRepository $sceanceRepository): Response
    {
        return $this->render('sceance/index.html.twig', [
            'sceances' => $sceanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sceance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sceance = new Sceance();
        $form = $this->createForm(SceanceType::class, $sceance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sceance);
            $entityManager->flush();

            return $this->redirectToRoute('sceance_index');
        }

        return $this->render('sceance/new.html.twig', [
            'sceance' => $sceance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sceance_show", methods={"GET"})
     */
    public function show(Sceance $sceance): Response
    {
        return $this->render('sceance/show.html.twig', [
            'sceance' => $sceance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sceance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sceance $sceance): Response
    {
        $form = $this->createForm(SceanceType::class, $sceance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sceance_index');
        }

        return $this->render('sceance/edit.html.twig', [
            'sceance' => $sceance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sceance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sceance $sceance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sceance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sceance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sceance_index');
    }
}
