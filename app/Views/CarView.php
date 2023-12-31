<?php

namespace Fiveteam\Views;
use Fiveteam\Components\CarListComponent;
class CarView
{
    private $carFormOptions = [
        'sale_type' => ['used', 'new'],
        'fuel' => ['Petrol', 'Diesel', 'Electric', 'Other'],
    ];
    public function renderView(string $content): void
    {
        include __DIR__ . '/../Components/header.php'; 
        $navItems = $this->navItems();
        include __DIR__ . '/../Components/navbar.php';
        echo '<div class="w-full p-5 h-[calc(100vh-81px)] scroll-smooth overflow-y-scroll">';
        echo $content;
        echo '</div>';
        include __DIR__ . '/../Components/CarFormPopUp.php';
        include __DIR__ . '/../Components/footer.php'; 
    }

    public function renderCarList(array $cars): void
    {
        ob_start();
        echo '<h1 class="uppercase text-3xl mb-8">Car List</h1>';
        echo '<div class="car-list-container flex flex-col gap-4">';
        
        // Header row
        echo '<div class="car-list-item grid grid-cols-8 font-bold uppercase mb-5 sticky top-0">';
        echo '<div>Brand</div>';
        echo '<div>Model</div>';
        echo '<div>License Plate</div>';
        echo '<div>Price</div>';
        echo '<div>Sale Type</div>';
        echo '<div>Is Reserved</div>';
        echo '<div>Fuel</div>';
        echo '<div>Actions</div>';
        echo '</div>';
        echo '<div id="carListContainer" class="car-list-container flex flex-col gap-4 ">';
        // Cars rows
        echo CarListComponent::render($cars);
    
        echo '</div>';
        echo '</div>';
        $content = ob_get_clean();
        
        self::renderView($content); 
    }
    public function renderCarAddForm(): void
    {
        ob_start();
        echo '<h1 class="uppercase text-3xl">Add Car</h1>';
        echo '<div class="car-add-form-container bg-gray-400 p-5">';
        echo '<form id="add-car-form" action="/add" method="POST">';
        echo '<div class="flex flex-col gap-3">';
        
        // Brand
        echo '<div class="flex flex-row items-center">';
        echo '<label for="brand" class="mr-2">Brand</label>';
        echo '<input type="text" name="brand" id="brand" value="" class="border rounded p-2">';
        echo '</div>';
        
        // Model
        echo '<div class="flex flex-row items-center">';
        echo '<label for="model" class="mr-2">Model</label>';
        echo '<input type="text" name="model" id="model" value="" class="border rounded p-2">';
        echo '</div>';
        
        // License Plate
        echo '<div class="flex flex-row items-center">';
        echo '<label for="license_plate" class="mr-2">License Plate</label>';
        echo '<input type="text" name="license_plate" id="license_plate" value="" class="border rounded p-2">';
        echo '</div>';
        
        // Price
        echo '<div class="flex flex-row items-center">';
        echo '<label for="price" class="mr-2">Price</label>';
        echo '<input type="text" name="price" id="price" value="" class="border rounded p-2">';
        echo '</div>';
        
        // Sale Type
        echo '<div class="flex flex-row items-center">';
        echo '<label for="sale_type" class="mr-2">Sale Type</label>';
        echo '<select name="sale_type" id="sale_type" class="border rounded p-2">';
        foreach ($this->carFormOptions['sale_type'] as $saleType) {
            echo '<option value="' . $saleType . '">' . $saleType . '</option>';
        }
        echo '</select>';
        echo '</div>';
        
        // Is Reserved
        echo '<div class="flex flex-row items-center">';
        echo '<label for="reserved" class="mr-2">Is Reserved</label>';
        echo '<input type="checkbox" name="reserved" id="reserved" value="">';
        echo '</div>';
        
        // Fuel
        echo '<div class="flex flex-row items-center">';
        echo '<label for="fuel" class="mr-2">Fuel</label>';
        echo '<select name="fuel" id="fuel" class="border rounded p-2">';
        foreach ($this->carFormOptions['fuel'] as $fuel) {
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
          
        ];
    }

}




