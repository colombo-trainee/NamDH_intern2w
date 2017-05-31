@extends('layouts.app')

@section('content')
<!-- BEGIN LOGO -->
      <div class="logo">
         <a href="{{ URL::asset('') }}">
         <img src="{{ asset('assets/layouts/layout/img/logo-big.png')}}" alt="" /> </a>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN LOGIN -->
      <div class="content">
        
        <!-- BEGIN LOGIN FORM -->
        <div class="login-form">
        <form id="form-login" action="{{ url('/login') }}" method="POST" role="form">
            {{ csrf_field() }}
            <h3 class="form-title font-green">Đăng Nhập</h3>
           
           <!--  <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               
            </div> -->
          
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="email" id="email" placeholder="Nhập email" name="email" value="{{old('email')}}" />
                
                @if ($errors->has('email'))
                                <span class="help-block">
                                    <div style="color:red;"><strong>{{ $errors->first('email') }}</strong></div>
                                </span>
                            @endif                 
                </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Mật khẩu</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" id="password" placeholder="Nhập mật khẩu" name="password" />
                @if ($errors->has('password'))
                                <span class="help-block">
                                    <div style="color:red;"><strong>{{ $errors->first('password') }}</strong></div>
                                </span>
                            @endif                  
                </div>
            <div class="form-actions">
                <button type="submit" class="btn green uppercase">Đăng Nhập</button>
                <label class="rememberme check">
                    <input type="checkbox" name="remember" value="1" />Ghi nhớ</label>
                <a href="#" id="open_modal" class="forget-password" data-toggle="modal" data-target="#myModal2">Tài khoản demo</a>
            </div>
            <div class="create-account">
                <p>
                    <a href="{{ route("register") }}" id="register-btn" class="uppercase">Tạo Tài Khoản</a>
                </p>
            </div>
        </form>
           
        </div>
         <div class="modal fade" id="myModal2" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title title_reservations">Bảng User Demo</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                             <tbody id="tbodyTable">
                             @foreach ($user as $user)
                                
                                <tr>
                                   <td><label>Email</label></td>
                                   <td class="client_name">{{$user->email}}</td>
                                </tr>
                                <tr>
                                   <td><label>Password</label></td>
                                   <td class="email">123456</td>
                                </tr>
                             @endforeach   
                             </tbody>
                        </table>
                    </div>
                  </div>
                  
                </div>
            </div>
</div>
<script>
    $(document).ready(function(){
        $(document.body).on('click','#open_modal', function(e) {
            e.preventDefault();
                $("#myModal2").show();
                $("#myModal2").addClass('in');
             });
    });
</script>
@endsection