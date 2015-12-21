<?php

namespace EbayBase\Paginator;

class Sorter
{
    const BEST_MATCH = 'BestMatch';
    const BIT_COUNT_FEWEST = 'BidCountFewest';
    const BIT_COUNT_MOST = 'BidCountMost';
    const COUNTRY_ASCENDING = 'CountryAscending';
    const COUNTRY_DESCENDING = 'CountryDescending';
    const CURRENT_PRICE_HIGHEST = 'CurrentPriceHighest';
    const DISTANCE_NEAREST = 'DistanceNearest';
    const END_TIME_SOONEST = 'EndTimeSoonest';
    const PRICE_PLUS_SHIPPING_HIGHEST = 'PricePlusShippingHighest';
    const PRICE_PLUS_SHIPPING_LOWEST = 'PricePlusShippingLowest';
    const START_TIME_NEWEST = 'StartTimeNewest';

    private $sort;

    /**
     * @param string $sort
     */
    public function __construct($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @param string $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return mixed
     */
    public function getSorted()
    {
        return '&sortOrder='.$this->sort;
    }
}