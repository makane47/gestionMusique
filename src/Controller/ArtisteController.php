<?php

namespace App\Controller;


use App\Entity\Artiste;
use App\Repository\ArtisteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtisteController extends AbstractController
{
    /**
     * @Route("/artistes", name="artistes", methods={"GET"})
     */
    public function listeArtistes(ArtisteRepository $repo): Response
    {
        $test="test";
        $artistes=$repo->findAll();
        return $this->render('artiste/listeArtistes.html.twig', [
            // 'controller_name' => 'ArtisteController',
            'lesArtistes' => $artistes
        ]);
    }


    /**
     * @Route("/artiste/{id}", name="ficheArtiste", methods={"GET"})
     */

     public function ficheArtiste($id, ArtisteRepository $repo): Response
     {
        $artiste=$repo->find($id);
         return $this->render('artiste/ficheArtiste.html.twig', [
             'leArtiste' => $artiste
         ]);
     }
 

            /*
            public function ficheArtiste(Artiste $artiste): Response
            {
        
                return $this->render('artiste/ficheArtiste.html.twig', [
                    'leArtiste' => $artiste
                ]);
            }
            */

}
