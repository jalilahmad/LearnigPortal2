@include('layout.partials.head-course')
@include('layout.partials.nav')
@include('layout.partials.head-episode')




<!-- Home -->

<div class="home">
    <div class="home_background_container prlx_parent">
        <div class="home_background prlx" style="background-image:url(images/courses_background.jpg)"></div>
    </div>
    <div class="home_content">
        <h1>Courses</h1>
    </div>
</div>

<!-- Popular -->
@if (count($courses)>0)
    <div class="popular page_section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title text-center">
                        <h1>Popular Courses</h1>
                    </div>
                </div>
            </div>

            <div class="row course_boxes">

                @foreach ($courses as $course)
                    
                    
                <!-- Popular Course Item -->
                <div class="col-lg-4 course_box">
                    <div class="card">
                        <img class="card-img-top" src="images/course_1.jpg" alt="https://unsplash.com/@kellybrito">
                        <div class="card-body text-center">
                            <div class="card-title"><a href="courses\{{$course->id}}">{{$course->course_title}}</a></div>
                           
                            <div class="card-text">{{$course->course_intro}}</div>
                            
                        </div>
                        <div class="price_box d-flex flex-row align-items-center">
                            <div class="course_author_image">
                                @if($course->user->profile_image = null)
                                <img src="images/author.jpg" alt="https://unsplash.com/@mehdizadeh">
                                    @else
                                    <img src="{{ asset('/storage/avatars/'.$course->user->profile_image) }}" alt="{{$course->User->image}}">
                                    @endif

                            </div>
                            <div class="course_author_name">{{$course->User->first_name}}</div>
                            @if($course->Course_Price>0)
                            <div class="course_price d-flex flex-column align-items-center justify-content-center"><span>{{$course->Course_Price}}</span></div>
                                @else
                                <div class="course_price d-flex flex-column align-items-center justify-content-center"><span>Free</span></div>
                                @endif
                        </div>
                    </div>
                    @if($course->user_id == Auth::User()->id)
                        <div class="container">
                        <div class="row">
                        

                        <div class="button button_color_1 text-center trans_200">
                        <a href="{{route('courses.edit', $course->id)}}">Edit</a></div>
                        <div>
                        <form action="{{ route('courses.destroy', $course->id) }}" method = "post">
                                @csrf
								@method('DELETE')
								<button type="submit" class="button button_color_2 text-center trans_200">DELETE</button>
                                </form>
                                </div>

                        
                        </div>
                        </div>
                        @endif
                </div>
                @endforeach


            </div>
        </div>
    </div>
@else 
    <P>No Courses Found!</P>


@endif

<!-- Footer -->



@include('layout.partials.footer')
@include('layout.partials.footer-scripts')
