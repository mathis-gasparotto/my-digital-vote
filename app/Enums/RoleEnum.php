<?php

namespace App\Enums;

enum RoleEnum : string {
    case Student = "student";
    case Admin = "admin";
    case Delegate = "delegate";
}
