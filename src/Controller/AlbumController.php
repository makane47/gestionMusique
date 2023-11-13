<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlbumController extends AbstractController
{
    /**
     * @Route("/albums", name="albums", methods={"GET"})
     */
    public function listeAlbums(AlbumRepository $repo): Response
    {
        // $albums=$repo->findAll();
        $albums=$repo->findBy(['date' => 2006],['nom' => 'asc'],5);
        return $this->render('album/listeAlbums.html.twig', [
            // 'controller_name' => 'AlbumController',
            'lesAlbums' => $albums
        ]);
    }


    /**
     * @Route("/album/{id}", name="ficheAlbum", methods={"GET"})
     */

     public function ficheAlbum($id, AlbumRepository $repo): Response
     {
        $album=$repo->find($id);
         return $this->render('album/ficheAlbum.html.twig', [
             'leAlbum' => $album
         ]);
     }
 
}
