<?php

return [
    ['GET', '/', 'Fiveteam\Controllers\CarController@showCarList'],
    ['GET', '/add', 'Fiveteam\Controllers\CarController@showCarAddForm'],
 

    ['POST', '/api/add', 'Fiveteam\Controllers\CarApiController@addCar'],

    ['GET', '/api/car/{carId:\d+}', 'Fiveteam\Controllers\CarApiController@getCarById'],
    ['GET', '/api/getCarList', 'Fiveteam\Controllers\CarApiController@getCarList'],
    ['GET', '/api/deleteCar/{carId:\d+}', 'Fiveteam\Controllers\CarApiController@deleteCar'],
    ['POST', '/api/updateCar/{carId:\d+}', 'Fiveteam\Controllers\CarApiController@updateCar'],

];