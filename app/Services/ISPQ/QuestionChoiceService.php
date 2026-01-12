<?php

namespace App\Services\ISPQ;

use App\Models\ISPQ\ISPQuestion;

class QuestionChoiceService
{
    public function get()
    {
        return ISPQuestion::with('choices')->get();
    }
}
