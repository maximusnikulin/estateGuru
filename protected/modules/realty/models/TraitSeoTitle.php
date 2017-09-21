<?php

/**
 * Created by PhpStorm.
 * User: maxnikulin
 * Date: 18/09/2017
 * Time: 20:59
 */
trait TraitSeoTitle
{
    public function getTitle($template = "")
    {
        $matches = [];
        preg_match_all("/\#([^\#]+)\#/", $template, $matches);
        $properties = $this->getPropertiesForSeoTemplater();
        foreach ($matches[0] as $id => $replace) {
            $propertyCode = $matches[1][$id];
            if (isset($properties[$propertyCode])) {
                $toReplace = $properties[$propertyCode];
            } else {
                $toReplace = $this->$propertyCode;
            }
            $template = str_replace($replace, $toReplace, $template);
        }
        return $template;
    }
}