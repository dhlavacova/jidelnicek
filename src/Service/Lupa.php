<?php

namespace App\Service;

use App\Entity\Lupa_get_set;

class Lupa
{
    /**
     * @param $x string retezec
     * @return void
     */
public function zvetsimText(Lupa_get_set $lupa_get_set)
{
    return $x=$lupa_get_set->getX();
   // return mb_strtoupper($x);
}


}