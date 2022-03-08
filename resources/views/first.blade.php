@include('layout.partials.head')
@include('layout.partials.nav')




<!-- Home -->

<div class="home">

<div class="hero_slider_container">
			<div class="hero_slider owl-carousel">
				
				<!-- Hero Slide -->
				<div class="hero_slide">
					<div class="hero_slide_background" style="background-image:url(images/slider_background.jpg)"></div>
					<div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
						<div class="hero_slide_content text-center">
							<h1 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut">Get your <span>Education</span> today!</h1>
						</div>
					</div>
				</div>
				
				<!-- Hero Slide -->
				<div class="hero_slide">
					<div class="hero_slide_background" style="background-image:url(images/slider_background.jpg)"></div>
					<div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
						<div class="hero_slide_content text-center">
							<h1 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut">Get your <span>Education</span> today!</h1>
						</div>
					</div>
				</div>
				
				<!-- Hero Slide -->
				<div class="hero_slide">
					<div class="hero_slide_background" style="background-image:url(images/slider_background.jpg)"></div>
					<div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
						<div class="hero_slide_content text-center">
							<h1 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut">Get your <span>Education</span> today!</h1>
						</div>
					</div>
				</div>

			</div>

			<div class="hero_slider_left hero_slider_nav trans_200"><span class="trans_200">prev</span></div>
			<div class="hero_slider_right hero_slider_nav trans_200"><span class="trans_200">next</span></div>
		</div>

</div>

<div class="hero_boxes">
    <div class="hero_boxes_inner">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 hero_box_col">
                    <div class="hero_box d-flex flex-row align-items-center justify-content-start">
                        <img src="images/books.svg" class="svg" alt="">
                        <div class="hero_box_content">
                            <h2 class="hero_box_title">Our Courses</h2>
                            <a href="courses" class="hero_box_link">view more</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 hero_box_col">
                    <div class="hero_box d-flex flex-row align-items-center justify-content-start">
                        <img src="images/professor.svg" class="svg" alt="">
                        <div class="hero_box_content">
                            <h2 class="hero_box_title">Our Teachers</h2>
                            <a href="teachers" class="hero_box_link">view more</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Popular -->




                <!-- Search -->

                <div class="search_section d-flex flex-column align-items-center justify-content-center">
                    <div class="search_background" style="background-image:url(images/search_background.jpg);"></div>
                    <div class="search_content text-center">
                        <h1 class="search_title">Search for your course</h1>
                        <form id="search_form" class="search_form" method="post" action="{{url('/search')}}">
                            @csrf
                            <input id="search_form_name" name="search-query" class="input_field search_form_name" type="text" placeholder="Course Name" required="required" data-error="Course name is required.">
                            
                            <button id="search_submit_button" type="submit" class="search_submit_button trans_200" value="Submit">search course</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<!-- Testimonials -->






<!-- Footer -->




@include('layout.partials.footer')
@include('layout.partials.footer-scripts')
