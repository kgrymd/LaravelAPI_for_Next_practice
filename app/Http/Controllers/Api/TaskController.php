<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderby('id', 'asc')->get(); // 新しい順で並べる
        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'title' => 'required | max:191',
    ]);
    if ($validator->fails()) {
        return response()->noContent();
    }
    $result = Task::create($request->all());
    return response()->noContent();
    }

    // 詳細機能
    public function show(Request $request)
    {
        $id = $request['id'];
        return Task::find($id);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:191',
        ]);
        if ($validator->fails()) {
        return response()->noContent();
        }
        //データ更新処理
        $result = Task::find($id)->update($request->all());
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Task::find($id)->delete();
        return response()->noContent();
    }
}
