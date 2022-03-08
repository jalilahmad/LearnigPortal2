@include('layout.partials.head-teachers')
@include('layout.partials.nav')



<div class="super_container">
    <div class="home">
        <div class="home_background_container prlx_parent">
            <div class="home_background prlx" style="background-image:url(images/teachers_background.jpg)"></div>
        </div>
        <div class="home_content">
            <h1>Teachers</h1>
        </div>
    </div>

    <!-- Teachers -->

    <div class="teachers page_section">
        <div class="container">
            <div class="row">

				<!-- Teacher -->
                @if(count($teachers)>0)
                @foreach($teachers as $teacher)
				<div class="col-lg-4 teacher">
					<div class="card">
						<div class="card_img">
							<div class="card_plus trans_200 text-center"><a href="#">+</a></div>
							<img class="card-img-top trans_200" src="{{ asset('/storage/avatars/'.$teacher->profile_image) }}" alt="https://unsplash.com/@michaeldam">
						</div>
						<div class="card-body text-center">
							<div class="card-title"><a href="#">{{$teacher->first_name}}</a></div>
						</div>
					</div>
				</div>
                 @endforeach
                <!-- Teacher -->
                @else
                <p>No Teachers Found!</p>
                @endif

    <!-- Milestones -->

            </div>
        </div>
    </div>
</div>




@include('layout.partials.footer')
@include('layout.partials.footer-scripts')
