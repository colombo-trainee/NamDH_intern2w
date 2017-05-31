@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption uppercase">
        <i class="fa fa-book"></i> Quản lý User</div>
   
</div>
<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-5">
        <button class="btn green btn-circle"><i class="fa fa-plus"></i> Thêm mới</button>
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
                   <th class="stl-column color-column">Email</th>
                   <th class="stl-column color-column">Created At</th>
                   
                </tr>
                
            </thead>
            <tbody>
                @if(isset($users)) @foreach($users as $key => $user)
                <tr>
                    <td class="text-center"> {{ $key + 1 }} </td>
                    <td class="text-center"> {{ $user->name }} </td>
                    <td class="text-center"> ${{ $user->email }} </td>
                    <td class="text-center"> {{ date('d-m-Y H:i:s ', strtotime($user->created_at)) }} </td>
                    {{-- <td class="text-center"> 
                      @if ($course->status == 1)
                        Hiển thị
                      @else
                        Ẩn
                      @endif
                    </td> --}}
                   
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