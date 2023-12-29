<?php 

namespace Fiveteam\Exception;

class CarNotFoundException extends \Exception
{
    public function __construct(string $message = 'Car not found', int $code = 404, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}