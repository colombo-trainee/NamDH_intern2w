@include('restaurant.header')

<article>
	<div class="cover_section_about">
		<div class="container">
		<!-- section 2 -->
			<!-- Section About -->
			<div class="row">
				<div class="section-about">
					<!-- Info text -->
					<div class="col-md-6">
						<div class="text-center">
							<h3 class="tilte_about">Just the right food</h3>
							<img src="images/devider2.png" alt="">
							<p>If you’ve been to one of our restaurants, you’ve seen – and tasted - what keeps our customer coming back for more.Perfect materials and freshly baked food,delicious Lambda cakes, muffins,and gourmet coffes make us hard to resist! Stop in today and check us out!</p>
							<img src="images/cook.png" alt="" class="cook">

						</div>
					</div>
					<!-- images foods -->
					<div class="col-md-6">
						<div class="right_food_img">
							<img src="images/food4.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>

<!-- Section ingredients -->

<article>
	<div class="cover_section_ingredients">
		<div class="container">
			<div class="row">
				<div class="section_ingredients">
					<div class="col-md-6 pull-right">
						<div class="content-right">
							<h3 class="title_ingredients">Fine ingredients</h3>
							<img src="images/devider3.png" alt="" class="devider">
							<p>If you’ve been to one of our restaurants, you’ve seen – and tasted - what keeps our customer coming back for more.Perfect materials and freshly baked food,delicious Lambda cakes, muffins,and gourmet coffes make us hard to resist! Stop in today and check us out!</p>
							<div class="ingredients_images"><img src="images/rice.png" alt="" class="img-circle"></div>
							<div class="ingredients_images"><img src="images/section3-image.png" alt="" class="img-circle"></div>
							<div class="ingredients_images"><img src="images/bread.png" alt="" class="img-circle"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>

<!-- Section menu  -->

<article>
		<div class="cover_section_menu">
			<div class="container">
				<div class="row">

					<div class="section_menu">
					@foreach ($categories as $key => $category)
						<div class="col-md-6 menu">
							<h3 class="title_menu">{{ $category->name}}</h3>
							<img src="images/devider2.png" alt="">
							<ul class="details_menu">
							@foreach ($category->Food as $limit => $food)

								@if ($limit <= 2)
									<li @if ($food->status==1) class="special"
									@endif>
										<div class="header_details">	
											<a class="pull-left" href="">{{$food->name}}</a>
											<span class="pull-right">${{$food->price}}</span>
										</div>
										<div class="text_details">{{$food->ingredients}}</div>
										<div class="images_details"><img src="{{url("$food->images")}}" alt=""></div>
									</li>
								@endif
								
							@endforeach
							</ul>
						</div>
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</article>

<!-- Section reviews -->
<article>
	<div class="cover_section_reviews">
		<div class="container">
			<div class="row">
				<div class="section_reviews">
					<div class="col-md-8 col-md-offset-2 content-reviews">
						<h3 class="title_reviews">Guest Reviews</h3>
						<img src="images/devider3.png" alt="">
						<span class="quote">“</span><p> If you’ve been to one of our restaurants, you’ve seen – and tasted - what keeps our customer coming back for more.Perfect materials and freshly baked food,delicious Lambda cakes, muffins,and gourmet coffes make us hard to resist! Stop in today and check us out!</p>
						<div class="sign">-food inc,New York</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>

<!-- Section reservations -->
<article>
	<div class="cover_section_reservations">
		<div class="container">
			<div class="row">
				<div class="section_reservation">
					<div class="col-md-6 reservations_left">
						<div class="row">
							<div class="col-md-6">
								<img src="images/reservation_image.png" alt="">
							</div>
							<div class="col-md-6">
								<img src="images/reservation_image2.png" alt="">
							</div>
						</div>
					</div>
					<div class="col-md-5 .col-md-offset-1 reservations_right pull-right">
						<h3 class="title_reservations">Just the right food</h3>
						<img src="images/devider2.png" alt="">
						<p> If you’ve been to one of our restaurants, you’ve seen – and tasted - what keeps our customer coming back for more.Perfect materials and freshly baked food.</p>
						<p class="text-2">Delicious Lambda cakes, muffins,and gourmet coffes make us hard to resist! Stop in today and check us out!Perfect materials and freshly baked food.</p>
						
						<form method="POST" action="" id="formBook">
							{{ csrf_field() }}
							  <div class="form-group">
							    <label for="name">Name</label>
							    <input type="text" name="client_name" id="client_name" class="form-control" placeholder="your name *" required="required">
							  	
							  	<p style="color: red;display: none;" class="error errorName"></p>
							  </div>
							  <div class="form-group">
							    <label for="email">Email</label>
							    <input type="email" name="email" id="email" class="form-control" placeholder="your email *" required="required">

							    <p style="color: red;display: none;" class="error errorEmail"></p>
							  </div>
							  <div class="form-group">
							  	<label for="date">Date</label>
							    <input type="text" name="date" id="date" class="form-control" placeholder="date *" required="required">
							    <p style="color: red;display: none;" class="error errorDate"></p>
							    <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
							  </div>  
							  <div class="form-group">
							  	<label for="party">Party Number</label>
							  	<input type="number"  name="party_number" id="party_number" class="form-control" placeholder="Party Number *" required="required">
							  	<p style="color: red;display: none;" class="error errorPartyNumber"></p>
							  </div>
							  	
							  <button class="btn btn-warning" type="button" id="book">Book now!</button> 
						</form>
						<div class="modal fade" id="myModal" role="dialog">
						    <div class="modal-dialog">
						    
						      <!-- Modal content-->
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title title_reservations">Bàn đã được đặt</h4>
						        </div>
						        <div class="modal-body">
						          	<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								         <thead>
								            <tr>
								               <th class="stl-column color-column col-sm-2"><label>Tiêu đề</label></th>
								               <th class="stl-column color-column"><label>Nội dung</label></th> 
								            </tr>
								         </thead>
								         <tbody id="tbodyTable">
								            <tr>
								               <td><label>Tên khách hàng</label></td>
								               <td class="client_name"></td>
								            </tr>
								            <tr>
								               <td><label>Email</label></td>
								               <td class="email"></td>
								            </tr>
								            <tr>
								               <td><label>Ngày đặt bàn</label></td>
								               <td class="date"></td>
								            </tr>
								            <tr>
								               <td><label>Số điện thoại người đặt</label></td>
								               <td class="party_number"></td>
								            </tr>
								         </tbody>
							     	</table>
						        </div>
						        <div class="modal-footer">
						          <p style="text-align: center;">Chúng tôi sẽ liên lạc với quý khách sớm !!!</p>
						          <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Close</button>
						        </div>
						      </div>
						      
    						</div>
  						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="snackbar">Đặt bàn thành công..</div>
</article>
<meta name="_token" content="{!! csrf_token() !!}" />

<script>
	$(document).ready(function() {
			$("#date").datepicker();
			$.ajaxSetup({
				headers:{
					"X-CSRF-TOKEN": $("meta[name='_token']").attr('content')
				}
			});

			$(document.body).on('click','#book', function() {

				var client_name = $('#client_name').val();
				var email = $("#email").val();
				var date = $("#date").val();
				var party_number = Number($("#party_number").val());
				
				$.ajax({
					url: "{{ route('book-tables.store') }}",
					type: 'POST',
					dataType: 'JSON',
					data: {'client_name':client_name,'email': email,'date': date,'party_number': party_number},
					success: function(data){
						var x = $('#snackbar');
			 			console.log(data);
			 			x.addClass('show');
			 			setTimeout(function(){ x = x.removeClass("show"); }, 3000);

			 			$('#client_name').val("");
			 			$('#email').val("");
			 			$('#date').val("");
			 			$('#party_number').val("");
			 			$('.error').hide();

			 			$('.client_name').text(data.client_name);
			 			$('.email').text(data.email);
			 			$('.date').text(data.date);
			 			$('.party_number').text(data.party_number);
			 			$('#myModal').show();
			 			$('#myModal').addClass('in');

			 		},
	            	error: function (data) {
	            		var error = data.responseJSON.message;
	                	console.log('Error:',error);
	                	$('.error').hide();
	                	if(error.client_name != undefined){
	                		$('.errorName').show().text(error.client_name[0]);
	                	}
	                	if(error.email != undefined){
	                		$('.errorEmail').show().text(error.email[0]);
	                	}
	                	if(error.date != undefined){
	                		$('.errorDate').show().text(error.date[0]);
	                	}
	                	if(error.party_number != undefined){
	                		$('.errorPartyNumber').show().text(error.party_number[0]);
	                	}
	                	$(document.body).on('change','input', function() {
	                		if($(this).val() != " "){
								$(this).next("p").hide();
	                		}
							
						});
	            	}
				});

			});
			$(document.body).on('click','#close', function() {
				$('#myModal').removeClass("in");
				$('#myModal').hide();
			});
	});
</script>
@include('restaurant.footer')