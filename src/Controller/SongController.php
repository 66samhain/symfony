<?php

namespace App\Controller;

use App\Entity\Song;
use App\Handler\SongHandler;
use App\Transformer\SongTransformer;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/song")
 */

class SongController extends AbstractController
{

    public function __construct(
        private SongHandler $songHandler,
        private SongRepository $songRepository, // are o metoda find all
        private SongTransformer $songTransformer
    ) { // dependency injection, injectam parametrii din Song Handler
        
    }

    /**
     * @Route("", methods={"POST"})
     */
    public function createSongAction (Request $request) { // vrem sa aiba o actiune de create
        $song = $this -> songHandler -> create($request -> request -> all()); // punem toate datele in variabila songHandler din clasa, apoi salvam obiectul Song intr- variabila
        $songArray = $this -> songTransformer -> transform($song);

        return new JsonResponse($songArray, Response:: HTTP_CREATED);
    }

    /**
     * @Route("/all", methods={"GET"})
     */
    public function getAllSongs() { // functie care afiseaza toate melodiile, nu primeste nimic deoarece e o ruta de tip get
        $songs = $this -> songRepository -> findAll(); // returneaza toate melodiile
        $songsArray = $this -> songTransformer -> transformList($songs);
        return new JsonResponse($songsArray, Response:: HTTP_OK);
    }


    /**
     * @param Song $song
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @Route("/{songId}", methods={"GET"})
     * @ParamConverter("song", options={"id" = "songId"}) // vrem ca id melodiei sa faca match cu song id din url
     */
    public function getSongAction (Song $song): JsonResponse {
        $songArray = $this -> songTransformer -> transform($song);

        return new JsonResponse($songArray, Response:: HTTP_OK);
    }

    /**
     * @param Request $request
     * @param Song $song
     * @Route("/{songId}", methods={"PUT"})
     * @ParamConverter("song", options={"id" = "songId"}) // vrem ca id melodiei sa faca match cu song id din url
     */
    public function updateSongAction (Request $request, Song $song) {
        $song = $this -> songHandler -> update($song, $request -> request -> all()); // punem toate datele in variabila songHandler din clasa, apoi salvam obiectul Song intr- variabila
        $songArray = $this -> songTransformer -> transform($song);

        return new JsonResponse($songArray, Response:: HTTP_OK);
    }

    /**
     * @param Request $request
     * @Route("/{songId}", methods={"DELETE"})
     * @ParamConverter("song", options={"id" = "songId"}) // vrem ca id melodiei sa faca match cu song id din url
     */
    public function deleteSongAction(Song $song): JsonResponse
    {
        $this->songHandler->delete($song);
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}