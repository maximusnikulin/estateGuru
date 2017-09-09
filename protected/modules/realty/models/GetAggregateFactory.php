<?php

/**
 * Created by PhpStorm.
 * User: maxnikulin
 * Date: 07/09/2017
 * Time: 21:10
 */
class GetAggregateFactory {
    public function getInstance($type) {
        if ($type == 'apartments' || $type == 'second') {
            return new ApartmentGetAggregate();
        } elseif ($type == 'commercial') {
            return new CommercialGetAggregate();
        } else {
            return new BuildingGetAggregate();
        }
    }

}