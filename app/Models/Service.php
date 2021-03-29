<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'category_id',
    ];

    /**
     * get parent User
     * 
     * @return User
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * get parent Category.
     * 
     * @return Category
     */
    public function category() {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Uncategorized',
        ]);
    }
}
