<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtisteController extends AbstractController
{
    /**
     * @Route("/admin/artistes", name="admin_artistes", methods={"GET"})
     */
    public function listeArtistes(ArtisteRepository $repo,  PaginatorInterface $paginator, Request $request): Response
    {
       // $artistes=$repo->findAll();
       // $artistes=$repo->listeArtistesComplete();
       $artistes=$paginator->paginate(
        $repo->listeArtistesCompletPaginee(),      /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        9 /*limit per page*/
    );

        return $this->render('admin/artiste/listeArtistes.html.twig', [
            // 'controller_name' => 'ArtisteController',
            'lesArtistes' => $artistes
        ]);

    }



        /**
     * @Route("/admin/artiste/ajout", name="admin_artiste_ajout", methods={"GET","POST"})
     */
    public function ajoutArtiste(Request $request , EntityManagerInterface $manager): Response
    {
        $artiste=new Artiste();
       
        $form=$this->createForm(ArtisteType::class, $artiste);
        $form->handleRequest($request);
      
        if ($form->isSubmitted() && $form->isValid()) { 
            $manager->persist($artiste);
            $manager->flush();
            $this->addFlash("success","L'artiste à bien été ajouté");
            return $this->redirectToRoute('admin_artistes');
        }
        return $this->render('admin/artiste/formAjoutArtiste.html.twig', [
            // 'controller_name' => 'ArtisteController',
            'formArtiste' => $form->createView()
        ]);

    }



}
