<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @property string  $name               Name of the category
 * @property Carbon  $datetime           Datetime of the transaction
 * @property string  $location           Location where money is spent
 * @property float   $amount             Amount of money spent
 * @property integer $subcategory_id     id of subcategory
 * @property integer $source_id          id of source
 * @property string  $comments           Additional information about the transaction
 * @property Carbon  $deleted_at         When the record was deleted
 * @property Carbon  $created_at         When the record was created
 * @property Carbon  $updated_at         When the record was updated
 */
class Expenditure extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'datetime',
        'location',
        'amount',
        'subcategory_id',
        'source_id',
        'comments',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'float',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'datetime',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
