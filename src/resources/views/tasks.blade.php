@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    新しいタスク
                </div>

                <div class="panel-body">
                    <!-- バリデーションエラーの表示 -->
                    @include('common.errors')

                    <!-- 新タスクフォーム -->
                    <form action="{{ url('task')}}" method="POST" class="form-horizontal">
                        @csrf

                        <!-- タスク名 -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">タスク</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <!-- タスク追加ボタン -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i> タスク追加
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (count($tasks) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                現在のタスク
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <!-- テーブルヘッダ -->
                        <thead>
                            <tr>
                                <th>タスク</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <!-- テーブル本体 -->
                        <tbody class="row">
                            @foreach ($tasks as $task)
                            <tr>
                                <td class="table-text col-md-8">
                                    <dl>
                                        <dt>タスク名</dt>
                                        <dd>{{ $task->name }}</dd>
                                    </dl>
                                </td>
                                <td class="col-md-2">
                                    <!-- タスク名編集 -->
                                    <form action="{{ url('task/' . $task->id) }}" method="POST">

                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-put">
                                            <i class="fas fa-sync-alt"></i> 更新
                                        </button>
                                    </form>

                                        <script>
                                            jQuery(function($){
                                                $('dd').click(function(){
                                                    if(!$(this).hasClass('on')){
                                                        $(this).addClass('on');
                                                        var txt = $(this).text();
                                                        $(this).html('<input type="text" value="'+txt+'" />');
                                                        $('#button').on('click' , function(){

                                                            var inputVal = $(this).val();
                                                            if(inputVal===''){
                                                                inputVal = this.defaultValue;
                                                            };
                                                            $(this).parent().removeClass('on').text(inputVal);
                                                        });
                                                    };
                                                });
                                            });
                                        </script>
                                </td>
                                <!-- 削除ボタン -->

                                <td class="col-md-2">
                                    <form action="{{ url('task/' . $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        　　　　　　　　　　　　　　　　　
                                        <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i> 削除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
