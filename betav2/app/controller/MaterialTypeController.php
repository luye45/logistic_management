<?php
namespace app\controller;

use app\model\MaterialType;
use app\service\MaterialTypeService;

use function app\utils\objectHandler;

require_once "../model/MaterialType.php";
require_once "../service/MaterialTypeService.php";
require_once "../utils/redefine.php";

objectHandler(new MaterialTypeService(),function($materialTypeService){
    switch($_REQUEST['action']){
        case 'MaterialType:Show' : $materialTypeService->showService(new MaterialType());break;
    }
});