<?php
namespace app\service;

//require_once "../model/material.php";
require_once "../utils/redefine.php";

class MaterialTypeService{
    function showService($materialType){
        $materialType->showAllTypeName();
    }
}