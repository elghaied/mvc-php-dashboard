<?php

namespace Fiveteam\Views;

class CarView
{
    public function renderView(string $content): void
    {
        include __DIR__ . '/../Components/header.php'; 
        $navItems = $this->navItems();
        include __DIR__ . '/../Components/navbar.php';
        echo '<div class="w-full p-5">';
        echo $content;
        echo '</div>';
        include __DIR__ . '/../Components/footer.php'; 
    }

    public function renderCarList(array $cars): void
    {
        ob_start();
        echo '<h1 class="uppercase text-3xl">Car List</h1>';
        echo '<div class="car-list-container">';
        
        // Header row
        echo '<div class="car-list-item grid grid-cols-8 font-bold uppercase mb-5">';
        echo '<div>Brand</div>';
        echo '<div>Model</div>';
        echo '<div>License Plate</div>';
        echo '<div>Price</div>';
        echo '<div>Sale Type</div>';
        echo '<div>Is Reserved</div>';
        echo '<div>Fuel</div>';
        echo '<div>Actions</div>';
        echo '</div>';
        
        // Data rows
        foreach ($cars as $car) {
            echo '<div class="car-list-item grid grid-cols-8">';
            echo '<div>'.  $car->getBrand() . '</div>';
            echo '<div>'.  $car->getModel() . '</div>';
            echo '<div>'.  $car->getLicensePlate() . '</div>';
            echo '<div>'.  $car->getPrice() . '</div>';
            echo '<div>'.  $car->getSaleType() . '</div>';
            echo '<div>'.  $car->getIsReserved() . '</div>';
            echo '<div>'.  $car->getFuel() . '</div>';
            
            echo '<div class="">' .
                '<a href="/update?id=' . $car->getId() . '" class="bg-blue-700 text-white font-bold py-2 px-4 rounded-[5px]">Update</a>' .
                '<a href="/delete?id=' . $car->getId() . '" class="bg-red-700 text-white font-bold py-2 px-4 rounded-[5px] ml-2">Delete</a>' .
                '</div>';
        
            echo '</div>';
        }
        
        echo '</div>';
        $content = ob_get_clean();
        
        self::renderView($content); 
    }
    public function renderCarAddForm(array $car): void
    {
        ob_start();
        echo '<h1 class="uppercase text-3xl">Add Car</h1>';
        echo '<div class="car-add-form-container bg-gray-400 p-5">';
        echo '<form action="/add" method="POST">';
        echo '<div class="flex flex-col gap-3">';
        
        // Brand
        echo '<div class="flex flex-row items-center">';
        echo '<label for="brand" class="mr-2">Brand</label>';
        echo '<input type="text" name="brand" id="brand" value="' . $car['brand'] . '" class="border rounded p-2">';
        echo '</div>';
        
        // Model
        echo '<div class="flex flex-row items-center">';
        echo '<label for="model" class="mr-2">Model</label>';
        echo '<input type="text" name="model" id="model" value="' . $car['model'] . '" class="border rounded p-2">';
        echo '</div>';
        
        // License Plate
        echo '<div class="flex flex-row items-center">';
        echo '<label for="licensePlate" class="mr-2">License Plate</label>';
        echo '<input type="text" name="licensePlate" id="licensePlate" value="' . $car['licensePlate'] . '" class="border rounded p-2">';
        echo '</div>';
        
        // Price
        echo '<div class="flex flex-row items-center">';
        echo '<label for="price" class="mr-2">Price</label>';
        echo '<input type="number" name="price" id="price" value="' . $car['price'] . '" class="border rounded p-2">';
        echo '</div>';
        
        // Sale Type
        echo '<div class="flex flex-row items-center">';
        echo '<label for="saleType" class="mr-2">Sale Type</label>';
        echo '<select name="saleType" id="saleType" class="border rounded p-2">';
        foreach ($car['saleType'] as $saleType) {
            echo '<option value="' . $saleType . '">' . $saleType . '</option>';
        }
        echo '</select>';
        echo '</div>';
        
        // Is Reserved
        echo '<div class="flex flex-row items-center">';
        echo '<label for="isReserved" class="mr-2">Is Reserved</label>';
        echo '<input type="checkbox" name="isReserved" id="isReserved" value="' . $car['isReserved'] . '">';
        echo '</div>';
        
        // Fuel
        echo '<div class="flex flex-row items-center">';
        echo '<label for="fuel" class="mr-2">Fuel</label>';
        echo '<select name="fuel" id="fuel" class="border rounded p-2">';
        foreach ($car['fuel'] as $fuel) {
            echo '<option value="' . $fuel . '">' . $fuel . '</option>';
        }
        echo '</select>';
        echo '</div>';
        
        echo '<button type="submit" class=" bg-red-700 text-white font-bold py-2 px-4 rounded-[5px]">Add Car</button>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        
        
        $content = ob_get_clean(); 
        self::renderView($content); 
    }

    private function navItems(): array
    {
        return [
            ['url' => '/', 'label' => 'Car List'],
            ['url' => '/add', 'label' => 'Add Car'],
            ['url' => '/update', 'label' => 'Update Car'],
        ];
    }
}
