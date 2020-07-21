<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function indexFormation(Request $request, FormationRepository $formationRepository)
    {
        $repo = $this->getDoctrine()->getRepository(Formation::class);
        $formation = $repo->findAll();

      
        return $this->render('formation/index.html.twig', [
            'formations' => $formation
        ]);
    }

    /**
     * @Route("/show/formation/{id}", name="show_formation")
     */
    public function showFormation(Formation $formations, $id, Request $request, EntityManagerInterface $manager)
    {
     
        return $this->render('formation/show_formation.html.twig', [
            'formation' => $formations,
        ]);
    }

       /**
     * @Route("/ajouter", name="formation_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $image = $form->get('Photo')->getData();
                if($image){
                    $originalImage = pathinfo($image->getClientOriginalName(),PATHINFO_FILENAME);
                    $safeImage = $slugger->slug($originalImage);
                    $newImage = $safeImage.'-'.uniqid().'.'.$image->guessExtension();

                    try
                    {
                        $image ->move(
                            $this->getParameter('Image_directory'),
                            $newImage
                        );
                    }
                    catch(FileException $e)
                    {

                    }
                }


                $formation ->setPhoto($newImage);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute('list_formation');
        }

        return $this->render('formation/form.html.twig', [
            'formation' => $formation,
            'titre' => 'Ajouter',
            'form' => $form->createView(),
        ]);
    }

       /**
     * @Route("/list_formation", name="list_formation")
     */
    public function list(Request $request, FormationRepository $formationRepository)
    {
        $repo = $this->getDoctrine()->getRepository(Formation::class);
        $formation = $repo->findAll();

      
        return $this->render('formation/list.html.twig', [
            'list_formations' => $formation
        ]);
    }

    
    /**
     * @Route("/{id}/edit/formation", name="formation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formation $formation): Response
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
 
            return $this->redirectToRoute('list_formation');
        }

        return $this->render('formation/form.html.twig', [
            'annonce' => $formation,
            'titre' => 'Modifier',
            'form' => $form->createView(),
        ]);
    }


       /**
     * @Route("/{id}/delete", name="formation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Formation $formation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('list_formation');
    }


    /**
     * @Route("/{id}/show", name="formation1_show")
     */
    public function show(Formation $formations, $id, Request $request)
    {
        $formation = $this->getDoctrine()->getRepository(Formation::class)->find($id);
     
        return $this->render('formation/details.html.twig', [
            'formation' => $formation,
        ]);
    }

}
