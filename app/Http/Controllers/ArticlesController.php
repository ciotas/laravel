<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(15);;
        return view('articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags =Tag::lists('tagname','id');
        return view('articles.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 更新belongsTo关联的时候，可以使用associate方法，该方法会在子模型设置外键 $user->account()->associate($account);
     * 移除belongsTo关联的时候，可以使用dissociate方法, 该方法在子模型上取消外键和关联 $user->account()->dissociate();
     * 更新belongsToMany关联的时候，可以使用attach方法，该方法会在子模型设置外键 $user->roles()->attach($roleId);
     * 移除belongsToMany关联的时候，可以使用detach方法，该方法在子模型上取消外键和关联 $user->roles()->detach($roleId);
     *  Sync 附加多对多关系,参数为对象，而不是ID
     */
    public function store(Request $request)
    {
        $article = Article::create($request->all());
        $article->tags()->attach($request->tag_list);
        return redirect()->action('ArticlesController@show',[$article->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * first 方法是取得结果集数组中第一列数据，如果结果集为空则返回 null 。
     * pluck 方法是取得结果集第一列特定字段，它返回是字符串
     * lists 方法是按照 key=>value 对的方式返回数组；它的参数最多两个，第一个参数作为键值（value），第二个参数作为键名（key）。
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $tags = Tag::lists('tagname','id');
        return view('articles.edit',compact('article','tags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->body = $request->body;

        $article->tags()->sync($request->get('tag_list'));
        return redirect()->action('ArticlesController@show',[$article->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
