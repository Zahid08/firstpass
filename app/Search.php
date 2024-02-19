<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'search';

    protected $fillable = [

            'ip' ,'use_credit','redirect_track','region_id', 't_type', 'step_2', 'step_3','step_4','step_5', 'learner_id','final_booking','final_selected_hour','final_selected_test','start_package','start_lesson',

        ];
}
