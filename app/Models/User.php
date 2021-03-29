<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * get children Services
     * 
     * @return Collection
     */
    public function services() {
        return $this->hasMany(Service::class);
    }

    /**
     * Add a service.
     * 
     * @param string $name
     * @param int $price
     * @param int $category_id
     * @return Service
     */
    public function addService($name, $price, $category_id) {
        $service = new Service([
            'user_id' => $this->id,
            'name' => $name,
            'price' => $price,
            'category_id' => $category_id,
        ]);

        $service->save();
    }
}
