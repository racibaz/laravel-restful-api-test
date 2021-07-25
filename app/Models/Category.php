<?php

namespace App\Models;

use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $resource = CategoryResource::class;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    /**
     * The books that belong to the categories.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
