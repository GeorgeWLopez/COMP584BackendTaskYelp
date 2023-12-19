<?php
use App\Models\Task;
use App\Models\Audio;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/task', function(Request $request) {
    $task = Task::create([
        'name' => $request->input('name'),
        'display_order' => Task::count() + 1, 
    ]);

    if ($request->has('comment')) {
        Comment::create([
            'task_id' => $task->id,
            'comment_body' => $request->input('comment'),
        ]);
    }

    return response()->json(['task' => $task, 'message' => 'Task and comment created successfully']);
});



Route::get('/task', function(Request $request){
    return Task::all();


});
// In routes/api.php

Route::post('/task/update-order', function(Request $request) {
    foreach ($request->tasks as $task) {
        $taskModel = Task::find($task['id']);
        if ($taskModel) {
            $taskModel->display_order = $task['display_order'];
            $taskModel->save();
        }
    }

    return response()->json(['message' => 'Order updated']);
});


Route::get('/audio', function(Request $request){
    return Audio::all();


});
Route::post('/store_tempo', function(Request $request){
    $audio_filename = $request->input('filename');
    $audio_overall_tempo = $request->input('overall_tempo');
    $audio_peak_1 = $request->input('peak_1');
    $audio_peak_2 = $request->input('peak_2');
    $audio = Audio::create(["filename" => $audio_filename,"overall_tempo" => $audio_overall_tempo,
    "peak_1" => $audio_peak_1,"peak_2" => $audio_peak_2]);
    return $audio;


});

