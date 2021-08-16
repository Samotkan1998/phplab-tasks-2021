<?php

namespace basics;

class BasicsValidator implements BasicsValidatorInterface
{
    /**
     * Checks for an exception for minute
     *
     * @param integer $minute
     * @return void
     * @throws \InvalidArgumentException
     */
    public function isMinutesException(int $minute): void
    {
        if ($minute < 0 || $minute > 60) {
            throw new \InvalidArgumentException;
        }
    }

    /**
     * Checks for an exception for year
     *
     * @param integer $year
     * @return void
     * @throws \InvalidArgumentException
     */
    public function isYearException(int $year): void
    {
        if ($year < 1900) {
            throw new \InvalidArgumentException;
        }
    }

    /**
     * Checks for an exception for string
     *
     * @param string $input
     * @return void
     * @throws \InvalidArgumentException
     */
    public function isValidStringException(string $input): void
    {
        if (strlen($input) !== 6) {
            throw new \InvalidArgumentException;
        }
    }
}
