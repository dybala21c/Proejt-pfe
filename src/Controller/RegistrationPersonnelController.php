<?php

namespace App\Controller;

use App\Entity\Personnel;
use App\Form\RegistrationFormType;
use App\Form\RegistrationFormType2;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class RegistrationPersonnelController extends AbstractController
{
    /**
     * @Route("/register1", name="app_register1")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Personnel();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            ); 

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('list_personnel');
        }

        return $this->render('registrationPersonnel/register.html.twig', [
            'registrationForm' => $form->createView(),
            'type'=> 'Ajouter'
        ]);
    }

     /**
     * @Route("/listes", name="list_personnel", methods={"GET"})
     */
    public function indexPost(Request $request,PaginatorInterface $paginatorInterface)
    {
        
        $personnel = new Personnel();

        $donnee = $this->getDoctrine()->getRepository(Personnel::class)->findAll();
       
        $personnel = $paginatorInterface->paginate(
            $donnee,
            $request->query->getInt('page',1),
            4
        );

        return $this->render('registrationPersonnel/index.html.twig', [
            'personnels' => $personnel,
        ]);
    }

/**
     * @Route("/{id}/personnel", name="show_personnel", methods={"GET"})
     */
    public function show(Personnel $personnel): Response
    {
        return $this->render('registrationPersonnel/show.html.twig', [
            'personnel' => $personnel,
        ]);
    }

    /**
     * @Route("personnel/{id}/edit", name="personnel_edit", methods={"GET","POST"})
     */
    public function editPersonnel(Request $request, Personnel $personnel, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(RegistrationFormType2::class, $personnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           /* $personnel->setPassword(
                $passwordEncoder->encodePassword(
                    $personnel,
                    $form->get('password')->getData()
                )
            );*/
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list_personnel');
        }

        return $this->render('registrationPersonnel/edit.html.twig', [
            'personnel' => $personnel,
            'titre_personnel' => 'Modifier',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete_personnel", methods={"DELETE"})
     */
    public function delete(Request $request, Personnel $personnel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personnel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personnel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('list_personnel');
    }

}
