<?php
namespace App;

/**
 * NumberHelper
 */
class NumberHelper {    
    /**
     * price
     *
     * @param  mixed $price
     * @param  mixed $unit
     * @return string ex: "10 000 $"
     */
    public static function price(float $price, string $unit = "$"):string {
        return number_format($price, 0, ",", " ") . " $unit";
    }
}
