<?php

namespace Saphir\Multi\Models;

use Illuminate\Database\Eloquent\Model;

class Saphircrud extends Model
{

    protected $fillable = [
        'panel',
        'model',
        'label',
        'route',
        'icon',
        'active',
    ];
    
}