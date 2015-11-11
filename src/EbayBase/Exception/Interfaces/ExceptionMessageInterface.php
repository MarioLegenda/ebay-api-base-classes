<?php

namespace EbayBase\Exception\Interfaces;

interface ExceptionMessageInterface
{
    /**
     * @param $message
     * @return mixed
     */
    public function setExceptionMessage($message);
}