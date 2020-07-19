<?php

namespace App\Controller;

use App\Entity\Grade1;
use App\Form\Grade1Type;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/grade1")
 */
class Grade1Controller extends AbstractController
{
    /**
     * @Route("/", name="grade1_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginatorInterface): Response
    {

        $grade1 = new Grade1();

        $donnee = $this->getDoctrine()->getRepository(Grade1::class)->findAll();

        $grade1 = $paginatorInterface->paginate(
            $donnee,
            $request->query->getInt('page',1),
            5
        );

        return $this->render('grade1/index.html.twig', [
            'grade1s' => $grade1,
        ]);
    }

    /**
     * @Route("/new", name="grade1_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $grade1 = new Grade1();
        $form = $this->createForm(Grade1Type::class, $grade1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($grade1);
            $entityManager->flush();

            return $this->redirectToRoute('grade1_index');
        }

        return $this->render('grade1/new.html.twig', [
            'grade1' => $grade1,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="grade1_show", methods={"GET"})
     */
    public function show(Grade1 $grade1): Response
    {
        return $this->render('grade1/show.html.twig', [
            'grade1' => $grade1,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="grade1_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Grade1 $grade1): Response
    {
        $form = $this->createForm(Grade1Type::class, $grade1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('grade1_index');
        }

        return $this->render('grade1/edit.html.twig', [
            'grade1' => $grade1,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="grade1_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Grade1 $grade1): Response
    {
        if ($this->isCsrfTokenValid('delete'.$grade1->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($grade1);
            $entityManager->flush();
        }

        return $this->redirectToRoute('grade1_index');
    }
}
