<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');  // Tegishli ota kategoriya
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');  // Bolalar kategoriyasi
    }
}
