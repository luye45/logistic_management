<?php
namespace app\service;

//require_once "../model/material.php";
require_once "../utils/redefine.php";

class MaterialService{
    function showService($material){
        $material->showAllMaterialInfo();
    }
    function storeService($material){
        $material->setStoreMaterialInfo($_REQUEST);
        $material->storeMaterial($material->isExist());
    }
    function updateService($material){
        $material->setUpdateMaterialInfo($_REQUEST);
        $material->updateMaterial();
    }
    function destroyService($material){
        $material->setDestroyMaterialInfo($_REQUEST);
        $material->destroyMaterial();
    }
    function searchService($material){
        $material->searchMaterial($_REQUEST);
    }
    function treeService($material){
        $material->showTree();
    }
}