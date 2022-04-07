<?php

namespace App\Transformer;

//importam clasa
use App\Entity\Song;

class SongTransformer
{

    public function transform(?Song $song): array { // primeste un obiect de tip Song care e nullable, raspunde cu un array
        return [ // raspundem cu un array care contine toate datele
            "id" => $song -> getId(),
            "videoId" => $song -> getVideoId(),
            "start" => $song -> getStart(),
            "end" => $song -> getEnd()
        ];
    }

    public function transformList(array $songs): array { // primeste ca parametru un array de melodii si raspunde tot cu un array
        // transforma un array de obiecte intr-un array de array-uri
        $songsArray = [];

        foreach ($songs as $song) {
            $songsArray[] = $this -> transform($song); // folosim functia transform din aceasta clasa pe elementul $song
        }

        return $songsArray;
    }

}