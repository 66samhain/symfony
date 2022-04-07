<?php

namespace App\Handler;

use App\Entity\Song;
use App\Repository\SongRepository;

class SongHandler
{

    public function __construct(private SongRepository $songRepository) 
    {

    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */

    public function create(array $parameters): Song { // primeste un array de parametri, la final trimite obiectul Song inapoi in controller
        $song = new Song(); // creem o noua entitate
        //setam datele cu functiile autogenerate de maker bundle
        $song -> setVideoId($parameters['video_id']);
        $song -> setStart($parameters['start']);
        $song -> setEnd($parameters['end']);

        $this -> songRepository -> add($song, true); // adaugam in baza de date
        return $song;
    }

    public function update(Song $song, array $parameters): Song { // primeste un array de parametri, la final trimite obiectul Song inapoi in controller
        $song -> setVideoId($parameters['video_id']);
        $song -> setStart($parameters['start']);
        $song -> setEnd($parameters['end']);

        $this -> songRepository -> add($song, true); // adaugam in baza de date
        return $song;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Song $song) {
        $this -> songRepository -> remove($song);
    }
}