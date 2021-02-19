<?php

/**
 * Connect to DB
 */
include 'pdo_ini.php';
/**
 * functional of HomeWork DB
 */
require_once 'myfunc.php'
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
        foreach ($uniqueFirstLetters as $letter): ?>
            <?php
            $byLetter = "&first_letter=$letter";
            if (isset($_GET['first_state'])) {
                $byLetter = "&first_state=$myState&first_letter=$letter";
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

            $sortingKey = array_keys($airports[0]); ?>
            <?php
            foreach ($sortingKey as $sortKet): ?>
                <?php
                $sorting = "&sort=$sortKet"; ?>
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
            $byState = "&first_state={$airport['state']}";
            if (isset($_GET['first_letter'])) {
                $byState = "&first_letter=$myLtr&first_state={$airport['state']}";
            }
            ?>

            <tr>
                <td><?= $airport['name'] ?></td>
                <td><?= $airport['code'] ?></td>
                <td><?= $airport['address'] ?></td>
                <td><?= $airport['timezone'] ?></td>
                <td><?= $airport['city'] ?></td>
                <td><a href="?page=1<?= $byState ?>"><?= $airport['state'] ?></a></td>


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
            if ($pagecount < 10) {
                for ($i = 1; $i <= $pagecount; $i++) {
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

                if ($page < 7) {
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
                    <li class="<?= $class ?>"><a class="page-link" href="?page=<?= $pagecount ?>"><?= $pagecount ?></a>
                    </li>
                    <?php
                } ?>

                <!-- Center of pagination 1... 5/6/7 ... 81 -->
                <?php
                if ($page > 6 && $page < $pagecount - 5) { ?>
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
                    <li class="page-item"><a class="page-link" href="?page=<?= $pagecount ?>"><?= $pagecount ?></a></li>
                    <?php
                } ?>


                <!-- Right side  pagination 1... 77/78/79/80/81 -->
                <?php
                if ($page > ($pagecount - 6)) { ?>
                    <li class="<?= $class ?>"><a class="page-link" href="?page=1">1</a></li>
                    <li class="<?= $class ?>"><a class="page-link" href="?page=<?= $prew ?>"><<</a></li>
                    <?php

                    for ($k = $pagecount; $k > ($pagecount - 7); $k--) {
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
