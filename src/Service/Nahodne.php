<?php

namespace App\Service;

use App\Entity\nahodneCislo;

class Nahodne
{



    /**
     * @return int nahodne cislo
     */
    public function nahodne_cislo($x,$y){
        return random_int($x,$y);
    }


    public function vysledek(nahodneCislo $nahodneCislo){
        $x = $nahodneCislo->getX();//ulozim do x,y hodnoty z formulare
        $y = $nahodneCislo->getY();

        if ($x>$y){
            return $this->nahodne_cislo($y,$x);
        }
        else
        return $this->nahodne_cislo($x,$y);
    }

}