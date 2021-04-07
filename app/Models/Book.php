<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;

class Book extends Model
{
    use HasFactory;
    public function bookAuthor()   //--> funkcijos vardas bookAuthornieko nereiskia, pasirenkam i koki sugalvojam
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
        //si knyga -> pagal autoriaus id priklauso autoriui, kurio id yra toks.
    }
 
}


