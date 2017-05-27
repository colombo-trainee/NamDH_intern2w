@include('restaurant.header')
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
							@foreach ($category->Food as $food)
									
									<li @if ($food->status==1) class="special"
									@endif>
										<div class="header_details">	
											<a class="pull-left" href="">{{$food->name}}</a>
											<span class="pull-right">${{$food->price}}</span>
										</div>
										<div class="text_details">{{$food->ingredients}}</div>
									</li>
								
								
							@endforeach
							</ul>
						</div>
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</article>

@include('restaurant.footer')