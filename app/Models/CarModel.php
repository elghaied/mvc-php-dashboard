<?php

namespace Fiveteam\Models;

use Monolog\Logger;
use Fiveteam\Exception\CarException;
use Fiveteam\Exception\CarNotFoundException;

class CarModel
{
    private Dbcon $db;
    private Logger $logger;

    public function __construct()
    {
        $this->db = new Dbcon();
        $this->logger =  include __DIR__.'./../../config/monolog.php';

    }


    public function getAllCars(): array
    {
        try {
            $query = "SELECT * FROM cars";
            $statement = $this->db->getConnection()->prepare($query);
            $statement->execute();

            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $cars = [];

            foreach ($result as $data) {
                $cars[] = $this->createCarFromData($data);
            }

            return $cars;
        } catch (\PDOException $e) {
            $this->logger->error('Database error: ' . $e->getMessage());
            throw new CarException('An error occurred while fetching cars', 500, $e);
        }
    }




    public function getCarById(int $carId): ?Car
    {
        try {
            $query = "SELECT * FROM cars WHERE id = :id";
            $statement = $this->db->getConnection()->prepare($query);
            $statement->bindParam(':id', $carId, \PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                throw new CarNotFoundException('Car not found', 404);
            }

            return $this->createCarFromData($data);
        } catch (\PDOException $e) {

            $this->logger->error('Database error: ' . $e->getMessage());

            throw new CarException('An error occurred while fetching the car by ID', 500, $e);
        }
    }
    // Methods for CRUD operations
    public function addCar(array $carData): void
    {
        try {
            $this->validateCarData($carData);

            $query = "INSERT INTO cars (brand, model, license_plate, price, sale_type, reserved, fuel)
                      VALUES (:brand, :model, :licensePlate, :price, :saleType, :isReserved, :fuel)";

            $statement = $this->db->getConnection()->prepare($query);

            $statement->bindParam(':brand', $carData['brand']);
            $statement->bindParam(':model', $carData['model']);
            $statement->bindParam(':licensePlate', $carData['licensePlate']);
            $statement->bindParam(':price', $carData['price']);
            $statement->bindParam(':saleType', $carData['saleType']);
            $statement->bindParam(':isReserved', $carData['isReserved'], \PDO::PARAM_BOOL);
            $statement->bindParam(':fuel', $carData['fuel']);
            $statement->execute();
        } catch (\InvalidArgumentException $e) {
            $this->logger->error('Validation error: ' . $e->getMessage());
            throw new CarException('Invalid car data', 400, $e);

        } catch (\PDOException $e) {
            $this->logger->error('Database error: ' . $e->getMessage());
            throw new CarException('An error occurred while adding a car', 500, $e);
        }
    }

    public function updateCar(int $carId, array $carData): void
    {
        try {

            $selectedCar = $this->getCarById($carId);

            if (!$selectedCar) {
                throw new CarException("Car with ID $carId not found");
            }


            $updatedCarData = array_merge((array) $selectedCar, $carData);

            $this->validateCarData($updatedCarData);

            $query = "UPDATE cars SET brand = :brand, model = :model, license_plate = :licensePlate, 
                      price = :price, sale_type = :saleType, reserved = :isReserved, fuel = :fuel
                      WHERE id = :carId";

            $statement = $this->db->getConnection()->prepare($query);

            $statement->bindParam(':brand', $updatedCarData['brand']);
            $statement->bindParam(':model', $updatedCarData['model']);
            $statement->bindParam(':licensePlate', $updatedCarData['licensePlate']);
            $statement->bindParam(':price', $updatedCarData['price']);
            $statement->bindParam(':saleType', $updatedCarData['saleType']);
            $statement->bindParam(':isReserved', $updatedCarData['isReserved'], \PDO::PARAM_BOOL);
            $statement->bindParam(':fuel', $updatedCarData['fuel']);
            $statement->bindParam(':carId', $carId, \PDO::PARAM_INT);

            $statement->execute();


        } catch (\InvalidArgumentException $e) {
            $this->logger->error('Validation error: ' . $e->getMessage());
        } catch (CarNotFoundException $e) {
            $this->logger->error('Car not found: ' . $e->getMessage());
            throw $e;
        } catch (\PDOException $e) {
            $this->logger->error('Database error: ' . $e->getMessage());
            throw new CarException('An error occurred while updating a car', 500, $e);
        }
    }


    public function deleteCar(int $carId): void
    {
        try {

            $selectedCar = $this->getCarById($carId);
            $query = "DELETE FROM cars WHERE id = :carId";
            $statement = $this->db->getConnection()->prepare($query);
            $statement->bindParam(':carId', $carId, \PDO::PARAM_INT);
            $statement->execute();


        } catch (CarNotFoundException $e) {
            $this->logger->warning('Car not found: ' . $e->getMessage());
        } catch (\PDOException $e) {
            $this->logger->error('Database error: ' . $e->getMessage());
            throw new CarException('An error occurred while deleting the car', 500, $e);
        }
    }

    // Private methods
    private function createCarFromData(array $data): Car
    {
        $car = new Car();
        $car->setId($data['id']);
        $car->setBrand($data['brand']);
        $car->setModel($data['model']);
        $car->setLicensePlate($data['license_plate']);
        $car->setPrice($data['price']);
        $car->setSaleType($data['sale_type']);
        $car->setIsReserved((bool) $data['reserved']);
        $car->setFuel($data['fuel']);

        return $car;
    }
    private function validateCarData(array $carData): void
    {
        if (empty($carData['brand']) || !is_string($carData['brand'])) {
            throw new \InvalidArgumentException('Invalid or missing brand');
        }

        if (empty($carData['model']) || !is_string($carData['model'])) {
            throw new \InvalidArgumentException('Invalid or missing model');
        }

        if (empty($carData['licensePlate']) || !is_string($carData['licensePlate'])) {
            throw new \InvalidArgumentException('Invalid or missing license plate');
        }

        if (!is_numeric($carData['price']) || $carData['price'] < 0) {
            throw new \InvalidArgumentException('Invalid price');
        }

        if (!in_array($carData['saleType'], ['used', 'new'])) {
            throw new \InvalidArgumentException('Invalid sale type');
        }

        if (!is_bool($carData['isReserved'])) {
            throw new \InvalidArgumentException('Invalid isReserved');
        }

        if (!in_array($carData['fuel'], ['Petrol', 'Diesel', 'Electric', 'Other'])) {
            throw new \InvalidArgumentException('Invalid fuel type');
        }


    }
    public function getCarFormData(): array
    {
        return [
            'brand' => '',
            'model' => '',
            'licensePlate' => '',
            'price' => '',
            'saleType' => Car::getAllowedSaleTypes(),
            'isReserved' => false,
            'fuel' => Car::getAllowedFuelTypes(),
        ];
    }
}