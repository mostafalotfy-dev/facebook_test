<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as AbstractPermission;
class Permission extends AbstractPermission
{
    use HasFactory;
    protected $fillable = [
        "name",
        "gaurd_name"
    ];
}
