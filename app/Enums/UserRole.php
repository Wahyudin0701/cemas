<?php

namespace App\Enums;

enum UserRole: string 
{
    case Pembeli = 'pembeli';
    case Penjual = 'penjual';
    case Admin = 'admin';
}
