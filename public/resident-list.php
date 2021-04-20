<?php
require_once('../inc/Residents.class.php');

$resident = new Residents();

	
/*
// testing the search
$articleList = $newsArticle->getList(
    "articleID",
    "DESC",
    "articleTitle",
    "Article"
);

var_dump($articleList);die;
*/

$residentList = $resident->getList(
    (isset($_GET['firstName']) ? $_GET['firstName'] : null)
    // (isset($_GET['middleName']) ? $_GET['middleName'] : null),
    // (isset($_GET['lastName']) ? $_GET['lastName'] : null)
);

//var_dump($articleList);

require_once("../tpl/article-list.tpl.php");
?>