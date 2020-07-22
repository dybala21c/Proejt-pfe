<?php

namespace App\Controller;

use App\Entity\Mutation;
use App\Form\MutationType;
use App\Repository\MutationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mutation")
 */
class MutationController extends AbstractController
{
    /**
     * @Route("/", name="mutation_index", methods={"GET"})
     */
    public function index(MutationRepository $mutationRepository): Response
    {
        return $this->render('mutation/index.html.twig', [
            'mutations' => $mutationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mutation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mutation = new Mutation();
        $form = $this->createForm(MutationType::class, $mutation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mutation);
            $entityManager->flush();

            return $this->redirectToRoute('mutation_index');
        }

        return $this->render('mutation/new.html.twig', [
            'mutation' => $mutation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mutation_show", methods={"GET"})
     */
    public function show(Mutation $mutation): Response
    {
        return $this->render('mutation/show.html.twig', [
            'mutation' => $mutation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mutation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mutation $mutation): Response
    {
        $form = $this->createForm(MutationType::class, $mutation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mutation_index');
        }

        return $this->render('mutation/edit.html.twig', [
            'mutation' => $mutation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mutation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mutation $mutation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mutation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mutation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mutation_index');
    }
}
