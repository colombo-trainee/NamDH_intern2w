@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption uppercase">
        <i class="fa fa-book"></i> Quản lý List đồ ăn</div>
   
</div>
<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-5">
        <button onclick="addCourse();" class="btn green btn-circle"><i class="fa fa-plus"></i> Thêm mới</button>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-7">
        <form method="get" action="">
            <input type="text" class="search-class form-control" id="search"  name="search"  placeholder="Nhập Thông Tin Tìm Kiếm">
        </form>
    </div>
</div>
<div class="portlet-body">
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
                <tr>
                   <th class="stl-column color-column">#</th>
                   <th class="stl-column color-column">Name</th>
                   <th class="stl-column color-column">Price</th>
                   <th class="stl-column color-column">Category</th>
                   <th class="stl-column color-column">Created At</th>
                   {{-- <th class="stl-column color-column">Trạng thái</th> --}}
                   <th class="stl-column color-column">Hành động</th>
                </tr>
                
            </thead>
            <tbody>
                @if($list_food) @foreach($list_food as $key => $food)
                <tr>
                    <td class="text-center"> {{ $key + 1 }} </td>
                    <td class="text-center"> {{ $food->name }} </td>
                    <td class="text-center"> ${{ $food->price }} </td>
                    @if (!empty($food->Menu->name))
                     <td class="text-center"> {{ $food->Menu->name }} </td>
                    @endif
                    <td class="text-center"> {{ date('d-m-Y H:i:s ', strtotime($food->created_at)) }} </td>
                    {{-- <td class="text-center"> 
                      @if ($course->status == 1)
                        Hiển thị
                      @else
                        Ẩn
                      @endif
                    </td> --}}
                    <td class="text-center"> 
                        <a href="{{route('list-food.show', $food->name)}}" class="btn btn-outline btn-circle btn-sm blue">
                            <i class="fa fa-eye" aria-hidden="true"></i> Xem 
                        </a>
                        <a href="{{route('list-food.edit', $food->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                            <i class="fa fa-edit"></i> Sửa 
                        </a>
                        {{-- <form action="#" method="DELETE" style="display: initial;"> --}}
                          <a href="javascript:;" type="submit" onclick="alertDel({{$food->id}})" class="btn btn-outline btn-circle dark btn-sm red">
                            <i class="fa fa-trash-o"></i> Xóa 
                          </a>
                        {{-- </form> --}}
                        
                    </td>
                   
                </tr>
                @endforeach @else
                  <tr>
                    <td colspan="7" class="text-center"> Không có bản ghi nào </td>
                  </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>
</div>

<script>
 function alertDel(id){

  var path = "{{URL::asset('')}}list-food/" + id;

    swal({
        title: "Bạn có chắc muốn xóa?",
        // text: "Bạn sẽ không thể khôi phục lại bản ghi này!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Không",
        confirmButtonText: "Có",
        
        // closeOnConfirm: false,
    },
    function(isConfirm) {
        if (isConfirm) {  

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "DELETE",
              url: path,
              success: function(res)
              {
                if(!res.error) {
                    toastr.success('Xóa thành công!');
                    setTimeout(function () {
                        location.reload();
                    }, 1000)                   
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
              }
        });

            
        } else {
            toastr.info("Thao tác xóa đã bị huỷ bỏ!");
        }
    });
 }   
 </script>
@endsection
@section('footer')
 <script src="{{url('js/curd-Course.js')}}" type="text/javascript"></script>
 <script>
     function addCourse() {
         window.location = "{{route('list-food.create')}}"
     }
 </script>
@endsection