<?php

namespace App\Http\Controllers;
// クラスの衝突が起こらないようにnamespace（名前空間を指定）
// どのクラス名のことを指しているのかを把握

use Illuminate\Http\Request;
use App\Todo;  // 追記
// ほかファイル内にあるクラスのメソッドや変数を使用したい場合はuse（エイリアスを作成）を使用する
use Auth; //追記

class TodoController extends Controller
{
    private $todo;

    // コンストラクタはインスタンス化した瞬間に実行されるのでTodoを使っている
    // コンストラクタに書いたクラスのインスタンスを自動で作ってくれる、おかげで$instanceClassを使うことができる
    // 下記の通りに描けば自動的にインスタンス化されてコンストラクタが実行される？
    // Todoクラスの色々な機能をここで注入しているのか？

    // コントローラーをインスタンス化した時、Actionが実行された時に実行されるのがコンストラクトメソッド
    public function __construct(Todo $instanceClass)
    //$instanceclass = Todo(代入＋インスタンスかしているのが左のやつ)
    // ここでTodoクラスをインスタンス化したものがないと、代入する箱がないから
    {
        $this->middleware('auth');//第２段階の記述
        // dd($this->middleware('auth'));
        $this->todo = $instanceClass;
        // dd($this->todo);
        // dd($instanceClass);
        // Todoクラスのインスタンス化したもの
        //this=TodoController
        //todo=$todo;
        //$todo=$instanceClass＝インスタンスTodo（$instanceClass）
        //アロー演算子の左辺は絶対インスタンス化されているもの
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "Hello world!!";
        // 入力した情報が全て連想配列(id,title,created_at,updated_at)で入っている
        // $todos = $this->todo->all();
        // dd($todos = $this->todo);
        $todos = $this->todo->getByUserId(Auth::id());  // 追記
         // Collectionインスタンスが代入される！その中のattributeプロパティの連想配列が代入される
        // dd($this->todo->all());
        // return view('layouts.app');
        // compactメソッド使って$todos変数作ってindexページでforeachで表示させる
        // キーに引数に渡した文字列Collectionインスタンス
        return view('todo.index', compact('todos'));//編集
        // compactメソッドで引数名と同じ変数の配列が作られる
        // ['todos' => $todos]
        // viewの第二引数は配列だけしか渡せない
        // compact() — 変数名とその値から配列を作成する
        // $a = 'ssss';
        // dd(compact('a'));
        // dd(compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');  // 追記

        // viewインスタンスを返している
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // コンストラクタに書いたクラスのインスタンスを自動で作ってくれる
    {
        // 入力内容が連想配列で入っている
        $input = $request->all();
        $input['user_id'] = Auth::id();  // 追記//第二段階の記述
        // dd($input);
        // こっちは配列
        // TodoControllerインスタンスが$todoに付与されて、fillメソッドを使って$inputで得た入力情報を反映させてfillableの配列にあるものかどうかジャッジする、saveメソッドで保存する
        // 左辺から右辺内容を取り出す
        // 左辺はインスタンス、右辺はそのインスタンスの中の変数または関数
        $this->todo->fill($input)->save();
        // dd($this->todo->fill($input));
        // returnで返してtodo画面にリダイレクト遷移して処理を終了させる
        // ルートリストからindexメソッド使って作成した全ての情報を取得して表示する
        return redirect()->to('todo');
        // redirectorインスタンスを返している
        // dd(redirect()->to('todo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // DBよりURIパラメータと同じIDを持つtodoの情報,オブジェクトを取得
        $todo = $this->todo->find($id);  // 追記
        // dd($todo);
        return view('todo.edit', compact('todo'));  // 追記
        // viewの第一引数の記述によってURLを返す
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 連想配列が入っているメソッド、トークン、中身
        $input = $request->all();
        // dd($input);
        // $a = $this->todo->find($id)->fill($input);
        // dd($a);
        $this->todo->find($id)->fill($input)->save();
        // dd($this->todo->find($id)->fill($input));
        return redirect()->to('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todo->find($id)->delete();
        return redirect()->to('todo');
    }
}