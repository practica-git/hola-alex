<?php
/**
 * Created by PhpStorm.
 * User: daw
 * Date: 6/2/19
 * Time: 12:12
 */

class Response
{
    public $message;
    public $data;

    function __construct($message, $data = "")
    {
        $this->message = $message;
        $this->data = $data;
    }

    function __toString()
    {
        return json_encode($this);
    }
}