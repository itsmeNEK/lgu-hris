<?php

namespace App\Models\hr;

use App\Models\SurveyFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surveyAnswerDetails extends Model
{
    use HasFactory;

    public function surveyAnswer(){
        return $this->belongsTo(surveyAnswer::class,'answer_id');
    }
    public function surveyFiles(){
        return $this->hasOne(SurveyFiles::class,'answer_details_id');
    }

    public function surveyQuestion(){
        return $this->belongsTo(surveyQuestion::class,'question_id');
    }

    public function surveyFormDetails(){
        return $this->belongsTo(surveyFormDetails::class,'formDetails_id');
    }
}
