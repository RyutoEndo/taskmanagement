<?php

use App\Task;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * タスクダッシュボード表示
 */
Route::get('/', function () { // URLをブラウザから持ってくる。function->ヘルパー関数<-Routeも
    $tasks = Task::orderBy('created_at', 'asc')->get(); // tasksテーブルの中から日付(created_at)の昇順(asc)でTaskモデルを持ってくる

    return view('tasks',[ // Controllerでtasksを表示
        'tasks' => $tasks // 変数tasksを定義
    ]);
});

/**
 *　新タスク追加
 */
Route::post('/task', function (Request $request) {  //サーバーにtaskと同様のURLを要求して同様の物があったら新タスクにも適用
    $validator = Validator::make($request->all(), [ // 全てに対してVaridatorを要求
        'name' => 'required|max:255', // タスク名が255文字以上かつ空じゃないか確認
    ]);

    if ($validator->fails()) { // 確認で引っかかればエラーを表示<-errors.blade.php
        return redirect('/') // 新タスクが追加されればもとのページにリダイレクトして表示
            ->withInput() // 成功した場合は特に表示なしでリダイレクト
            ->withErrors($validator); // エラーであればvalidatorの内容を表示してリダイレクト
    }

    $task = new Task();  // 新タスク
    $task->name = $request->name; // 新タスクには名前が必要
    $task->save(); // 上記の条件を満たしていればタスク保存

    return redirect('/'); // 上記の状態でリダイレクト
});

/**
 * タスク削除
 */
Route::delete('/task/{task}', function (Task $task) { // taskの中のTaskを削除
    $task->delete(); // 削除

    return redirect('/'); // 削除されたらリダイレクト
});

/**
 *  タスク名変更
 */
Route::put('/task/{task}', function ($id,Request $request) { // taskの中のTaskを更新
    $validator = Validator::make($request->all(), [ // 全てに対してVaridatorを要求
        'name' => 'required|max:255', // タスク名が255文字以上かつ空じゃないか確認
    ]);

    if ($validator->fails()) { // 確認で引っかかればエラーを表示<-errors.blade.php
        return redirect('/') // 新タスクが追加されればもとのページにリダイレクトして表示
            ->withInput() // 成功した場合は特に表示なしでリダイレクト
            ->withErrors($validator); // エラーであればvalidatorの内容を表示してリダイレクト
    }
    $task = Task::find($id);
    $task->name = $request->name;
    $task->save();

    return redirect('/'); // 更新されたらリダイレクト
});
