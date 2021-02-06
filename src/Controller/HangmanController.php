<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HangmanController extends AbstractController
{
    #[Route('/hangman', name: 'hangman')]
    public function index(): Response
    {
        return new Response('What a bewitching controller we have conjured!');
    }
}
