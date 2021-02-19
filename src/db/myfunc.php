<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
/**
 * SELECT the list of unique first letters using https://www.w3resource.com/mysql/string-functions/mysql-left-function.php
 * and https://www.w3resource.com/sql/select-statement/queries-with-distinct.php
 * and set the result to $uniqueFirstLetters variable
 */
$ltrs = $pdo->query("SELECT DISTINCT LEFT (`name`,1) FROM states")->fetchAll(PDO::FETCH_ASSOC);

foreach ($ltrs as $ltr) {
    $row[] = $ltr["LEFT (`name`,1)"];
}
$uniqueFirstLetters = $row;
asort($uniqueFirstLetters);
// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 *
 * For filtering by first_letter use LIKE 'A%' in WHERE statement
 * For filtering by state you will need to JOIN states table and check if states.name = A
 * where A - requested filter value
 */
// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 *
 * For sorting use ORDER BY A
 * where A - requested filter value
 */


// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 *
 * For pagination use LIMIT
 * To get the number of all airports matched by filter use COUNT(*) in the SELECT statement with all filters applied
 */

/**
 * Build a SELECT query to DB with all filters / sorting / pagination
 * and set the result to $airports variable
 *
 * For city_name and state_name fields you can use alias https://www.mysqltutorial.org/mysql-alias/
 */
$numberpage = 5;
$frompage = ($page - 1) * $numberpage;
$countShowPagesPag = 2;

if ($page) {
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        $sortParam = "ORDER BY $sort";
    }
    if (isset($_GET['first_letter']) && !isset($_GET['first_state'])) {
        $param = ["{$_GET['first_letter']}%"];
        $myLtr = $_GET['first_letter'];
        $chrs = "&first_letter=$myLtr";
        $myQuery = "AND `airports`.name LIKE ? ";
    }
    if (isset($_GET['first_state']) && !isset($_GET['first_letter'])) {
        $param = [$_GET['first_state']];
        $myState = $_GET['first_state'];
        $states = "&first_state=$myState";
        $myQuery = "AND `states`.name=?";
    }
    if (isset($_GET['first_letter']) && isset($_GET['first_state'])) {
        $param = ["{$_GET['first_letter']}%", $_GET['first_state']];
        $coupleGet = "&first_letter={$_GET['first_letter']}&first_state={$_GET['first_state']}";
        $myQuery = "AND `airports`.name LIKE ? AND `states`.name=? ";
    }

    $ltrs = $pdo->prepare(
        "SELECT `airports`.name,`airports`.code,`airports`.address,`airports`.timezone,`cities`.name as city,`states`.name as state
                FROM `airports`,`cities`,`states`
                WHERE (`airports`.city_id=`cities`.id AND `airports`.state_id=`states`.id  $myQuery ) $sortParam
                "
    );
    $ltrs->execute($param);
    $resLetter = $ltrs->fetchAll(PDO::FETCH_ASSOC);
    $airports = $resLetter;
}
$output = array_slice($airports, $frompage, $numberpage);
$countarr = count($airports);
$pagecount = ceil($countarr / $numberpage);
$airports = $output;