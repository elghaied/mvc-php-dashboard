<?php

namespace Fiveteam\Util;

class NotificationUtil
{
    public static function sendError(string $message = 'An unexpected error occurred. Please try again later.'): void
    {
        $response = [
            'error' => true,
            'message' => $message,
        ];

        // header('Content-Type: application/json');
        // echo json_encode($response);
        exit;
    }

    public static function sendSuccess(string $message = 'Operation completed successfully.'): void
    {
        $response = [
            'error' => false,
            'message' => $message,
        ];
    
        // header('Content-Type: application/json');
        // echo json_encode($response);
        exit;
    }
    
}
