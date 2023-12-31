<?php

namespace Fiveteam\Controllers;

use Fiveteam\Models\CarModel;
use Fiveteam\Views\CarView;
use Fiveteam\Exception\CarException;
use Fiveteam\Exception\CarNotFoundException;
use Fiveteam\Util\NotificationUtil;

class CarController
{
    private CarModel $carModel;
    private CarView $carView;

    public function __construct()
    {
        $this->carModel = new CarModel();
        $this->carView = new CarView();
    }


    public function showCarList(): void
    {
        try {
            $cars = $this->carModel->getAllCars();
            $this->carView->renderCarList($cars);
       
        } catch (CarException $e) {
         
            NotificationUtil::sendError($e->getMessage());
        }
    }

    public function showCarAddForm(): void
    {
        try {
           
            $this->carView->renderCarAddForm();
        } catch (CarException $e) {
         
            NotificationUtil::sendError($e->getMessage());
        }
    }
    // Post request
    public function addCar(): void
    {
        try {
            $carData = [
                'brand' => $_POST['brand'] ?? '',
                'model' => $_POST['model'] ?? '',
                'license_plate' => $_POST['license_plate'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'sale_type' => $_POST['sale_type'] ?? '',
                'reserved' => isset($_POST['reserved']),
                'fuel' => $_POST['fuel'] ?? '',
            ];
            $this->carModel->addCar($carData);
          
        } catch (CarException $e) {
    
            NotificationUtil::sendError($e->getMessage());
        }
    }
 
}
