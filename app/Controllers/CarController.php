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

    public function initiateCarsDatabase(): void
    {
        try {
            $fakeCars = $this->generateCars();
         
            foreach ($fakeCars as $fakeCar) {
                $this->carModel->addCar($fakeCar);
          
                
            }
   
             NotificationUtil::sendSuccess('Cars generated successfully');
            header('Location: /');
        } catch (CarException $e) {
            NotificationUtil::sendError($e->getMessage());
        }
    }
    public function generateCars(): array {
        return $fakeCars = [
            [
                'brand' => 'Toyota',
                'model' => 'Camry',
                'license_plate' => 'AB123CD',
                'price' => 20000.0,
                'sale_type' => 'used',
                'reserved' => false,
                'fuel' => 'Petrol',
            ],
            [
                'brand' => 'Honda',
                'model' => 'Accord',
                'license_plate' => 'XY456ZF',
                'price' => 22000.0,
                'sale_type' => 'new',
                'reserved' => true,
                'fuel' => 'Diesel',
            ],
            [
                'brand' => 'Ford',
                'model' => 'Fusion',
                'license_plate' => 'GH789IJ',
                'price' => 18000.0,
                'sale_type' => 'used',
                'reserved' => false,
                'fuel' => 'Electric',
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Malibu',
                'license_plate' => 'KL012MN',
                'price' => 25000.0,
                'sale_type' => 'new',
                'reserved' => true,
                'fuel' => 'Petrol',
            ],
            [
                'brand' => 'Nissan',
                'model' => 'Altima',
                'license_plate' => 'OP345QR',
                'price' => 23000.0,
                'sale_type' => 'used',
                'reserved' => false,
                'fuel' => 'Electric',
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'Sonata',
                'license_plate' => 'ST678UV',
                'price' => 21000.0,
                'sale_type' => 'new',
                'reserved' => true,
                'fuel' => 'Petrol',
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Passat',
                'license_plate' => 'WX901YZ',
                'price' => 19000.0,
                'sale_type' => 'used',
                'reserved' => false,
                'fuel' => 'Diesel',
            ],
            [
                'brand' => 'Subaru',
                'model' => 'Legacy',
                'license_plate' => 'CD234EF',
                'price' => 24000.0,
                'sale_type' => 'new',
                'reserved' => true,
                'fuel' => 'Electric',
            ],
            [
                'brand' => 'Kia',
                'model' => 'Optima',
                'license_plate' => 'GH567IJ',
                'price' => 20000.0,
                'sale_type' => 'used',
                'reserved' => false,
                'fuel' => 'Petrol',
            ],
            [
                'brand' => 'Mazda',
                'model' => 'Mazda6',
                'license_plate' => 'KL890MN',
                'price' => 22000.0,
                'sale_type' => 'new',
                'reserved' => true,
                'fuel' => 'Diesel',
            ],
            [
                'brand' => 'Audi',
                'model' => 'A4',
                'license_plate' => 'OP123QR',
                'price' => 18000.0,
                'sale_type' => 'used',
                'reserved' => false,
                'fuel' => 'Petrol',
            ],
            [
                'brand' => 'Mercedes-Benz',
                'model' => 'C-Class',
                'license_plate' => 'ST456UV',
                'price' => 25000.0,
                'sale_type' => 'new',
                'reserved' => true,
                'fuel' => 'Electric',
            ],
            [
                'brand' => 'BMW',
                'model' => '3 Series',
                'license_plate' => 'WX789YZ',
                'price' => 23000.0,
                'sale_type' => 'used',
                'reserved' => false,
                'fuel' => 'Diesel',
            ],
            [
                'brand' => 'Tesla',
                'model' => 'Model 3',
                'license_plate' => 'CD012EF',
                'price' => 21000.0,
                'sale_type' => 'new',
                'reserved' => true,
                'fuel' => 'Electric',
            ],
            [
                'brand' => 'Ford',
                'model' => 'Mustang',
                'license_plate' => 'GH345IJ',
                'price' => 19000.0,
                'sale_type' => 'used',
                'reserved' => false,
                'fuel' => 'Petrol',
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Camaro',
                'license_plate' => 'KL678MN',
                'price' => 22000.0,
                'sale_type' => 'new',
                'reserved' => true,
                'fuel' => 'Diesel',
            ],
            [
                'brand' => 'Nissan',
                'model' => '370Z',
                'license_plate' => 'OP901QR',
                'price' => 20000.0,
                'sale_type' => 'used',
                'reserved' => false,
                'fuel' => 'Electric',
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Corolla',
                'license_plate' => 'ST234UV',
                'price' => 24000.0,
                'sale_type' => 'new',
                'reserved' => true,
                'fuel' => 'Petrol',
            ],
            [
                'brand' => 'Honda',
                'model' => 'Civic',
                'license_plate' => 'WX567YZ',
                'price' => 18000.0,
                'sale_type' => 'used',
                'reserved' => false,
                'fuel' => 'Diesel',
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'Elantra',
                'license_plate' => 'CD890EF',
                'price' => 25000.0,
                'sale_type' => 'new',
                'reserved' => true,
                'fuel' => 'Electric',
            ],
        ];
        
        
    }
}
