@include('layout.partials.head')



@include('layout.partials.head-episode')



<div class="super_container">

	
	<!-- Home -->

	<div class="home">
		<div class="home_background_container prlx_parent">
			<div class="home_background prlx" style="background-image: url({{ asset('/storage/course-images/'.$course->course_image) }})"></div>
		</div>
		<div class="home_content">
			<h1>{{$course->course_title}}</h1>
		</div>
	</div>


	<div class="elements">
		<!-- Progress Bars and Accordions -->

		<div class="pbars_accordions">
			<div class="container">
				<div class="row pbars_accordions_container">
					<!-- Progress Bars & Accordions -->
					<div class="col-lg-12">

						<!-- Accordions -->
						
						<div class="elements_accordions">
						@if(count($episodes)>0)
                		@foreach($episodes as $episode)
							<div class="accordion_container">
								<div class="accordion d-flex flex-row align-items-center">{{$episode->episode_title}}</div>
								<div class="accordion_panel">
                                    <p>{{$episode->episode_description}}</p>
									@if($episode->isApproved == true)
                                    <video style="max-width:100%; height:auto;" controls>
                                        <source src="{{ asset('/storage/episodes/'.$episode->episode_video) }}" type="video/mp4">
                                      Your browser does not support the video tag.
                                      </video>
									  @else
									  <p> Episode Video Pending Approval</p>
									  @endif
									  <hr />
									  @if(Auth::user())
									<div class="container">
									<div class="row">

									<a  class="btn btn-warning" href="{{ route('episode.download', $episode->uuid) }}">Download</a>
									<form style="align-content: flex-end" method="post" action="{{ route('add.watchlist', $episode->id) }}">
									@csrf
									<input type="submit" class="btn btn-warning" value="Add To Watchlist"/>
									</form>

									</div>
									</div>

									  @include('course._comment_replies', ['comments' => $episode->comments, 'episode_id' => $episode->id])
									<hr />
                    					<h4>Comment</h4>
                    				<form method="post" action="{{ route('comment.add') }}">
                        				@csrf
                        				<div class="form-group">
                            				<input type="text" name="comment_text" class="form-control" />
                            				<input type="hidden" name="episode_id" value="{{ $episode->id }}" />
                        				</div>
                        				<div class="form-group">
                            			<input type="submit" class="btn btn-warning" value="Comment" />
                        				</div>
										</form>
									@endif

								</div>
							</div>

							@endforeach
						@else
						<p>No Episodes yet</p>
						@endif
						@if(Auth::user())
						@if(Auth::user()->id ==$course->user_id)
						<div class="button button_color_3 text-center trans_200">
                        <a href="{{route('add.episode', $course->id)}}">Add Episode</a></div>
                        <div>
						@endif
						@endif
						</div>
					</div>

				</div>
			</div>
		</div>
        
        
	</div>


</div>
<br></br>



@include('layout.partials.footer')

@include('layout.partials.footer-scripts')