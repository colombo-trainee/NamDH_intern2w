<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookTable;
use DB;
use Log;
use Response;
use Illuminate\Support\Facades\Validator;
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
            
            $message = [
                'client_name.required' => "Name must be required",
                'email.required'       => "Email must be required",
                'email.email'          => "Email must be in correct format",
                'date.required'        => "Date must be required",
                'date.after'           => "Date must after today",
                'party_number.required'=> "party_number must be required",
            ];
            $validator =  Validator::make($data, [
                'client_name'   =>  'required',
                'email'         =>  'required|email|unique:book_tables',
                'date'          =>  'required|after:today',
                'party_number'  =>  'required',
            ],$message);

            if($validator->fails()){
                return Response::json([
                    'error' => true,
                    'message' => $validator->errors(),
                    ],500);
            }

            $data['date'] = date("Y-m-d",strtotime($data['date']));
            
            BookTable::create($data);

            DB::commit();
            return Response::json($data);

        } catch(Exception $e){
            Log::info("Không thể đặt lịch");
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error',
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

            $message = [
                'client_name.required' => "Name must be required",
                'email.required'       => "Email must be required",
                'email.email'          => "Email must be in correct format",
                'date.required'        => "Date must be required",
                'date.after'           => "Date must after today",
                'party_number.required'=> "party_number must be required",
                'party_number.digits_between:9,11' => "party_number between 9 - 11 digits",
            ];
            $validator =  Validator::make($data, [
                'client_name'   =>  'required',
                'email'         =>  'required|email|unique:book_tables',
                'date'          =>  'required|after:today',
                'party_number'  =>  'required|digits_between:9,11',
            ],$message);

            if($validator->fails()){
                DB::rollback();
                return response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
            }

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
        
        BookTable::find($id)->delete();
        
        return response()->json([
                'error' => false,
                'message' => 'Delete success!'
            ], 200);
    }
}
