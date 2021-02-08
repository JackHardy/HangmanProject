<?php

namespace App\Data;

/**
 * Please petend this is some form of DB integration
 */

class TextData
{
    private $text_data;

    public function __construct($name, $word, $failed_guesses)
    {
        $this->text_data = array(
            'intro' => '<p>You wake up to find youself in a cell, it\'s dark and damp, but yet you feel a breeze. The fresh air flows from the window from which you hear bells tolling. "Here ye, here ye" shouts the town crier. <b>"Today marks the day of the execution of ' . $name . ', accused of treason!"</b>. You are cursed to be executed for a crime you did not commit, <i>"There must be a way out!"</i> you think to yourself. Across the room you see a lock on the jail door holding you from your freedom, it is made from big, bulky brass and is cold to the touch. Running your fingers across it you feel <b>' . strlen($word) . ' indents</b>... <i>"A code! Thats it!"</i> you think to yourself once again. But you must be careful as you spot some sort of mechanical counter with the number seven loaded in the slot on the lock. <b>You realise you must only have seven attempt to get this right</b>. You look outside once more to see the lazy townsfolk haven\'t even built the gallows yet. There is still time, you best get to work guessing.</p>',
            'success_1' => '<p><b>CLACK!</b> The sound of a tumbler falling into place is of great relief. You feel you are getting much closer now.</p>',
            'success_2' => '<p>A part of the code! Despite the continued ringing of the bells you feel confident to soldier on. <i>"I can do it!" you think to yourself.</i></p>',
            'success_3' => '<p>Great! The satisfaction of finding a part of the code fills you with elation as your hopes of getting out of here grow.</p>',
            'success_4' => '<p><b>CLICK</b> One down! The number on the side of the lock holds fast, great news. This means you are getting closer to escaping.</p>',
            'success_5' => '<p>Success! A piece of the code found, keep this up and you will be out in no time!</p>',
            'fail_guess_1' => '<p><b>THUNK!</b> The heavy thud of something in the lock shocks you, you immediately notice the number on the lock has dropped to six. A stark realisation that this is real. Peering outside once more you see the townsfolk building the foundations of the gallows.</p>',
            'fail_guess_2' => '<p><b>BADUNK!</b> <i>"Not another one!"</i> you think, panic setting in. You can here the hammering of nails and the chattering of people outside. Time is beggining to run short. The number on the lock now shows the number five.</p>',
            'fail_guess_3' => '<p><b>SHUNK!</b> The number on the lock hurtles down to the number four. As you begin to panic more and more you begin to mumble to yourself whilst fumbling with the lock. You jump to the window only to see the townfolk errecting a great wooden beam. It looks pretty tall but its not your fear of heights getting to you.</p>',
            'fail_guess_4' => '<p><b>CLANK!</b> Another wrong move haunts you to your core. Time is getting very thin, you best figure out the code soon before its too late! "Bring in the crossbar! Hurry up, hurry up. We don\'t have all day." You realise that the crossbar is the last bit of constuction left on the gallows. Not good at all! The lock shows the number three. Lucky for some.</p>',
            'fail_guess_5' => '<p><b>THUD! "DAMN!"</b> you yell out in frusration. This can\'t be it surely. You can\'t go out like this! You must persevere. The number two taunts you from within the brass lock. Catching your breath whilst gazing outside you see that the executioner is tieing the noose. This is looking really dire indeed.</p>',
            'fail_guess_6' => '<p>You hear the creaking of rusy metal gears, <b>CLANK!</b> The loudest sound you have heard from the lock... You know this is it. This is your last chance. Looking outside you see the rest of the townsfolk gathering. The lock has a large number one peering out from within its metalic walls. <i>"It is all or nothing at this point"</i> you gulp.</p>',
            'win' => '<p><i>"Phew!"</i> you think to yourself whilst taking a breather near the river just outside the town walls. Good job you figured out the code was "' . $word . '", any longer and you would have had a business meeting with the hooded executioner.</p>',
            'fail' => '<p><b>"Damn! I was so close, I was so sure of it!"</b> you shout at the top of your lungs just as the executioner shuffles into the jail. "Heh" snuffs the executioner "Trying to escape were ye? I doubt you would have ever guessed the code, but I will let you in on it seeing as you are soon to meet yer maker. It was ' . $word . ' of course! Better luck next time... oh wait, there won\'t be a next time!" He chuckles to himself. Just then a sack is thrown over your head as you are dragged out of your cell.</p>'
        );
    }

    /**
     * @return string
     */
    public function getTextData($index)
    {
        return $this->text_data[$index];
    }
}
