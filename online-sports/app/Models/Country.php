<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Country model for storing the countries
 * information.
 *
 */
class Country extends Model
{
    // Traits
    use HasFactory;

    /**
     * Model fields.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'country_name'
    ];
}
