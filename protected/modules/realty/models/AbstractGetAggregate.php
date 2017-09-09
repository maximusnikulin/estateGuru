<?php

/**
 * Created by PhpStorm.
 * User: maxnikulin
 * Date: 07/09/2017
 * Time: 21:05
 */

abstract class AbstractGetAggregate {
    public $type = null;
    protected function getIdType() {
        if ($this->type == 'earth') {
            return STATUS_EARTH;
        }
        if ($this->type == 'second') {
            return STATUS_SECOND;
        }
        if ($this->type == 'commercial') {
            return STATUS_COMMERCIAL;
        }
        if ($this->type == 'apartments') {
            return STATUS_HOME;
        }
        if ($this->type == 'cottage') {
            return STATUS_COTTAGE;
        }
    }

    public function getAggregateValue($field, $sort) {
        $criteria = $this->getCriteria();

        $criteria->select = $field;
        $criteria->order = $sort;
        $criteria->limit = 1;

        $modelInstance = $this->getModel()->find($criteria);
        return intval($modelInstance->$field);
    }

    abstract public function getCriteria();

    abstract public function getModel();

    abstract public function getMinimumAvailableCost();

    abstract public function getMaximumAvailableCost();

    abstract public function getMinimumAvailableSize();

    abstract public function getMaximumAvailableSize();

}