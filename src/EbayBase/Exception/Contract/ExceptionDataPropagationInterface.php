<?php

namespace EbayBase\Exception\Contract;

interface ExceptionDataPropagationInterface
{
    public function propagateExceptionData(array $data);
}