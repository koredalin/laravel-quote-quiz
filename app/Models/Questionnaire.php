<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    // The relation to Quote model, table.
    public function quotes() {
        return $this->belongsToMany(Quote::class, 'questionnaires_quotes', 'questionnaire_id', 'quote_id');
    }
}
