<?php

namespace EbayBase\Exception\Contract;

interface ExceptionDataPropagationInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function propagateExceptionData(array $data);
}