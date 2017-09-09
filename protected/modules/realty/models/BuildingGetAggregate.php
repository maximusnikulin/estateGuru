<?php

/**
 * Created by PhpStorm.
 * User: maxnikulin
 * Date: 07/09/2017
 * Time: 21:07
 */
class BuildingGetAggregate extends AbstractGetAggregate {

    public function getModel()
    {
        return Building::model();
    }

    public function getMinimumAvailableCost()
    {
        return $this->getAggregateValue("price", "price ASC");
    }

    public function getMaximumAvailableCost()
    {
        return $this->getAggregateValue("price", "price DESC");
    }

    public function getMinimumAvailableSize()
    {
        return $this->getAggregateValue("square", "square ASC");
    }

    public function getMaximumAvailableSize()
    {
        return $this->getAggregateValue("square", "square DESC");
    }

    public function getCriteria()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('isPublished', 1);
        if (!empty($this->type)) {
            $criteria->compare('status', $this->getIdType());
        }
        return $criteria;
    }
}