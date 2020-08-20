<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryShops extends Model
{
  protected $table = 'category_shop';
  public function shops()
  {
      return $this->belongsToMany(Category::class);
  }

  public function categories()
  {
      return $this->belongsToMany(Category::class);
  }


}
