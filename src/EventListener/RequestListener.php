<?php

// src/EventListener/RequestListener.php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        if (!$event->isMainRequest()) {
            // don't do anything if it's not the main request
            return;
        }

        // luam datele din request
        $request = $event -> getRequest();
        $json = $request -> getContent(); // luam continutul requestului intr-un JSON, iar datele sunt de tip string, in PHP nu avem JSON ca structura de date
        $dataArray = json_decode($json, true); // ii dam true pt ca cheile sa se pastreze, sa fie un array asociativ

        if ($dataArray) { // daca exista data array adaugam datele in request
            $request -> request -> add($dataArray);
        }

    }
}