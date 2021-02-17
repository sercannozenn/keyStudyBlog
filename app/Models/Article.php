<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Whtht\PerfectlyCache\Traits\PerfectlyCachable;

class Article extends Model
{
    use HasFactory;

    use PerfectlyCachable;

    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $appends = ['next', 'previous', 'single_calculate'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function next()
    {
        return Article::where('id', '>', $this->id)->Published()->orderBy('id', 'ASC')->first();
    }

    public function previous()
    {
        return Article::where('id', '<', $this->id)->Published()->orderBy('id', 'DESC')->first();
    }

    public function getSingleCalculateAttribute()
    {
        $countData = $this->ratings()->count();
        $percent = round($countData * 30 / 100);
        $percent30Data = $this->ratings()->limit($percent)->orderBy('id', 'DESC')->select('rate')->get()->sum('rate') * 2;
        $percent70Data = $this->ratings()->limit($countData - $percent)->skip($percent)->orderBy('id', 'DESC')->select('rate')->get()->sum('rate');
        $countData += $percent;

        $total = $percent70Data + $percent30Data;
        return $total == 0 ? 0 : round($total / $countData, 1);
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\ArticleRating', 'article_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function scopeStatusActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopePublished($query)
    {
        return $query->where('publish_date', '<', now());
    }

    // Moderatör ve Writer kendi makalelerini siler
    // Admin Tümünü Silebilir.
    public function scopeUserArticles($query)
    {
        $role = Auth::user()->roles[0]->name;
        if ($role == 'Moderator' || $role == 'Writer')
        {
            return $query->where('user_id', Auth::id());
        }
    }
}
