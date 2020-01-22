{{-- extendsでlayouts.appの中身を継承 --}}
@extends ('layouts.app') <!-- 追記 -->
{{-- ＠以下で継承方法を指定、sectionは継承可能、変数やデフォルト値は引き継げない --}}
@section ('content') <!-- 追記 引数名であっていれば、その中身を継承することができる-->

<h1 class="page-header">ToDo一覧</h1>
<p class="text-right">
  {{-- ルート指定内容を確認すると、web.phpからTodocontrollerのcreateメソッドを使用していることがわかる --}}
  {{-- 下記はURI名を参照して描く方法 --}}
  <a class="btn btn-success" href="/todo/create">ToDoを追加</a>
</p>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>ID</th>
      <th>タスク</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($todos as $todo)
    <tr>
      {{-- Todocontrlooer内のindexメソッドを取得し、$todo変数を参照している --}}
      {{-- エスケープ処理が必要なため、{{}}カッコを使用している --}}
      {{-- ここでエスケープ処理しないと＜や＞や””などが特別な意味を持つ文字列と認識されてしまうから --}}
      {{-- エスケープ処理とは＝HTML上で特殊文字を表示するための処理 --}}
      <td class="align-middle">{{ $todo->id }}</td>
      <td class="align-middle">{{ $todo->title }}</td>
      <td class="align-middle">{{ $todo->created_at }}</td>
      <td class="align-middle">{{ $todo->updated_at }}</td>
      {{-- ルートの流れを指定、ターミナルのrouteリスト参照 --}}
      {{-- 第二引数でid情報を渡している --}}
      {{-- 下記はName名を参照して描く方法 --}}
      <td><a class="btn btn-primary" href="{{ route('todo.edit', $todo->id) }}">編集</a></td>
      <td>{!! Form::open(['route' => ['todo.destroy', $todo->id], 'method' => 'DELETE']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}</td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection <!-- 追記 -->
