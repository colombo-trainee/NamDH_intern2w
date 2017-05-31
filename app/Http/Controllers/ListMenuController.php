<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use Log;
use Auth;
use App\Models\Food;
use App\Models\Menu;
class ListMenuController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}

	/**
     * Display a listing of the cate.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(){
		$categories = Menu::all();
		return view('restaurant.cate.listView',[
				'categories' => $categories,
			]);
	}

	/**
     * Show the form for creating a new cate.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('restaurant.cate.createCate');
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
            $message = [
                'name.required' => "Không được bỏ trống trường này",
                'name.max'      => "Tên danh mục không được vượt qua 255 ký tự",
            ];
    		$validator =  Validator::make($data, [
                'name'          =>  'required|max:255',
            ],$message);

            if($validator->fails()){
                return redirect()->back()->withInput($data)->withErrors($validator);
            }

    		Menu::create($data);
    		DB::commit();
    		return Redirect(route('list-menu.index'));

    	} catch(Exception $e){
    		Log::info('Can not create categories');
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
    	}
    }

     /**
     * Display the specified cate.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $category = Menu::where("name",$name)->first();
        
        return view('restaurant.cate.showCate',[
        			'category'		=> $category,
        	]);
    }

    /**
     * Show the form for editing the specified cate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      	$category = Menu::find($id);
        
        return view('restaurant.cate.editCate',[
        			'category'		=> $category,
        	]);
    }

     /**
     * Update the specified cate in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$data = $request->all();
    	
    	unset($data['_token']);
		unset($data['_method']);

    	DB::beginTransaction();

    	try{
    		$message = [
                'name.required' => "Không được bỏ trống trường này",
                'name.max'      => "Tên danh mục không được vượt qua 255 ký tự",
            ];
            $validator =  Validator::make($data, [
                'name'          =>  'required|max:255',
            ],$message);

            if($validator->fails()){
                return redirect()->back()->withInput($data)->withErrors($validator);
            }

    		Menu::find($id)->update($data);
    		DB::commit();
    		return Redirect(route('list-menu.index'));

    	} catch(Exception $e){
    		Log::info('Can not update categories');
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
    	}
    }

    /**
     * Remove the specified resource from cate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Menu::find($id)->delete();
       

        return response()->json([
                'error' => false,
                'message' => 'Delete success!'
            ], 200);

    }
}
