<?php

namespace Fiveteam\Models;

class Car
{
    private ?int $id = null;
    private string $brand;
    private string $model;
    private string $licensePlate;
    private float $price;
    private string $saleType;
    private bool $isReserved;
    private string $fuel;
    private const ALLOWED_FUEL_TYPES = ['Petrol', 'Diesel', 'Electric', 'Other'];
    private const ALLOWED_SALE_TYPES = ['used', 'new'];

    //  Getters
    public function getId(): ?int
    {
        return $this->id;
    }


    public function getBrand(): string
    {
        return $this->brand;
    }



    public function getModel(): string
    {
        return $this->model;
    }



    public function getLicensePlate(): string
    {
        return $this->licensePlate;
    }



    public function getPrice(): float
    {
        return $this->price;
    }



    public function getSaleType(): string
    {
        return $this->saleType;
    }


    public function getIsReserved(): bool
    {
        return $this->isReserved;
    }



    public function getFuel(): string
    {
        return $this->fuel;
    }

    public static function getAllowedSaleTypes(): array
    {
    return self::ALLOWED_SALE_TYPES;
    }
    public static function getAllowedFuelTypes(): array
    {
    return self::ALLOWED_FUEL_TYPES;
    }


    //  Setters

    public function setId (int $id) : void {
        $this->id = $id;
    }
    public function setModel(string $model): void
    {
        if (!is_string($model)) {
            throw new \InvalidArgumentException('Expected string for model');
        }

        $this->model = $model;
    }
    public function setLicensePlate(string $licensePlate): void
    {
       if (!is_string($licensePlate)) {
            throw new \InvalidArgumentException('Expected string for license plate');
        }
        $licensePlate = strtoupper(str_replace('-', '', $licensePlate));

       
        //  The format allows two letters, followed by three digits, and ending with two letters.
        if (!preg_match('/^[A-Z]{2}\d{3}[A-Z]{2}$|^[A-Z]{2}-\d{3}-[A-Z]{2}$/', $licensePlate)) {
            throw new \InvalidArgumentException('Invalid license plate format');
        }
        $licensePlate = substr($licensePlate, 0, 2) . '-' . substr($licensePlate, 2, 3) . '-' . substr($licensePlate, 5);
        $this->licensePlate = $licensePlate;
    }
    public function setPrice(float $price): void
    {
        if (!is_float($price) || $price < 0) {
            throw new \InvalidArgumentException('Invalid price format');
        }
        $this->price = $price;
    }
    public function setSaleType(string $saleType): void
    {
        if (!in_array($saleType, self::ALLOWED_SALE_TYPES)) {
            throw new \InvalidArgumentException('Invalid sale type');
        }

        $this->saleType = $saleType;
    }

    public function setIsReserved(bool $isReserved): void
    {
        if (!is_bool($isReserved)) {
            throw new \InvalidArgumentException('Invalid Is Reserved format');
        }
        $this->isReserved = $isReserved;
    }
    public function setBrand(string $brand): void
    {
        if (!is_string($brand)) {
            throw new \InvalidArgumentException('Expected string for brand');
        }

        $this->brand = $brand;
    }
    public function setFuel(string $fuel): void
    {
        if (!in_array($fuel, self::ALLOWED_FUEL_TYPES)) {
            throw new \InvalidArgumentException('Invalid fuel type');
        }

        $this->fuel = $fuel;
    }
}
