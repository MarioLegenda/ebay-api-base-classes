<?php

namespace EbayBase\Exception;

class AbstractException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}