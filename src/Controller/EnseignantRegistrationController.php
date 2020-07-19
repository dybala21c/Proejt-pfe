<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Form\EnseignantRegistrationType;
use App\Repository\EnseignantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class EnseignantRegistrationController extends AbstractController
{
    /**
     * @Route("/enseignant/registration", name="enseignant_registration")
     */
    public function EnseignantRegister(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $enseignant = new Enseignant();
        $form = $this->createForm(EnseignantRegistrationType::class, $enseignant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $enseignant->setPassword(
                $passwordEncoder->encodePassword(
                    $enseignant,
                    $form->get('password')->getData()
                )
            );

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($enseignant);
            $manager->flush();

            return $this->redirectToRoute('list_enseignant');
        }

        return $this->render('enseignant_registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
     /**
     * @Route("/liste", name="list_enseignant", methods={"GET"})
     */
    public function index(Request $request,PaginatorInterface $paginatorInterface)
    {
        
        $enseignant = new Enseignant();

        $donnee = $this->getDoctrine()->getRepository(Enseignant::class)->findAll();
       
        $enseignant = $paginatorInterface->paginate(
            $donnee,
            $request->query->getInt('page',1),
            4
        );

        return $this->render('enseignant_registration/liste.html.twig', [
            'enseignants' => $enseignant
        ]);
    }

    
}
