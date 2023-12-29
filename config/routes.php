<?php

return [
    ['GET', '/', 'Fiveteam\Controllers\CarController@showCarList'],
    ['GET', '/add', 'Fiveteam\Controllers\CarController@showCarAddForm'],
    ['GET', '/update', 'Fiveteam\Controllers\CarController@updateCar'],
    ['POST', '/add', 'Fiveteam\Controllers\CarController@addCar'],

];