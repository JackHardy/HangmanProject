<?php

namespace App\Entity;

use Symfony\Component\HttpClient\HttpClient;

class Game
{
    private $name;
    private $difficulty;
    private $guesses;
    private $word;
    private $word_definition;
    private $letters_guessed;
    private $revealed_word;
    private $failed_guesses;
    private $fail = false;
    private $win = false;

    public function __construct($name, $difficulty, $guesses, $word, $word_definition, $letters_guessed, $revealed_word, $failed_guesses)
    {
        $this->name = $name;
        $this->difficulty = $difficulty;
        $this->guesses = $guesses;
        $this->word = $word;
        $this->word_definition = $word_definition;
        $this->letters_guessed = explode(",", $letters_guessed);
        $this->failed_guesses = $failed_guesses;

        if ($word == null && $word_definition == null) {
            $this->initialiseGame();
        }

        if ($revealed_word == null) {
            $this->revealed_word = $this->blankWord($this->word);
        }
        else {
            $this->revealed_word = explode(",", $revealed_word);
        }
    }

    public function initialiseGame()
    {
        $this->guesses = 0;
        $this->failed_guesses = 0;
        $this->fail = false;
        $this->win = false;
        $this->generateWord();
    }

    public function guess($guess)
    {
        $this->letters_guessed[] = $guess;
        $this->checkReveal($guess);
        $this->guesses++;
    }

    private function generateWord()
    {

        $initial_words = $this->fetchWords();
        $sorted_words = $this->groupWords($initial_words);
        $words = $this->pickDifficultyWords($sorted_words);
        $final_word = $this->validateWordDefinition($words);

        $this->word = strtoupper($final_word["word"]);
        $this->word_definition = $final_word["results"][rand(0, count($final_word["results"]) - 1)]["definition"];
        dump($final_word);
    }

    /**
     * @return array $initial_words
     */
    private function fetchWords(): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://random-word-api.herokuapp.com/word?number=1000'
        );

        $initial_words = $response->getContent();
        $initial_words = $response->toArray();

        return $initial_words;
    }

    /**
     * @param array $initial_words
     * 
     * @return array $sorted_words
     */
    private function groupWords(array $initial_words)
    {
        $sorted_words = array();

        foreach ($initial_words as $key => $value) {
            $length = strlen($value);

            switch (true) {
                case $length <= 5:
                    $sorted_words[0][] = $value;
                    break;
                case $length <= 7:
                    $sorted_words[1][] = $value;
                    break;
                case $length <= 9:
                    $sorted_words[2][] = $value;
                    break;
                default:
                    $sorted_words[3][] = $value;
                    break;
            }
        }

        return $sorted_words;
    }

    /**
     * @param array $sorted_words
     * 
     * @return array $words
     */
    private function pickDifficultyWords(array $sorted_words)
    {
        $words = $sorted_words[$this->difficulty];

        return $words;
    }

    /**
     * @param array $words
     * 
     * @return array $word
     */
    private function validateWordDefinition(array $words)
    {
        foreach ($words as $key => $value) {
            $client = HttpClient::create();
            $response = $client->request(
                'GET',
                'https://wordsapiv1.p.rapidapi.com/words/' . $value,
                [
                    'headers' => [
                        'x-rapidapi-key' => 'f3ecd0071cmsh6b0c5d016df9c38p194e02jsnb7ef613a064f',
                        'x-rapidapi-host' => 'wordsapiv1.p.rapidapi.com'
                    ],
                ]
            );

            $statusCode = $response->getStatusCode();
            if ($statusCode != 200) {
                continue;
            }

            $word = $response->getContent();
            $word = $response->toArray();

            if (array_key_exists('results', $word)) {
                foreach ($word['results'] as $key => $result) {
                    if (array_key_exists('definition', $word['results'][$key])) {
                        break 2;
                    }
                }
            }
        }

        return $word;
    }

    /**
    * @param string $guess
    * 
    */
    public function checkReveal($guess)
    {
        if (in_array($guess, str_split($this->word))) {
            $this->updateRevealedWord($guess);
        }
        else {
            $this->failed_guesses++;
        }
        
        $this->checkWinFailCondition();
    }

    /**
    * @param string $guess
    * 
    */
    public function updateRevealedWord($guess)
    {
        $character_array = str_split($this->word);
        $new_revealed_word = array();

        foreach ($character_array as $key => $value) {
            if($guess == $value || $this->revealed_word[$key] == $value) {
                $new_revealed_word[] = $value;
            }
            else {
                $new_revealed_word[] = "_";
            }
        }

        $this->revealed_word = $new_revealed_word;
    }

    /**
    * @param string $word
    * 
    * @return array $blank_word
    */
    private function blankWord(string $word)
    {
        $blank_word = array();

        for ($i=0; $i < strlen($word); $i++) { 
            $blank_word[] = "_";
        }

        return $blank_word;
    }

    private function checkWinFailCondition()
    {
        if ($this->failed_guesses >= 7) {
            $this->fail = true;
        }

        $string_revealed_word = implode("", $this->revealed_word);

        if (strpos($string_revealed_word, "_") === false) {
            $this->win = true;
            dump($string_revealed_word);
        }
    }   

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @return int
     */
    public function getGuesses()
    {
        return $this->guesses;
    }

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @return string
     */
    public function getWordDefinition()
    {
        return $this->word_definition;
    }

    /**
     * @return array
     */
    public function getLettersGuessed()
    {
        return $this->letters_guessed;
    }

    /**
    * @return array
    */
    public function getRevealedWord()
    {
        return $this->revealed_word;
    }

    /**
    * @return int
    */
    public function getFailedGuesses()
    {
        return $this->failed_guesses;
    }

    /**
    * @return int
    */
    public function getWinFailCondition()
    {
        if ($this->win == true) {
            return 2;
        }
        else if ($this->fail == true) {
            return 1;
        }
        else {
            return 0;
        }
    }
}
