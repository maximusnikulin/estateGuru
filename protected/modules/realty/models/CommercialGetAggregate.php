<?php

/**
 * Created by PhpStorm.
 * User: maxnikulin
 * Date: 07/09/2017
 * Time: 21:07
 */
class CommercialGetAggregate extends BuildingGetAggregate {

    public function getMinimumAvailableSize()
    {
        return $this->getAggregateValue("usefulSquare", "usefulSquare ASC");
    }

    public function getMaximumAvailableSize()
    {
        return $this->getAggregateValue("usefulSquare", "usefulSquare DESC");
    }
}