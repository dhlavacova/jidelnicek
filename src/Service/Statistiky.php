<?php

namespace App\Service;

use App\Entity\StatisData;

class Statistiky
{

    /** secte cisla
     * @param StatisData $statisData string cisel
     * @return int rada cisel od nejmensi
     */
    public function suma(StatisData $statisData): string
    {
        $statisData = $statisData->getStatisData();
        $statisData = explode(' ', $statisData);
        return array_sum($statisData);
    }

    /** da nejmensi cislo
     * @param $formData string cisel
     * @return float|int rada cisel od nejmensi
     */
    public function nejmensi(StatisData $statisData): string
    {
        $formData = $statisData->getStatisData();
        $formData = explode(' ', $formData);
        sort($formData);
        return $formData[0];
    }

    /** da nejvetsi cislo
     * @param $formData string cisel
     * @return string cisel od nejmensi
     */
    public function nejvetsi(StatisData $statisData): string
    {
        $formData = $statisData->getStatisData();
        $formData = explode(' ', $formData);
        rsort($formData);
        return $formData[0];
    }

    /** da prumer
     * @param $formData string cisel
     * @return float|int rada cisel od nejmensi
     */
    public function prumer(StatisData $statisData): string
    {
        $formData = $statisData->getStatisData();
        $formData = explode(' ', $formData);

        return round(array_sum($formData) / count($formData), 2);
    }

    /** seradi cisla od nejmensiho
     * @param $formData array cisel
     * @return float|int rada cisel od nejmensi
     */
    public function od_nejmensiho(StatisData $statisData): array
    {
        $formData = $statisData->getStatisData();
        $formData = explode(' ', $formData);
        sort($formData);
        return $formData;
        // return implode(', ', $formData);
    }

    /** seradi cisla od nejvetsiho
     * @param StatisData $statisData
     * @return array rada cisel od nejmensi
     */
    public function od_nejvetsiho(StatisData $statisData): array
    {
        $formData = $statisData->getStatisData();
        $formData = explode(' ', $formData);
        rsort($formData);
        return $formData;
        // return implode(', ', $formData);
    }

    /** prevede strin  na ascii, porovnam zda obsahuji hodnoty od 48-57, ty ulozim a prevedu zpet na pole
     * tady pouze prevedu pole na string
     * @param StatisData $statisData
     * @return array vrati pole vyplnene abecedou
     */
    /*public function prevod_do_ascii(StatisData $statisData):array
    {
        $formData = $statisData->getFormData();

        for ($pos = 0; $pos < strlen($formData); $pos++) {
            $byte = $formData[$pos];
            $hodnoty = ord($byte).',';
        }
        return explode(',',$hodnoty);
    }*/

    /** vyfiltruje nechtene znaky
     * @param StatisData $statisData
     * @return string vrati pole vyplnene abecedou
     */
    public function filter_nechtenych_pismen(StatisData $statisData): string
    {
        $formData = $statisData->getStatisData();
        return preg_replace('/[^0-9. ]/', '', $formData);
    }
}