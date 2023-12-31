<?php

namespace Fiveteam\Controllers;

use Fiveteam\Models\CarModel;
use Fiveteam\Exception\CarException;
use Monolog\Logger;
use Fiveteam\Components\CarListComponent;
use Fiveteam\Util\NotificationUtil;
class CarApiController
{
    private CarModel $carModel;
    private Logger $logger;
    public function __construct()
    {
        $this->carModel = new CarModel();
        $this->logger = include __DIR__ . './../../config/monolog.php';
    }

    public function getCarById(int $carId): void
    {
        try {

            $car = $this->carModel->getCarById($carId);

            header('Content-Type: application/json');
            echo json_encode($car);
        } catch (CarException $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function getCarList(): void
    {
        try {
            $carsData = $this->carModel->getAllCars();
            $carsHtml = CarListComponent::render($carsData);
            echo json_encode(['cars' => $carsHtml]);
        } catch (CarException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    // updateCar

    public function updateCar(int $carId): void
    {
        try {
            $carData = [
                'brand' => htmlspecialchars($_POST['brand'] ?? ''),
                'model' => htmlspecialchars($_POST['model'] ?? ''),
                'license_plate' => htmlspecialchars($_POST['license_plate'] ?? ''),
                'price' => filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT),
                'sale_type' => htmlspecialchars($_POST['sale_type'] ?? ''),
                'reserved' => isset($_POST['reserved']),
                'fuel' => htmlspecialchars($_POST['fuel'] ?? ''),
            ];

            $this->carModel->updateCar($carId, $carData);
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Car updated successfully PHP', 'car' => $carData]);
        } catch (CarException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    // Post Add car request
    public function addCar(): void
    {
        try {
            $carData = [
                'brand' => htmlspecialchars($_POST['brand'] ?? ''),
                'model' => htmlspecialchars($_POST['model'] ?? ''),
                'license_plate' => htmlspecialchars($_POST['license_plate'] ?? ''),
                'price' => filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT),
                'sale_type' => htmlspecialchars($_POST['sale_type'] ?? ''),
                'reserved' => isset($_POST['reserved']),
                'fuel' => htmlspecialchars($_POST['fuel'] ?? ''),
            ];
            $this->carModel->addCar($carData);
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Car added successfully PHP', 'car' => $carData]);
        } catch (CarException $e) {

            NotificationUtil::sendError($e->getMessage());
        }
    }
    // deleteCar
    public function deleteCar(int $carId): void
    {
        try {
            $this->carModel->deleteCar($carId);

        } catch (CarException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

   

}
