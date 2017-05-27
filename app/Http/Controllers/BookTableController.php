<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookTable;
use DB;
use Log;
class BookTableController extends Controller
{
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
                    'party_number'=> 'required',
                ],[
                    'client_name.required'  => 'Name không được bỏ trống',
                    'email.required'        => 'Email không được để trống',
                    'date.required'         => 'Ngày đặt lịch không được để trống',
                    'party_number'          => 'Số lượng người tham gia không được để trống',
                    'email.email'           => 'Phải đúng định dạng mail',
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
