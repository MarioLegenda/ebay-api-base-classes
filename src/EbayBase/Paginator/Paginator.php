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
     * @return string
     */
    public function getEntriesPerPage()
    {
        return 'paginationInput.entriesPerPage='.$this->entriesPerPage;
    }
    /**
     * @return string
     */
    public function getPageNumber()
    {
        return 'paginationInput.pageNumber='.$this->pageNumber;
    }
}