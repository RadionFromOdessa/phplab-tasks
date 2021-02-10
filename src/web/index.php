<?php

require_once './functions.php';

$airports = require './airports.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}


// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 */


if (isset($_GET['filter_by_first_letter'])) {
    $CharsFilter = $_GET['filter_by_first_letter'];
    $chrs = "&filter_by_first_letter=$CharsFilter";
    $CharFilter = [];
    foreach ($airports as $airport) {
        if ($airport['name'][0] == $CharsFilter) {
            $CharFilter[] = $airport;
        }
    }
    $airports = $CharFilter;
}

if (isset($_GET['filter_by_first_state'])) {
    $StatesFilter = $_GET['filter_by_first_state'];
    $states = "&filter_by_first_state=$StatesFilter";
    $StateFilter = [];
    foreach ($airports as $airport) {
        if ($airport['state'] == $StatesFilter) {
            $StateFilter[] = $airport;
        }
    }
    $airports = $StateFilter;
}


// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 */
if (isset($_GET['sort'])) {
    $currentSort = [];
    $sortkey = $_GET['sort'];
    foreach ($airports as $key => $airport) {
        $currentSort[$key] = $airport[$sortkey];
    }
    array_multisort($currentSort, SORT_ASC, $airports);
}


// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 */

$numberpage = 5;
$frompage = ($page - 1) * $numberpage;
$output = array_slice($airports, $frompage, $numberpage);
$countarr = count($airports);
$pageCount = ceil($countarr / $numberpage);
$countShowPagesPag = 2;
$airports = $output;


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->
    <div class="alert alert-dark">
        Filter by first letter:

        <?php
        foreach (getUniqueFirstLetters(require './airports.php') as $letter): ?>
            <?php
            $byLetter = "&filter_by_first_letter=$letter";
            if (isset($_GET['filter_by_first_state'])) {
                $byLetter = "&filter_by_first_state=$StatesFilter&filter_by_first_letter=$letter";
            } ?>

            <a href="?page=1<?= $byLetter ?>"><?= $letter ?></a>
        <?php
        endforeach; ?>

        <a href="/" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->

    <table class="table">
        <thead>
        <tr>
            <?php
            $sortingKey = array_keys($airports[0]);
            ?>
            <?php
            foreach ($sortingKey as $sortKet): ?>
                <?php
                $sorting = "&sort=$sortKet";
                ?>
                <th scope="col"><a href="?page=<?= $page . $states . $chrs . $sorting ?>"><?= $sortKet ?></a></th>
            <?php
            endforeach; ?>

        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php
        foreach ($airports as $airport): ?>

            <?php
            $byState = "&filter_by_first_state={$airport['state']}";
            if (isset($_GET['filter_by_first_letter'])) {
                $byState = "&filter_by_first_letter=$CharsFilter&filter_by_first_state={$airport['state']}";
            }
            ?>

            <tr>
                <td><?= $airport['name'] ?></td>
                <td><?= $airport['code'] ?></td>
                <td><a href="?page=1<?= $byState ?>"><?= $airport['state'] ?></a></td>
                <td><?= $airport['city'] ?></td>
                <td><?= $airport['address'] ?></td>
                <td><?= $airport['timezone'] ?></td>
            </tr>
        <?php
        endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">

            <?php
            if ($pageCount < 10) {
                for ($i = 1; $i <= $pageCount; $i++) {
                    if ($page == $i) {
                        $class = " page-item active";
                    } else {
                        $class = " page-item";
                    } ?>
                    <li class="<?= $class ?>"><a class="page-link"
                                                 href="?page=<?= $i . $chrs . $states ?>"><?= $i ?></a></li>

                    <?php
                }
            } else { ?>

                <!-- Left side pagination 1/2/3/4/5 ... 81 -->
                <?php
                $prew = $page - 1;
                $next = $page + 1;

                if ($page < 10) {
                    for ($k = 1; $k < 8; $k++) {
                        if ($page == $k) {
                            $class = " page-item active";
                        } else {
                            $class = " page-item";
                        } ?>
                        <li class="<?= $class ?>"><a class="page-link" href="?page=<?= $k ?>"><?= $k ?></a></li>

                        <?php
                    } ?>
                    <li class="<?= $class ?>"><a class="page-link" href="?page=<?= $next ?>">>></a></li>
                    <li class="<?= $class ?>"><a class="page-link" href="?page=<?= $pageCount ?>"><?= $pageCount ?></a>
                    </li>
                    <?php
                } ?>

                <!-- Center of pagination 1... 5/6/7 ... 81 -->
                <?php
                if ($page > 6 && $page < $pageCount - 5) { ?>
                    <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
                    <li class="<?= $class ?>"><a class="page-link" href="?page=<?= $prew ?>"><<</a></li>


                    <?php
                    for ($i = ($page - $countShowPagesPag); $i <= ($page + $countShowPagesPag); $i++): ?>
                        <?php
                        if ($page == $i) {
                            $class = " page-item active";
                        } else {
                            $class = " page-item";
                        }
                        ?>
                        <li class="<?= $class ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                    endfor; ?>


                    <li class="<?= $class ?>"><a class="page-link" href="?page=<?= $next ?>">>></a></li>
                    <li class="page-item"><a class="page-link" href="?page=<?= $pageCount ?>"><?= $pageCount ?></a></li>
                    <?php
                } ?>


                <!-- Right side  pagination 1... 77/78/79/80/81 -->
                <?php
                if ($page > ($pageCount - 6)) { ?>
                    <li class="<?= $class ?>"><a class="page-link" href="?page=1">1</a></li>
                    <li class="<?= $class ?>"><a class="page-link" href="?page=<?= $prew ?>"><<</a></li>
                    <?php

                    for ($k = $pageCount; $k > ($pageCount - 7); $k--) {
                        $arr[] = $k;
                    }
                    $arr = array_reverse($arr);
                    foreach ($arr as $value) {
                        if ($page == $value) {
                            $class = " page-item active";
                        } else {
                            $class = " page-item";
                        }
                        ?>
                        <li class="<?= $class ?>"><a class="page-link" href="?page=<?= $value ?>"><?= $value ?></a></li>
                        <?php
                    }
                } ?>

                <?php
            } ?>

        </ul>
    </nav>

</main>
</html>
