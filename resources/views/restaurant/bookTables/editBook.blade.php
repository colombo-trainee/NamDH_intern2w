@extends('layouts.master')
@section('head')
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@endsection
@section('contents')
<div class="portlet light bordered" id="form_wizard_1">
   <div class="portlet-title">
      <div class="caption">
         <span class="caption-subject font-red bold uppercase"><i class="fa fa-plus-circle" aria-hidden="true"></i> CHỈNH SỬA LỊCH HẸN ĐẶT BÀN </span>
      </div>
   </div>
   {{-- <h3 class="block text-center">Thông tin cơ bản</h3> --}}
   <div class="portlet-body form">
  {{--  @if(count($errors))
      <div class="alert alert-danger text-center">
        <strong>Lỗi!</strong> Hãy kiểm tra lại dữ liệu bạn vừa nhập vào.
      </div>
    @endif --}}
      <form  action="{{route('book-tables.update',$book->id)}}" name="frmUpdateCate" method="POST" enctype="multipart/form-data" autocomplete="off">
         {{ csrf_field() }}
         <div class="form-wizard">
            <div class="form-body">
               <div class="tab-content">
                  <div class="tab-pane active">
                     <div class="form-body col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-10 col-lg-offset-1">

                        <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('client_name') ? 'has-error' : '' }}">
                           <input type="text" class="form-control" id="client_name" name="client_name" value="{{ $book->client_name }}">
                           <label for="name">Tên khách hàng<span class="requireds"> (*)</span></label>
                        </div>
                        <p class="font-red-mint">{{ $errors->first('client_name') }}</p>

                        <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('email') ? 'has-error' : '' }}">
                           <input type="email" class="form-control" id="email" name="email" value="{{ $book->email }}">
                           <label for="email">Email<span class="requireds"> (*)</span></label>
                        </div>
                        <p class="font-red-mint">{{ $errors->first('email') }}</p>

                        <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('date') ? 'has-error' : '' }}">
                           <input type="date" class="form-control" id="date" name="date" value="{{ $book->date }}">
                           <label for="email">Ngày đặt bàn<span class="requireds"> (*)</span></label>
                        </div>
                        <p class="font-red-mint">{{ $errors->first('date') }}</p>

                        <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('party_number') ? 'has-error' : '' }}">
                           <input type="number" class="form-control" id="party_number" name="party_number" value="{{ $book->party_number }}">
                           <label for="party_number">Ngày đặt bàn<span class="requireds"> (*)</span></label>
                        </div>
                        <p class="font-red-mint">{{ $errors->first('party_number') }}</p>

                     </div>
                  </div>
                  </div>
               </div>
            </div>
            <div class="form-actions text-center">
               <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">
                    <a href="{{route('book-tables.index')}}" class="btn btn-outline green button-pre btn-circle"> Quay Lại
                    </a>               
                   <button type="submit" class="btn green btn-circle">
                   Update
                      {{-- <i class="fa fa-check"></i> --}}
                    </button>
                    <input type="hidden" name="_method" value="PUT">
               </div>
            </div>
         </div>
      </form>
   </div>
</div> 
@endsection

@section('footer')
<script src="{{url('js/autoNumeric-min.js')}}"></script>
<script src="{{url('js/jqueryValidate/jquery.validate.js')}}" type="text/javascript"></script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>
      tinymce.PluginManager.add('placeholder', function (editor) {
          editor.on('init', function () {
              var label = new Label;
              onBlur();
              tinymce.DOM.bind(label.el, 'click', onFocus);
              editor.on('focus', onFocus);
              editor.on('blur', onBlur);
              editor.on('change', onBlur);
              editor.on('setContent', onBlur);
              function onFocus() { if (!editor.settings.readonly === true) { label.hide(); } editor.execCommand('mceFocus', false); }
              function onBlur() { if (editor.getContent() == '') { label.show(); } else { label.hide(); } }
          });
          var Label = function () {
              var placeholder_text = editor.getElement().getAttribute("placeholder") || editor.settings.placeholder;
              var placeholder_attrs = editor.settings.placeholder_attrs || { style: { position: 'absolute', top: '2px', left: 0, color: '#aaaaaa', padding: '.25%', margin: '5px', width: '80%', 'font-size': '17px !important;', overflow: 'hidden', 'white-space': 'pre-wrap' } };
              var contentAreaContainer = editor.getContentAreaContainer();
              tinymce.DOM.setStyle(contentAreaContainer, 'position', 'relative');
              this.el = tinymce.DOM.add(contentAreaContainer, "label", placeholder_attrs, placeholder_text);
          }
          Label.prototype.hide = function () { tinymce.DOM.setStyle(this.el, 'display', 'none'); }
          Label.prototype.show = function () { tinymce.DOM.setStyle(this.el, 'display', ''); }
      });

      tinymce.init({
          selector: '#student_object',
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
          ],
          toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ],
          // setup: function(ed) {
          //       ed.on('keyup', function(e) {
          //           check_submit();
          //       });
          //   }
        });

      tinymce.init({
          selector: '#content',
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
          ],
          toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ],
          // setup: function(ed) {
          //       ed.on('keyup', function(e) {
          //           // check_submit();
          //       });
          //   }
        });

      tinymce.init({
          selector: '#policy',
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
          ],
          toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ],
          // setup: function(ed) {
          //       ed.on('keyup', function(e) {
          //           // check_submit();
          //       });
          //   }
        });

  </script>

@endsection
