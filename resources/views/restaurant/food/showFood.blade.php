@extends('layouts.master')
@section('contents')
<div class="titleCourses">
   <h3 class="page-title"> Chi tiết thông tin Món ăn</h3>
</div>
 <div class="row">
     <div class="col-sm-12">
     <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
         <thead>
            <tr>
               <th class="stl-column color-column col-sm-2">Tiêu đề</th>
               <th class="stl-column color-column">Nội dung</th> 
            </tr>
         </thead>
         <tbody id="tbodyTable">
            <tr>
               <td>Tên Món Ăn</td>
               <td>{{ $food->name }}</td>
            </tr>
            <tr>
               <td>Giá cả</td>
               <td>{{ $food->price }}</td>
            </tr>
            <tr>
               <td>Hình Ảnh</td>
               <td><img src="{{ url("$food->images")}}" alt=""></td>
            </tr>
            <tr>
               <td>Thành phần</td>
               <td>{{ $food->ingredients }}</td>
            </tr>
            <tr>
               <td>Ngày Khởi tạo</td>
               <td>{{ date('d-m-Y',strtotime($food->created_at)) }}</td>
            </tr>
            
         </tbody>
      </table>
      <div class="form-actions text-center">
         <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">
           <a href="{{route('list-food.index')}}" class="btn btn-outline green button-pre btn-circle"> Quay Lại
           </a>               
         </div>
      </div>
@endsection                      