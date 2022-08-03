<?php

namespace App\Service;
use App\Entity\Operation;

/**
 * Model operací kalkulačky.
 */
class Calculator
{

    /**
     * Sečte daná čísla a vrátí výsledek.
     * @param int $x první číslo
     * @param int $y druhé číslo
     * @return int výsledek po sčítání
     */
    public function add(int $x, int $y): int
    {
        return $x + $y;
    }

    /**
     * Odečte druhé číslo od prvního a vrátí výsledek.
     * @param int $x první číslo
     * @param int $y druhé číslo
     * @return int výsledek po odčítání
     */
    public function subtract(int $x, int $y): int
    {
        return $x - $y;
    }

    /**
     * Vynásobí daná čísla a vrátí výsledek.
     * @param int $x první číslo
     * @param int $y druhé číslo
     * @return int výsledek po násobení
     */
    public function multiply(int $x, int $y): int
    {
        return $x * $y;
    }

    /**
     * Vydělí první číslo druhým bezezbytku a vrátí výsledek.
     * @param int $x první číslo
     * @param int $y druhé číslo; nesmí být 0
     * @return int výsledek po dělení bezezbytku
     */
    public function divide(int $x, int $y): int
    {
        return round($x / $y);
    }
    /** Definice konstant pro operace. */
    const
        ADD = 1,
        SUBTRACT = 2,
        MULTIPLY = 3,
        DIVIDE = 4;

    /**
     * Getter pro existující operace.
     * @return array asociativní pole konstant pro operace a jejich slovního pojmenování
     */
    public function getOperations(): array
    {
        return [
            'Sčítání' => self::ADD,
            'Odčítání' => self::SUBTRACT,
            'Násobení' => self::MULTIPLY,
            'Dělení' => self::DIVIDE
        ];
    }

    /**
     * Zavolá zadanou operaci a vrátí její výsledek.
     * @param Operation $operation zadaná operace
     * @return int|null výsledek operace nebo null, pokud zadaná operace neexistuje
     */
    public function calculate(Operation $operation): ?int
    {
        $x = $operation->getX();
        $y = $operation->getY();

        switch ($operation->getOperation()) {
            case self::ADD:
                return $this->add($x, $y);
            case self::SUBTRACT:
                return $this->subtract($x, $y);
            case self::MULTIPLY:
                return $this->multiply($x, $y);
            case self::DIVIDE:
                return $this->divide($x, $y);
            default:
                return null;
        }
    }
}