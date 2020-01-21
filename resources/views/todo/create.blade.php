@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo作成</h2>
{{-- Formファサードでフォームタグを生成 --}}
{{-- routeでNameがtodo.storeのstoreメソッドを使うことを宣言 --}}
{{-- ここでエスケープしてしまうと＜＞を変換してしまうので機能しなくなってしまう --}}
{{-- バックエンドエンジニアがフロントのコードを書くことがないようにFormファサードを使用してこのような書き方をしている --}}
{!! Form::open(['route' => 'todo.store']) !!} <!-- 変更 -->
{{-- Form::openでhtml文を返している --}}
{{-- Laravel collectiveを使うことで --}}
  <div class="form-group">
     {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!}
	{{-- textがtype属性,titleがname属性、nullがvalue でフィールドの初期値を表す
	第四引数(オプション)：idやclassを指定するときに利用する。オプションは[ ]の中にカンマ区切りで記載する--}}
      <!-- 変更 -->
  </div>
  {{-- 属性を追加する場合は、第二引数に配列を利用しなければなりません
	{{Form::submit('Save', ['class' => 'btn'])}}
	属性classが追加されます
	<input class="btn" type="submit" value="Save"> --}}
  {!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!} <!-- 変更 -->
{!! Form::close() !!} <!-- 変更 -->

@endsection