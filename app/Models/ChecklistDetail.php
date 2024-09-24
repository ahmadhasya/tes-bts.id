<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, "checklistId", "id");
    }
}
