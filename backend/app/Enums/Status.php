<?php

namespace App\Enums;

enum Status: string
{
    public const ADMIN = 1;
    public const MANAGER = 2;
    public const USER = 3;
}