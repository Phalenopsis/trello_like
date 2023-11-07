<?php

namespace App\Controller;

use App\Model\TrelloManager;

class TrelloController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $trelloManager = new TrelloManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $trelloManager->addTask();
            $trelloManager->addColumn();
            $trelloManager->supprTask();
        }
        return $this->twig->render('Trello/index.html.twig', ['session' => $_SESSION]);
    }

    public function reset(): void
    {
        $trelloManager = new TrelloManager();
        $trelloManager->reset();
        header('location: /');
    }
}
