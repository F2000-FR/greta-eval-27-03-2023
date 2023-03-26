<?php

namespace App\Manager;

use App\Entity\Character;

class GameManager
{
    public function prepareFight(): void
    {
        // prepare game (reset messages)
        $_SESSION['fight_characters'] = array_values($_SESSION['fight_characters']);
        $_SESSION['fight_messages'] = [];

        // for each player, we prepare the player to fight (restore health and mana)
        foreach ($_SESSION['fight_characters'] as $oCharacter) {
            $oCharacter->prepareFight();
        }
    }

    /**
     * @param Character $a
     * @param Character $b
     */
    public function fight(Character $a, Character $b)
    {
        $a->hit($b);

        if ($b->isAlive()) {
            $b->hit($a);
        } else {
            $_SESSION['fight_messages'][] = $b . ' est mort';
        }
    }
}
