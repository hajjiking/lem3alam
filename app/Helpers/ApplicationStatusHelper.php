<?php

namespace App\Helpers;

class ApplicationStatusHelper
{
    public static function getStatusColor($status)
    {
        switch ($status) {
            case 'accepted':
                return 'success';
            case 'rejected':
                return 'danger';
            case 'pending':
                return 'warning';
            default:
                return 'secondary';
        }
    }
}
