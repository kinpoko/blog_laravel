<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Article extends Model
{

    protected $primaryKey = 'article_id';
    protected $fillable = ['category_id', 'post_date', 'title', 'body'];

    use SoftDeletes;

    protected $dates = ['post_date', 'created_at', 'updated_at', 'deleted_at'];

    public function getPostDateTextAttribute()
    {
        return $this->post_date->format('Y/m/d');
    }

    public function setPostDateAttribute($value)
    {
        $post_date = new Carbon($value);
        $this->attributes['post_date'] = $post_date->format('Y-m-d');
    }

    /*記事リストを取得する */
    public function getArticleList(int $num_per_page = 10, array $condition = [])
    {
        $category_id = Arr::get($condition, 'category_id');
        $year  = Arr::get($condition, 'year');
        $month = Arr::get($condition, 'month');
        $query = $this->with('category')->orderBy('article_id', 'desc');

        if ($category_id) {
            $query->where('category_id', $category_id);
        }
        if ($year) {
            if ($month) {
                $start_date = Carbon::createFromDate($year, $month, 1);
                $end_date   = Carbon::createFromDate($year, $month, 1)->addMonth();
            } else {
                $start_date = Carbon::createFromDate($year, 1, 1);
                $end_date   = Carbon::createFromDate($year, 1, 1)->addYear();
            }
            $query->where('post_date', '>=', $start_date->format('Y-m-d'))
                ->where('post_date', '<',  $end_date->format('Y-m-d'));
        }


        return $query->paginate($num_per_page);
    }

    /*月別アーカイブの対象月のリストを取得 */
    public function getMonthList()
    {
        $month_list = $this->selectRaw('substring(post_date, 1, 7) AS year_and_month')
            ->groupBy('year_and_month')
            ->orderBy('year_and_month', 'desc')
            ->get();

        foreach ($month_list as $value) {
            list($year, $month) = explode('-', $value->year_and_month);
            $value->year  = $year;
            $value->month = (int)$month;
            $value->year_month = sprintf("%04d年%02d月", $year, $month);
        }
        return $month_list;
    }

    /*最新の記事を5件取得する*/
    public function getRecentArticleList()
    {
        $recent_list = $this->orderBy('article_id', 'desc')->take(5)->get();
        return $recent_list;
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'category_id', 'category_id');
    }
}
