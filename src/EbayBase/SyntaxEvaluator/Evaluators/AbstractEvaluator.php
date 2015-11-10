<?php

namespace EbayBase\SyntaxEvaluator\Evaluators;

abstract class AbstractEvaluator
{
    protected $evaluationWord;

    /**
     * @return string $evaluationWord
     */
    public function getEvaluationWord()
    {
        return $this->evaluationWord;
    }
}