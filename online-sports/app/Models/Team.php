<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Team model stores the team information
 * like name and logo and ...
 *
 */
class Team extends Model
{
    // Traits
    use HasFactory;

    /**
     * Team fields.
     *
     * @var array
     */
    protected $fillable = [

    ];
}
