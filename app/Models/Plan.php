<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Plan extends Model
{
    use HasFactory;
    use Sortable;


    protected $fillable = [
        'name',
        'url',
        'price',
        'description'
    ];

    public $sortable = [
        'name',
        'price',
    ];

    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->sortable()
            ->paginate();

        return $results;
    }
}
