<?php

namespace arrays;

class Arrays implements ArraysInterface
{
    /**
     * Repites digits by its value
     *
     * @param array $input
     * @return array
     */
    public function repeatArrayValues(array $input): array
    {
        $resultArray = [];

        for ($i = 0; $i < count($input); $i++) {
            for ($j = 0; $j < $input[$i]; $j++) {
                array_push($resultArray, $input[$i]);
            }
        }

        return $resultArray;
    }

    /**
     * Gets the lowest unique value
     *
     * @param array $input
     * @return integer
     */
    public function getUniqueValue(array $input): int
    {
        $uniqueValues = [];

        foreach (array_count_values($input) as $key => $value) {
            if ($value === 1) {
                array_push($uniqueValues, $key);
            }
        }

        return $uniqueValues ? min($uniqueValues) : 0;
    }

    /**
     * Groups names by tags
     *
     * @param array $input
     * @return array
     */
    public function groupByTag(array $input): array
    {
        array_multisort($input);

        foreach ($input as $innerArrays) {
            foreach ($innerArrays['tags'] as $tags) {
                $newArray[$tags][] = $innerArrays['name'];
            }
        }

        return $newArray;
    }
}
