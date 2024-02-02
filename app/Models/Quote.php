<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    // The relation to Questionnaire model, table.
    public function questionnaires() {
        return $this->belongsToMany(Questionnaire::class, 'questionnaires_quotes', 'quote_id', 'questionnaire_id');
    }
}
