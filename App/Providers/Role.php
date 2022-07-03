<?php

namespace App\Providers;

enum Role: int
{
    case BANNED = 0;
    case USER = 1;
    case EDITOR = 2;
    case SUPPORT = 3;
    case MODERATOR = 4;
    case ADMIN = 5;
}