<?php

include "database.php";

class dateFormat extends database {
    public $date;

    public function __construct($date)
    {   
        $this->date = $date;
    }

    public function getDate() {
        echo $this->date;
    }

    public function setFile($file) {
        echo $file;
    }
}