<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapybaraObservation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function capybara() {
        return $this->hasOne(Capybara::class);
    }
}
