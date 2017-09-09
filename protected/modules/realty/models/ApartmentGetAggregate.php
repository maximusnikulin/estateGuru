<?php

/**
 * Created by PhpStorm.
 * User: maxnikulin
 * Date: 07/09/2017
 * Time: 21:07
 */
class ApartmentGetAggregate extends AbstractGetAggregate {

    public function getModel()
    {
        return Apartment::model();
    }

    public function getMinimumAvailableCost()
    {
        return $this->getAggregateValue("cost", "cost ASC");
    }

    public function getMaximumAvailableCost()
    {
        return $this->getAggregateValue("cost", "cost DESC");
    }

    public function getMinimumAvailableSize()
    {
        return $this->getAggregateValue("size", "size ASC");
    }

    public function getMaximumAvailableSize()
    {
        return $this->getAggregateValue("size", "size DESC");
    }

    public function getCriteria()
    {
        $criteria = new CDbCriteria();
        $criteria->with = [
            "building" => [
                "condition" => "isPublished = 1" . ((!empty($this->type)) ? " AND status=".$this->getIdType() : ""),
            ]
        ];

        return $criteria;
    }
}