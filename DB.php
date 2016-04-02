<?php

require_once 'config.php';

class DB
{
    private $host;
    private $db;
    private $user;
    private $password;

    public function __construct()
    {
        $this->host = HOST;
        $this->user = USER;
        $this->password = PASSWORD;
        $this->db = DB;

        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->db)
        or die('error');

        mysqli_query($this->link, "set names 'utf8'");

        $sql = 'CREATE TABLE IF NOT EXISTS `' . TABLE_NAME . '` ( 
`event_id` INT(10) NOT NULL AUTO_INCREMENT , 
`event_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`event_year` BIGINT NOT NULL , 
`event_text` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`event_img_url` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`event_video_url` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
PRIMARY KEY (`event_id`)) ENGINE = InnoDB';
        mysqli_query($this->link, $sql);


    }

    public function insert($event_name, $event_year, $event_text, $event_img_url, $event_video_url)
    {
        $sql = "INSERT INTO " . TABLE_NAME . " (`event_name`, `event_year`, `event_text`, `event_img_url`, `event_video_url`)
        VALUES ('$event_name', '$event_year', '$event_text', '$event_img_url', '$event_video_url')";
        if (mysqli_query($this->link, $sql)) {
            echo mysqli_insert_id($this->link);
        } else {
            echo 'error!';
        }
    }

    public function select()
    {
        $sql = 'SELECT * FROM ' . TABLE_NAME;
        $result = mysqli_query($this->link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            var_dump($row);
        }
    }


}