<?php

/**
 * Copyright (c) - 2020 by RonCoder
 */
/*
 * The post information is: book_id (int), quantity(int), user_id(int)
 */
require_once '../vendor/autoload.php';

use helpers\BookHelper;
use helpers\CommendHelper;
use models\Commend;

if (isset($_POST) && !empty($_POST)){
    $commendHelper = new CommendHelper();
    try {
        $bookHelper = new BookHelper();
        $bookHelper->getBookById($_POST['book_id']);
        $book = $bookHelper->getBook();

        $date = new DateTime('now', new DateTimeZone('Africa/Douala'));
        $quantity = $_POST['quantity'];

        $added = $commendHelper->addCommend(new Commend(0, $book, $quantity,$quantity * $book->getUnitPrise(),
            $date->format('Y-m-d H:i:s'),0,0), $_POST['user_id']);

        die(json_encode(array(
            'success' => $added,
            'value' => 'Commend creation'
        )));
    } catch (Exception $e) {
        die(json_encode(array (
            'error' => true,
            'message' => 'Error => ' . __FUNCTION__ . ' : ' . $e->getMessage()
        )));
    }
}