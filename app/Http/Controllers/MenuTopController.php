<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuTop;
use DB;
use Log;
class MenuTopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuTop = MenuTop::all();
        return view("restaurant.menuTop.listMenuTop",[
                'menuTop'   => $menuTop,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $parentId = MenuTop::select('id')->where("parentId",0)->get();
        return view('restaurant.menuTop.createMenu',[
                'parentId' => $parentId,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        DB::beginTransaction();

        try{
            $this->validate($request,[
                    'name' => 'required',
                ],[
                    'name.required' => 'Tên danh mục không được bỏ trống',
                ]);
            MenuTop::create($data);

            DB::commit();
            return Redirect(route("menu-top.index"));

        } catch(Exception $e){
            Log::info("không thể thêm mới danh mục");
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
        } 
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
        //
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
        //
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
