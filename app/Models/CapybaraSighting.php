<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapybaraSighting extends Model
{
    use HasFactory;

    public function capybara() {
        return $this->hasOne(Capybara::class);
    }
}
