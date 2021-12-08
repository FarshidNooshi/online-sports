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
        "country_id",
        "country_name",
        "league_id",
        "league_name",
        "league_season",
        "league_logo",
        "country_logo"
    ];
}
