<?php

namespace App\Helpers;

class TaskStatusHelper
{
    public static function getStatusColor($status)
    {
        switch ($status) {
            case 'open':
                return 'success';
            case 'in_progress':
                return 'warning';
            case 'completed':
                return 'primary';
            case 'cancelled':
                return 'secondary';
            default:
                return 'light';
        }
    }
}
