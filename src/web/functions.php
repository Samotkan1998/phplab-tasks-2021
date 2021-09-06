<?php

/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array  $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports): array
{
    $uniqueFirstLetters = [];

    foreach ($airports as $airport) {
        if (!in_array(substr($airport['name'], 0, 1), $uniqueFirstLetters)) {
            array_push($uniqueFirstLetters, substr($airport['name'], 0, 1));
        }
    }

    sort($uniqueFirstLetters);

    return $uniqueFirstLetters;
}

/**
 * @param array $airports
 * @return string
 */
function filterByFirstLetter(array $airports): string
{
    return substr($airports['name'], 0, 1) === $_GET["filter_by_first_letter"];
}

/**
 * @param array $first
 * @param array $next
 * @return int
 */
function sortByCurrentOption(array $first, array $next): int
{
    return strcmp($first[$_GET["sort"]], $next[$_GET["sort"]]);
}

/**
 * @return string
 */
function buildQuery($page, $firstNameLetter, $state, $sortOption): string
{
    $array = [
        'page' => $page,
        'filter_by_first_letter' => $firstNameLetter,
        'filter_by_state' => $state,
        'sort' => $sortOption
    ];

    return http_build_query($array, '', '&');
}

/**
 * @param array $airports
 * @return bool
 */
function filterByState(array $airports): bool
{
    return $airports['state'] === $_GET["filter_by_state"];
}
