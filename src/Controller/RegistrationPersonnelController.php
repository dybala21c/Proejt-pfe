<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Entity\Personnel;
use App\Form\RegistrationFormType;
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
                    $form->get('plainPassword')->getData()
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
     * @Route("/list", name="list_personnel", methods={"GET"})
     */
    public function index(Request $request,PaginatorInterface $paginatorInterface)
    {
        
        $personnel = new Personnel();

        $donnee = $this->getDoctrine()->getRepository(Personnel::class)->findAll();
       
        $personnel = $paginatorInterface->paginate(
            $donnee,
            $request->query->getInt('page',1),
            4
        );

        return $this->render('registrationPersonnel/index.html.twig', [
            'personnels' => $personnel
        ]);
    }

}
