<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

class DB
{
    private $host;
    private $db;
    private $user;
    private $password;
    public $link;

    public function __construct()
    {
        $this->host = HOST;
        $this->user = USER;
        $this->password = PASSWORD;
        $this->db = DB;

        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->db)
        or die('error');

        mysqli_query($this->link, "set names 'utf8'");

    }

    public function insert($event_name, $event_year, $event_text, $event_text_short, $event_img_url, $event_video_url)
    {
        $sql = "INSERT INTO " . TABLE_NAME . " (`event_name`, `event_year`, `event_text`, `$event_text_short`, `event_img_url`, `event_video_url`)
        VALUES ('$event_name', '$event_year', '$event_text', '$event_text_short', '$event_img_url', '$event_video_url')";
        if (mysqli_query($this->link, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function select($id)
    {
        $sql = 'SELECT * FROM ' . TABLE_NAME . 'WHERE `id` = ' . $id;
        $result = mysqli_query($this->link, $sql);
        $array = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($array, $row);
        }
        return $array;
    }


}