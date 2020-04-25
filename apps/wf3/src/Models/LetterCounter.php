<?php


namespace App\Models;


class LetterCounter
{
    public $result;
    public function __construct($data)
    {
        $this->result = strlen($data);
    }
}