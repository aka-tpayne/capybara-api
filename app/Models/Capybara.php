<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capybara extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function observations() {
        return $this->hasMany(CapybaraObservation::class);
    }
}
