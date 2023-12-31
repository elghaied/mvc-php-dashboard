<?php

namespace Fiveteam\Components;

class CarListComponent
{
    public static function render(array $cars): string
    {
        $html = '';

        foreach ($cars as $car) {
            $html .= '<div class="car-list-item grid grid-cols-8 odd:bg-white even:bg-slate-50 h-14 items-center justify-center">';
            $html .= '<div>' . $car->getBrand() . '</div>';
            $html .= '<div>' . $car->getModel() . '</div>';
            $html .= '<div>' . $car->getLicensePlate() . '</div>';
            $html .= '<div>' . $car->getPrice() . '€ </div>';
            $html .= '<div>' . $car->getSaleType() . '</div>';
            $html .= '<div>' . ($car->getIsReserved() ? 'Reserved' : 'Available') . '</div>';
            $html .= '<div>' . $car->getFuel() . '</div>';
            
            $html .= '<div class="">' .
                '<span data-carid="'.$car->getId()  .'"  class="bg-blue-700 text-white font-bold py-2 cursor-pointer px-4 rounded-[5px] update-car-button">Update</span>' .
                '<span data-carid="' . $car->getId() . '" class="bg-red-700 text-white font-bold py-2 cursor-pointer px-4 rounded-[5px] ml-2 delete-car-button">Delete</span>' .
                '</div>';
        
            $html .= '</div>';
        }

        return $html;

    }
}