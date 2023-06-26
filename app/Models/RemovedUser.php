<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemovedUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'removed_users';

    protected $fillable = [
        'competition_id',
        'user_id',
        'is_removed',
    ];

}
