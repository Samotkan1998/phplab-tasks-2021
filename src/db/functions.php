<?php

/** @var PDO $pdo */
require_once './pdo_ini.php';

function getUniqueFirstLetters(PDO $pdo): array
{
    $data = $pdo->prepare('SELECT DISTINCT(LEFT(`name`, 1)) AS uniqueLetters FROM airports ORDER BY uniqueLetters ASC');
    $data->execute();
    $uniqueFirstLetters = $data->fetchAll(PDO::FETCH_ASSOC);

    return $uniqueFirstLetters;
}

function filterAirportsByParams(PDO $pdo, $firstNameLetter, $state, $sortOption, $page): array
{
    $sql = "SELECT airports.name, code, cities.name AS 'city_name', states.name AS 'state_name', address, timezone
    FROM airports
    INNER JOIN cities ON airports.city_id=cities.id
    INNER JOIN states ON airports.state_id=states.id
    WHERE airports.name LIKE '$firstNameLetter%' 
    AND states.name = COALESCE(:state, states.name)";

    $offset = 20 * ($page - 1);

    if ($sortOption) {
        $sql .= " ORDER BY $sortOption ASC";
    }

    $sql .= " LIMIT $offset, 20";

    $data = $pdo->prepare($sql);
    $data->bindParam(':state', $state);
    $data->execute();
    $filteredArray = $data->fetchAll(PDO::FETCH_ASSOC);

    return $filteredArray;
}

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

function countAirports(PDO $pdo, $firstNameLetter, $state): int
{
    $sql = "SELECT COUNT(*) as 'number_of_airports', airports.name, code, cities.name AS 'city_name', states.name AS 'state_name', address, timezone
    FROM airports
    INNER JOIN states ON airports.state_id=states.id
    INNER JOIN cities ON airports.city_id=cities.id
    WHERE airports.name LIKE '$firstNameLetter%' 
    AND states.name = COALESCE(:state, states.name)";

    $data = $pdo->prepare($sql);
    $data->bindParam(":state", $state);
    $data->execute();
    $number = $data->fetchColumn();

    return intval($number);
}
