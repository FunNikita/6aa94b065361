<?php

require_once 'db.php';
require_once 'event.php';

// Подключение к базе данных
$db = new DB('localhost', 'username', 'password', 'database');

// Создание экземпляра класса Event
$event = new Event($db);

// Метод для добавления события
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['status'])) {
    $name = $_POST['name'];
    $status = $_POST['status'];

    $event->addEvent($name, $status);

    $response = ['success' => true];
    echo json_encode($response);
}

// Метод для получения агрегированной информации о событиях
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['aggregation'])) {
    $date = $_GET['date'];
    $name = $_GET['name'];
    $aggregation = $_GET['aggregation'];

    $result = [];

    switch ($aggregation) {
        case 'eventCount':
            $result = $event->getEventCount($date, $name);
            break;
        case 'eventCountByUser':
            $result = $event->getEventCountByUser($date, $name);
            break;
        case 'eventCountByStatus':
            $result = $event->getEventCountByStatus($date, $name);
            break;
        default:
            $result = ['error' => 'Invalid aggregation type'];
    }

    echo json_encode($result);
}
