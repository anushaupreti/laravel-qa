<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Parsedown;

class Question extends Model
{
    protected $fillable = ['title','body'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function setTitleAttributes($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str::slug($value);
    }

    public function getUrlAttribute()
    {
        return route("questions.show", $this->slug);
    }

     public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
     public function getStatusAttribute()
     {
         if($this->answers > 0){
             if ($this->best_answer_id){
                 return "answer-accepted";
             }
             return "answered";
         }
         return "unanswered";
     }

     public function getBodyHtmlAttribute()
     {
       // return \Parsedown::instance()->text($this->body);
     }
}

