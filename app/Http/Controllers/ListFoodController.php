<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use Log;
use Auth;
use App\Models\Food;
use App\Models\Menu;
class ListFoodController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the food.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_food = Food::all();
        return view('restaurant.food.listFood',[
                'list_food'     => $list_food,
            ]);
    }

    /**
     * Show the form for creating a new food.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Menu::all();
        return view('restaurant.food.createFood',[
                'categories' => $categories,
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
                'name'          =>  'required|max:255',
                'price'         =>  'required',
                'images'        =>  'required|image|max:1000',
                'ingredients'   =>  'required',
            ],[
                'name.required'     =>  'Trường này không được phép để trống',
                'name.max'          => 'Tên danh mục không được vượt qua 255 ký tự',
                'price.required'    =>   'Trường price không được phép để trống',
                'images.required'            =>   'Trường images không được phép để trống',
                'ingredients.required'       =>   'Trường ingredients không được phép để trống',
               
            ]);

            $data['images'] = $request->file('images')->store('images',time().'.jpg','s3');
           
            Food::create($data);

            DB::commit();

            return Redirect(route('list-food.index'));
        } catch(Exception $e){
            Log::info('Can not create food');
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
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
           $food = Food::where('name',$name)->first();
           return view("restaurant.food.showFood",[
                    'food'  => $food,
            ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::find($id);
        $categories = Menu::all();
           return view("restaurant.food.editFood",[
                    'food'          => $food,
                    'categories'    => $categories,
            ]); 
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
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);

         DB::beginTransaction();

        try{
            $this->validate($request,[
                'name'          =>  'required|max:255',
                'price'         =>  'required',
                'ingredients'   =>  'required',
            ],[
                'name.required'     =>  'Trường này không được phép để trống',
                'name.max'          => 'Tên danh mục không được vượt qua 255 ký tự',
                'price.required'    =>   'Trường price không được phép để trống',
                'ingredients.required'       =>   'Trường ingredients không được phép để trống',
               
            ]);
            if($request->hasFile('images')){
                $data['images'] = $request->file('images')->store('images',time().'.jpg','s3');
            }
            
            
            Food::where('id',$id)->update($data);

            DB::commit();

            return Redirect(route('list-food.index'));
        } catch(Exception $e){
            Log::info('Can not edit food');
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         DB::beginTransaction();
        try {

            Food::find($id)->delete();
            DB::commit();

            return response()->json([
                    'error' => false,
                    'message' => 'Delete success!'
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not delete food has id = ' . $id);
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
        }
    }
}
