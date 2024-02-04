<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    
    public const MODE_BINARY = 'binary';
    public const MODE_BINARY_OPTIONS = ['0', '1',];
    public const MODE_MULTIPLE_CHOICE = 'multiple_choice';
    public const MODE_MULTIPLE_CHOICE_OPTIONS = ['A', 'B', 'C',];

    // The relation to Questionnaire model, table.
    public function questionnaires() {
        return $this->belongsToMany(Questionnaire::class, 'questionnaires_quotes', 'quote_id', 'questionnaire_id');
    }
}
