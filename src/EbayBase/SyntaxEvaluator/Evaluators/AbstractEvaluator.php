<?php

namespace EbayBase\SyntaxEvaluator\Evaluators;

abstract class AbstractEvaluator
{
    protected $evaluationWord;

    /**
     * @param $evaluationWord
     */
    public function __construct($evaluationWord)
    {
        $this->evaluationWord = $evaluationWord;
    }

    /**
     * @return string $evaluationWord
     */
    public function getEvaluationWord()
    {
        return $this->evaluationWord;
    }
}