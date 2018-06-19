<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'content', 'data', 'user_id'];

    protected $dates = ['deleted_at'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public static function listaArtigos($paginate)
    {
    	// $artigos = Artigo::select('id', 'title', 'description', 'user_id', 'data')->paginate($paginate);

     	//    foreach ($artigos as $key => $value) {
     	//        $value->user_id = User::find($value->user_id)->name;
     	//    }

    	//usando o query builder
        $artigos = DB::table('artigos')
                            ->join('users', 'users.id', '=', 'artigos.user_id')
                            ->select('artigos.id', 'artigos.title', 'artigos.description',       'users.name', 'artigos.data')
                            ->whereNull('deleted_at')
                            ->paginate($paginate);

        return $artigos;
    }

    public static function artigos($paginate)
    {
        $artigos = DB::table('artigos')
                            ->join('users', 'users.id', '=', 'artigos.user_id')
                            ->select('artigos.id', 'artigos.title', 'artigos.description',       'users.name as autor', 'artigos.data')
                            ->whereNull('deleted_at')
                            ->whereDate('data', '<=', date('Y-m-d'))
                            ->orderBy('data', 'DESC')
                            ->paginate($paginate);

        return $artigos;
    }

    public static function busca($paginate, $busca = null)
    {
        if($busca){
            $artigos = DB::table('artigos')
                            ->join('users', 'users.id', '=', 'artigos.user_id')
                            ->select('artigos.id', 'artigos.title', 'artigos.description',       'users.name as autor', 'artigos.data')
                            ->whereNull('deleted_at')
                            ->whereDate('data', '<=', date('Y-m-d'))
                            ->where(function ($query) use($busca) {
                                $query->orWhere('title', 'like', '%'.$busca.'%')->paginate(6);
                            })
                            ->orderBy('data', 'DESC')
                            ->paginate($paginate);
        }else{
            $artigos = DB::table('artigos')
                            ->join('users', 'users.id', '=', 'artigos.user_id')
                            ->select('artigos.id', 'artigos.title', 'artigos.description',       'users.name as autor', 'artigos.data')
                            ->whereNull('deleted_at')
                            ->whereDate('data', '<=', date('Y-m-d'))
                            ->orderBy('data', 'DESC')
                            ->paginate($paginate);
        }
        
        return $artigos;
    }
}
