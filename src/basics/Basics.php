<?php

namespace basics;

class Basics implements BasicsInterface
{
    public function __construct(BasicsValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Defines a quarter of a minute
     *
     * @param integer $minute
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getMinuteQuarter(int $minute): string
    {
        $this->validator->isMinutesException($minute);

        if ($minute >= 1 && $minute <= 15) {
            return "first";
        } elseif ($minute >= 16 && $minute <= 30) {
            return "second";
        } elseif ($minute >= 31 && $minute <= 45) {
            return "third";
        } elseif (($minute >= 46 && $minute <= 59) || $minute === 0) {
            return "fourth";
        }
    }

    /**
     * Checks the leap year
     *
     * @param integer $year
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function isLeapYear(int $year): bool
    {
        $this->validator->isYearException($year);

        return ((($year % 4 === 0) && ($year % 100 !== 0)) || ($year % 400 === 0));
    }

    /**
     * Checks for equality of sums
     *
     * @param string $input
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);

        $arrayForDigits = str_split($input);
        $sumOfFirstHalf = 0;
        $sumOfSecondHalf = 0;
        $halfLength = count($arrayForDigits) / 2;

        for ($i = 0; $i < count($arrayForDigits); $i++) {
            if ($i < $halfLength) {
                $sumOfFirstHalf += $arrayForDigits[$i];
            } else {
                $sumOfSecondHalf += $arrayForDigits[$i];
            }
        }
        
        return $sumOfFirstHalf === $sumOfSecondHalf;
    }
}
