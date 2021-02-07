<?php

namespace App\Controller;

use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HangmanController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function indexAction()
    {
        $_SERVER['HTTP_REFERER'] == "https://127.0.0.1:8000/hangman" ? $chicken = true : $chicken = false;

        return $this->render('hangman/index.html.twig', [
            'chicken' => $chicken
        ]);
    }

    /**
     * @Route("/hangman", name="app_hangman")
     */
    public function playGameAction()
    {
        $name = isset($_POST['name']) ? $_POST['name'] : 'John Doe';
        $difficulty = isset($_POST['difficulty']) ? $_POST['difficulty'] : 1;
        $guesses = isset($_POST['guesses']) ? $_POST['guesses'] : null;
        $word = isset($_POST['word']) ? $_POST['word'] : null;
        $word_definition = isset($_POST['word_definition']) ? $_POST['word_definition'] : null;
        $letters_guessed = isset($_POST['letters_guessed']) ? $_POST['letters_guessed'] : null;
        $revealed_word = isset($_POST['revealed_word']) ? $_POST['revealed_word'] : null;
        $failed_guesses = isset($_POST['failed_guesses']) ? $_POST['failed_guesses'] : null;
        $game = new Game($name, $difficulty, $guesses, $word, $word_definition, $letters_guessed, $revealed_word, $failed_guesses);

        if (isset($_POST['guess'])) {
            $game->guess($_POST['guess']);
        }

        $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : null;
dump($game->getWinFailCondition());
        return $this->render('hangman/game.html.twig', [
            'birthday' => $birthday,
            'name' => $game->getName(),
            'difficulty' => $game->getDifficulty(),
            'guesses' => $game->getGuesses(),
            'word' => $game->getWord(),
            'word_definition' => $game->getWordDefinition(),
            'letters_guessed' => $game->getLettersGuessed(),
            'revealed_word' => $game->getRevealedWord(),
            'failed_guesses' => $game->getfailedGuesses(),
            'win_fail_condition' => $game->getWinFailCondition()
        ]);
    }
}
