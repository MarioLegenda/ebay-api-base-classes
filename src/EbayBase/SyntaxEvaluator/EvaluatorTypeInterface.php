<?php

namespace EbayBase\SyntaxEvaluator;

interface EvaluatorTypeInterface
{
    /**
     * @return bool
     */
    public function evaluate();
}