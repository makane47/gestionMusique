<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlbumController extends AbstractController
{
    /**
     * @Route("/albums", name="albums", methods={"GET"})
     */
    public function listeAlbums(AlbumRepository $repo,  PaginatorInterface $paginator, Request $request): Response
    {
        // $albums=$repo->findAll();
        // $albums=$repo->findBy(['date' => 2006],['nom' => 'asc'],5);
        //   $albums=$repo->findBy([], ['nom' => 'asc']);

        // $albums=$repo->listeAlbumsComplete();
     
         $albums = $paginator->paginate(
            $repo->listeAlbumsComplete(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );

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
