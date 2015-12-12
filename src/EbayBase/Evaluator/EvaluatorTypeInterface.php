<?php

namespace EbayBase\Evaluator;

interface EvaluatorTypeInterface
{
    /**
     * @return bool
     */
    public function evaluate();
}