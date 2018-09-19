<?php
namespace App\API\V1\Classes;


/**
 * Class Bijective
 */
class Bijective
{
    /**
     * @var array Alphabet for coding
     */
    private $alphabet;

    /**
     * @var int
     */
    private $base;

    /**
     * @param string $alphabet Alphabet for coding
     */
    public function __construct($alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
    {
        $this->alphabet = str_split($alphabet);
        $this->base = \count($this->alphabet);
    }

    /**
     * @param int $number Number for encode
     * @return string The encoded value
     */
    public function encode($number)
    {
        if ($number === 0) {
            return $this->alphabet[0];
        }

        $result = array();
        while ($number > 0) {
            $result[] = $this->alphabet[($number % $this->base)];
            $number = floor($number / $this->base);
        }

        return implode(array_reverse($result));
    }

    /**
     * @param string $string String for decode
     * @return int The decoded value
     */
    public function decode($string)
    {
        $num = 0;
        $alphabet = array_flip($this->alphabet);

        foreach (str_split($string) as $char) {
            $num = $num * $this->base + $alphabet[$char];
        }

        return $num;
    }
}