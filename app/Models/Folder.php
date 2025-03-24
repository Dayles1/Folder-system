<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable=[
        'name',
        'icon',
        'parent_id',
    ];
    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');  // Tegishli ota kategoriya
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');  // Bolalar kategoriyasi
    }
}
