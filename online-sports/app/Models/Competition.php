<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Competition is our football leagues.
 * For separating teams of the countries into
 * parts.
 *
 */
class Competition extends Model
{
    // Traits
    use HasFactory;

    /**
     * Competition fields.
     *
     * @var array
     */
    protected $fillable = [
        "league_id",
        "league_name",
    ];
}
