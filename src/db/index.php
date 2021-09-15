<?php

require_once './functions.php';

$page = 1;
$firstNameLetter = null;
$state = null;
$sortOption = null;
$airports = [];

$letters = getUniqueFirstLetters($pdo);

if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

if (isset($_GET["filter_by_first_letter"])) {
    $firstNameLetter = $_GET["filter_by_first_letter"];
}

if (isset($_GET["filter_by_state"])) {
    $state = $_GET["filter_by_state"];
}

if (isset($_GET["sort"])) {
    $sortOption = $_GET["sort"];
}

$airports = filterAirportsByParams($pdo, $firstNameLetter, $state, $sortOption, $page);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <main role="main" class="container">

        <h1 class="mt-5">US Airports</h1>
        <div class="alert alert-dark">
            Filter by first letter:

            <?php foreach ($letters as $letter) : ?>
                <a href="?<?= buildQuery(1, $letter['uniqueLetters'], $state, null) ?>"><?= $letter['uniqueLetters'] ?></a>
            <?php endforeach; ?>

            <a href="./" class="float-right">Reset all filters</a>
        </div>

        <?php if ($airports) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><a href="?<?= buildQuery($page, $firstNameLetter, $state, 'name') ?>">Name</a></th>
                        <th scope="col"><a href="?<?= buildQuery($page, $firstNameLetter, $state, 'code') ?>">Code</a></th>
                        <th scope="col"><a href="?<?= buildQuery($page, $firstNameLetter, $state, 'state_name') ?>">State</a></th>
                        <th scope="col"><a href="?<?= buildQuery($page, $firstNameLetter, $state, 'city_name') ?>">City</a></th>
                        <th scope="col">Address</th>
                        <th scope="col">Timezone</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($airports as $airport) : ?>
                        <tr>
                            <td><?= $airport['name'] ?></td>
                            <td><?= $airport['code'] ?></td>
                            <td>
                                <a href="?<?= buildQuery(1, $firstNameLetter, $airport['state_name'], null) ?>">
                                    <?= $airport['state_name'] ?>
                                </a>
                            </td>
                            <td><?= $airport['city_name'] ?></td>
                            <td><?= $airport['address'] ?></td>
                            <td><?= $airport['timezone'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <h3><?= 'No airports found' ?></h3>
        <?php } ?>

        <nav aria-label="Navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= ceil(countAirports($pdo, $firstNameLetter, $state) / 20); $i++) : ?>
                    <li class="page-item active">
                        <a class="page-link" href="?<?= buildQuery($i, $firstNameLetter, $state, $sortOption) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </main>

</html>