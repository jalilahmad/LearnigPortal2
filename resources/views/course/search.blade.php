@include('layout.partials.head-course')
@include('layout.partials.nav')




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
@if (count($searchResults)>0)
    <div class="popular page_section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title text-center">
                        <h1>Courses</h1>
                    </div>
                </div>
            </div>

            <div class="row course_boxes">

                @foreach ($searchResults as $course)
                    
                    
                <!-- Popular Course Item -->
                <div class="col-lg-4 course_box">
                    <div class="card">
                        <img class="card-img-top" src="images/course_1.jpg" alt="https://unsplash.com/@kellybrito">
                        <div class="card-body text-center">
                            <div class="card-title"><a href="courses.html">{{$course->searchable->course_title}}</a></div>
                           
                            <div class="card-text">{{$course->searchable->course_intro}}</div>
                            <div class="price_box d-flex flex-row align-items-center">
                            <div class="course_author_image">
                                @if($course->searchable->user->image = null)
                                <img src="images/author.jpg" alt="https://unsplash.com/@mehdizadeh">
                                    @else
                                    <img src="{{ asset('/storage/avatars/'.$course->searchable->user->profile_image) }}" alt="{{$course->searchable->user->image}}">
                                    @endif

                            </div>
                            <div class="course_author_name">{{$course->searchable->user->first_name}}</div>
                            @if($course->searchable->Course_Price>0)
                            <div class="course_price d-flex flex-column align-items-center justify-content-center"><span>{{$course->Course_Price}}</span></div>
                                @else
                                <div class="course_price d-flex flex-column align-items-center justify-content-center"><span>Free</span></div>
                                @endif

                        </div>
                    </div>
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
