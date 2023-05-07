<?php

class Event
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Метод добавляет событие в базу данных
     * @param string $name Название события
     * @param string $status Статус пользователя
     * @return bool Успешность добавления события
     */
    public function addEvent($name, $status)
    {
        $name = $this->db->escapeString($name);
        $status = $this->db->escapeString($status);

        $query = "INSERT INTO events (name, status) VALUES ('$name', '$status')";
        $this->db->executeQuery($query);

        return true;
    }

    /**
     * Метод возвращает количество событий с заданным названием и датой
     * @param string $date Дата
     * @param string $name Название события
     * @return array Ассоциативный массив с количеством событий
     */
    public function getEventCount($date, $name)
    {
        $date = $this->db->escapeString($date);
        $name = $this->db->escapeString($name);

        $query = "SELECT COUNT(*) AS count FROM events WHERE DATE(created_at) = '$date' AND name = '$name'";
        $result = $this->db->executeQuery($query);
        $row = $result->fetch_assoc();
        $count = $row['count'];

        return ['count' => $count];
    }

    /**
     * Метод возвращает количество событий с заданным названием и статусом по пользователям
     * @param string $date Дата
     * @param string $name Название события
     * @return array Ассоциативный массив с количеством событий по статусу
     */
    public function getEventCountByUser($date, $name)
    {
        $date = $this->db->escapeString($date);
        $name = $this->db->escapeString($name);

        $query = "SELECT status, COUNT(*) AS count FROM events WHERE DATE(created_at) = '$date' AND name = '$name' GROUP BY status";
        $result = $this->db->executeQuery($query);
        $counts = [];

        while ($row = $result->fetch_assoc()) {
            $status = $row['status'];
            $count = $row['count'];
            $counts[$status] = $count;
        }

        return $counts;
    }

    /**
     * Метод возвращает количество событий с заданным названием и статусом по статусу пользователя
     * @param string $date Дата
     * @param string $name Название события
     * @return array Ассоциативный массив с количеством событий по статусу пользователя
     */
    public function getEventCountByStatus($date, $name)
    {
        $date = $this->db->escapeString($date);
        $name = $this->db->escapeString($name);

        $query = "SELECT status, COUNT(*) AS count FROM events WHERE DATE(created_at) = '$date' AND name = '$name' GROUP BY status";
        $result = $this->db->executeQuery($query);
        $counts = [];

        while ($row = $result->fetch_assoc()) {
            $status = $row['status'];
            $count = $row['count'];
            $counts[$status] = $count;
        }

        return $counts;
    }
}
