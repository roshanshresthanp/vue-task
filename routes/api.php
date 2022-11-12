<?php

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('employees',function ()
{
    return Employee::all();
});

Route::post('employees',function (Request $request)
{

    // return $request->all();
    try{
        $emp = Employee::create($request->all());
        return response()->json(['status'=>$emp]);
    }catch(\Exception $e)
    {
        return response()->json(['status'=>$e->getMessage()]);
    }


    // return Employee::all();
});

Route::patch('employee/{id}',function (Request $request, $id)
{
    try{
        $emp = Employee::findOrFail($id)->update($request->all());
        return response()->json(['status'=>$emp]);
    }catch(\Exception $e)
    {
        return response()->json(['status'=>$e->getMessage()]);
    }


    // return Employee::all();
});

Route::delete('employee/{id}',function ($id)
{
    try{
        $emp = Employee::findOrFail($id)->delete();
        return response()->json(['status'=>'success']);
    }catch(\Exception $e)
    {
        return response()->json(['status'=>$e->getMessage()]);
    }


    // return Employee::all();
});
