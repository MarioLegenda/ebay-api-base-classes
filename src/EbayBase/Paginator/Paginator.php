<?php

namespace EbayBase\Paginator;

class Paginator
{
    /**
     * @var integer $entriesPerPage
     */
    private $entriesPerPage;
    /**
     * @var integer $pageNumber
     */
    private $pageNumber;

    /**
     * @param int $entriesPerPage
     * @param int $pageNumber
     */
    public function __construct($entriesPerPage = 10, $pageNumber = 1)
    {
        $this->entriesPerPage = $entriesPerPage;
        $this->pageNumber = $pageNumber;
    }
    /**
     * @param int $entriesPerPage
     * @return $this
     */
    public function setEntriesPerPage($entriesPerPage = 10)
    {
        $this->entriesPerPage = $entriesPerPage;

        return $this;
    }
    /**
     * @param $pageNumber
     * @return $this
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }
    /**
     * @return string
     */
    public function getEntriesPerPage()
    {
        return '&paginationInput.entriesPerPage='.$this->entriesPerPage;
    }
    /**
     * @return string
     */
    public function getPageNumber()
    {
        return '&paginationInput.pageNumber='.$this->pageNumber;
    }
}