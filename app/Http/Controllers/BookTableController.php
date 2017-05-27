<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookTable;
use DB;
use Log;
class BookTableController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listBook = BookTable::all();
        return view('restaurant.bookTables.listBook',[
            'listBook'  => $listBook,    
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        try {
            $this->validate($request,[
                    'client_name' => 'required',
                    'email'       => 'required',
                    'date'        => 'required',
                    'party_number'=> 'required|digits_between:9,11',
                ],[
                    'client_name.required'  => 'Name không được bỏ trống',
                    'email.required'        => 'Email không được để trống',
                    'date.required'         => 'Ngày đặt lịch không được để trống',
                    'party_number.required'          => 'Số điện thoại không được để trống',
                    'email.email'           => 'Phải đúng định dạng mail',
                    'party_number.digits_between' => 'Số điện thoại phải từ 9 đến 11 số'  
                ]);
            
            BookTable::create($data);

            DB::commit();
            return Redirect(route('book-tables.index'));

        } catch(Exception $e){
            Log::info("Không thể đặt lịch");
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $book = BookTable::find($id);
        return view("restaurant.bookTables.editBook",[
                'book'      => $book,
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
                    'client_name' => 'required',
                    'email'       => 'required',
                    'date'        => 'required',
                    'party_number'=> 'required|digits_between:9,11',
                ],[
                    'client_name.required'  => 'Name không được bỏ trống',
                    'email.required'        => 'Email không được để trống',
                    'date.required'         => 'Ngày đặt lịch không được để trống',
                    'party_number.required'          => 'Số điện thoại không được để trống',
                    'email.email'           => 'Phải đúng định dạng mail',
                    'party_number.digits_between' => 'Số điện thoại phải từ 9 đến 11 số'  
                ]);

            BookTable::find($id)->update($data);

            DB::commit();
            return Redirect(route('book-tables.index'));
        } catch (Exception $e){
            Log::info("Không thể chỉnh sửa book table");
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

        try{

            BookTable::find($id)->delete();

            DB::commit();
            return Redirect(route('book-tables.index'));
        } catch (Exception $e){
            Log::info("Không thể chỉnh sửa book table");
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
        }
    }
}
