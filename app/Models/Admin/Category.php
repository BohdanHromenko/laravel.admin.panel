<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'alias',
        'parent_id',
        'keyWords',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * For search category children in edit category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('App\Models\Admin\Category', 'parent_id');
    }
}
