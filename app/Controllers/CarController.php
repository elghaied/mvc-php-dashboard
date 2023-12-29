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
            // echo json_encode(['cars' => $cars]);
        } catch (CarException $e) {
         
            NotificationUtil::sendError($e->getMessage());
        }
    }

    public function showCarAddForm(): void
    {
        try {
            $car = $this->carModel->getCarFormData();
            $this->carView->renderCarAddForm($car);
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
                'licensePlate' => $_POST['licensePlate'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'saleType' => $_POST['saleType'] ?? '',
                'isReserved' => isset($_POST['isReserved']),
                'fuel' => $_POST['fuel'] ?? '',
            ];
            $this->carModel->addCar($carData);
            NotificationUtil::sendSuccess('Car added successfully');
            header('Location: /');
            exit();
          
        } catch (CarException $e) {
    
            NotificationUtil::sendError($e->getMessage());
        }
    }

    public function updateCar(int $carId, array $carData): void
    {
        try {
            $this->carModel->updateCar($carId, $carData);
     
            NotificationUtil::sendSuccess('Car updated successfully');
        } catch (CarNotFoundException $e) {
          
            NotificationUtil::sendError('Car not found');
        } catch (CarException $e) {
         
            NotificationUtil::sendError($e->getMessage());
        }
    }

    public function deleteCar(int $carId): void
    {
        try {
            $this->carModel->deleteCar($carId);
         
            NotificationUtil::sendSuccess('Car deleted successfully');
        } catch (CarNotFoundException $e) {
           
            NotificationUtil::sendError('Car not found');
        } catch (CarException $e) {
      
            NotificationUtil::sendError($e->getMessage());
        }
    }
  
}
