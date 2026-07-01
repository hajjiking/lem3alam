<?php

namespace App\Helpers;

class UrgencyHelper
{
    public static function getUrgencyColor($urgency)
    {
        switch ($urgency) {
            case 'urgent':
                return 'danger';
            case 'high':
                return 'warning';
            case 'medium':
                return 'info';
            case 'low':
                return 'light';
            default:
                return 'secondary';
        }
    }
}
