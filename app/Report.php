<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'report_text',
        'del_flg',
    ];

    // リレーション: ReportモデルはUserと関連付けられる
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // リレーション: ReportモデルはPostと関連付けられる
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getCountByUser()
    {
        return DB::table('reports')
            ->selectRaw('user_id, COUNT(*) as count_user')
            ->groupBy('user_id')
            ->get();
    }
}
