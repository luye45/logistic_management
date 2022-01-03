<?php
namespace app\controller;

use app\model\Material;
use app\service\MaterialService;

use function app\utils\objectHandler;

require_once "../model/Material.php";
require_once "../service/MaterialService.php";
require_once "../utils/redefine.php";

objectHandler(new MaterialService(),function($materialService){
    switch($_REQUEST['action']){
        case 'Material:Show' : $materialService->showService(new Material());break;
        case 'Material:Store': $materialService->storeService(new Material());break;
        case 'Material:Update': $materialService->updateService(new Material());break;
        case 'Material:Destroy': $materialService->destroyService(new Material());break;
        case 'Material:Search' : $materialService->searchService(new Material());break;
        case 'Material:Tree': $materialService->treeService(new Material());break;
    }
});