<?php


class Realty extends CApplicationComponent
{


    public function getLinkOnMe($obj)
    {
        return "<br><a href = '".$obj->getUrl()."' class = 'map__view-link'>Подробнее</a>";
    }


    public function getYandexMapJson($objects)
    {
        $arr = array_map(function($item) {
            return $item->getMapInfo();
        }, $objects);
        return json_encode($arr,JSON_NUMERIC_CHECK);
    }

    public function aggregateInstanceByType($type) {
        $factory = new GetAggregateFactory();
        $instance = $factory->getInstance($type);
        $instance->type = $type;
        return $instance;
    }

    public function getHousesForCards() {
        $criteria = new CDbCriteria();
        $criteria->compare("isPublished", 1);
        $criteria->compare('status', STATUS_HOME);
        $buildings = Building::model()->findAll($criteria);
        $any = ['id'=> '', 'label' => "Любой"];
        $result = array_map(function($item) {
            return ['id' => $item->id, 'label' => $item->adres];
        }, $buildings);
        array_unshift($result, $any);
        return $result;
    }


    public function getMinimumAvailableCost($type)
    {
        return $this->aggregateInstanceByType($type)->getMinimumAvailableCost();
    }

    public function getMaximumAvailableCost($type)
    {
        return $this->aggregateInstanceByType($type)->getMaximumAvailableCost();
    }

    public function getMinimumAvailableSize($type)
    {
        return $this->aggregateInstanceByType($type)->getMinimumAvailableSize();
    }

    public function getMaximumAvailableSize($type)
    {
        return $this->aggregateInstanceByType($type)->getMaximumAvailableSize();
    }

}