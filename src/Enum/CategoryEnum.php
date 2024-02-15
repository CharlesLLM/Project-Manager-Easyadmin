<?php

namespace App\Enum;

enum CategoryEnum: string
{
    case CATEGORY_PERSONAL_PROJECT = 'Projet personnel';
    case CATEGORY_ECOMMERCE = 'E-Commerce';
    case CATEGORY_MOBILE_APP = 'Application mobile';
    case CATEGORY_TECHNICAL_PROGRESS = 'Veille technologique';
}
