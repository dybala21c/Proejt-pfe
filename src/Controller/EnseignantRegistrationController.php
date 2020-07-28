<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Form\EnseignantRegistrationType;
use App\Form\EnseignantRegistrationType2;
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
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\String\Slugger\SluggerInterface;

class EnseignantRegistrationController extends AbstractController
{
    /**
     * @Route("/enseignant/registration", name="enseignant_registration")
     */
    public function EnseignantRegister(Request $request, SluggerInterface $slugger, EntityManagerInterface $manager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $enseignant = new Enseignant();
        $form = $this->createForm(EnseignantRegistrationType::class, $enseignant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $brochureFile = $form->get('Cv')->getData();

            if ($brochureFile){
            $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

            try{
                $brochureFile->move(
                    $this->getParameter('brochures_directory'),
                    $newFilename
                );
            } catch (FileException $e){

            }

            $enseignant->setCv($newFilename);
            }

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
            'titre_enseignant' => 'Ajouter',
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
            3
        );

        return $this->render('enseignant_registration/liste.html.twig', [
            'enseignants' => $enseignant
        ]);
    }


    /**
     * @Route("/{id}/enseignant", name="show_enseignant", methods={"GET"})
     */
    public function show(Enseignant $enseignant): Response
    {
        return $this->render('enseignant_registration/show.html.twig', [
            'enseignant' => $enseignant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit_enseignant", methods={"GET","POST"})
     */
    public function edit(Request $request, SluggerInterface $slugger, Enseignant $enseignant, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(EnseignantRegistrationType2::class, $enseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $brochureFile = $form->get('Cv')->getData();

            if ($brochureFile){
            $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

            try{
                $brochureFile->move(
                    $this->getParameter('brochures_directory'),
                    $newFilename
                );
            } catch (FileException $e){

            }

            $enseignant->setCv($newFilename);
            }

     /*       $enseignant->setPassword(
                $passwordEncoder->encodePassword(
                    $enseignant,
                    $form->get('password')->getData()
                )
            );*/
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list_enseignant');
        }

        return $this->render('enseignant_registration/edit.html.twig', [
            'enseignant' => $enseignant,
            'titre_enseignant' => 'Modifier',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("enseignant/{id}/delete", name="delete_enseignant", methods={"DELETE"})
     */
    public function delete(Request $request, Enseignant $enseignant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseignant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enseignant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('list_enseignant');
    }

    
}
