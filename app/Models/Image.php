<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * This defines a polymorphic relationship, allowing the model to belong to multiple imageable entities.
     * For example, an image can be associated with different models like events, locations.
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
