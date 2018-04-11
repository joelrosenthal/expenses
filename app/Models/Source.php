<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Source
 *
 * @property string $name        Name of the category
 * @property Carbon $deleted_at  When the record was deleted
 * @property Carbon $created_at  When the record was created
 * @property Carbon $updated_at  When the record was updated
 */
class Source extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];
}
