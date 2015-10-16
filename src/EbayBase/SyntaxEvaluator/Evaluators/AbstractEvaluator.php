<?php

namespace EbayBase\SyntaxEvaluator\Evaluators;

abstract class AbstractEvaluator
{
    protected $searchWord;

    /**
     * @return mixed
     */
    public function getEvaluationWord()
    {
        return $this->searchWord;
    }

    /**
     * @param $searchWork
     * @param array $searchWordClosures
     */
    protected function extract($word, array $searchWordClosures)
    {
        if (is_array($word)) {
            $searchWord = '';

            foreach ($word as $w) {
                $searchWord .= $w.',';
            }

            foreach ($searchWordClosures as $closure) {
                $searchWord = $closure($searchWord);
            }

            $this->searchWord = $searchWord;

            return true;
        }

        if (is_string($word)) {
            $this->searchWord = $word;

            return true;
        }

        return false;
    }
}