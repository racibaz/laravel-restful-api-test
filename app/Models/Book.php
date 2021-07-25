<?php

namespace App\Models;

use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $resource = BookResource::class;

    protected $fillable = [
        'name',
        'description',
        'ISBN',
        'status'
    ];

    /**
     * The categories that belong to the books.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
