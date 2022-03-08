<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;
use App\DataTables\CoursesDataTable;


use Redirect,Response,DB,Config;
use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\CourseEpisode;
use App\Tag;
use App\Watchlist;
use App\Bookmark;

class CourseController extends Controller
{

    

    public function __construct()
    {
        $this->middleware('auth',['except'=> ['index','show','searchCourse']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $courses = Course::with('User')->get();
        
    
        return view('course.index')->with('courses',$courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 /*   public function store(Request $request)
    {
        $request->validate([
    
        ])
        $course = new Course();
            $course->course_title = $request('course_title');
            $course->course_intro = $request('course_intro');
            $course->course_photo = $request('course_photo');
        $course->save();
        $courseEpisode = new CourseEpisode;
            $courseEpisode->episode_title = $request('episode_title');
            
        return redirect('courses');
    } */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $course = Course::find($id);
        $episodes = Course::find($id)->courseEpisodes;
        return view('course.episode')->with('course',$course)->with( 'episodes' , $episodes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $course = Course::find($id);
        return view('course.edit')->with('course',$course);
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $course =  Course::find($id);
        $request->validate([
            'course_image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'course_title' => 'required|unique:courses',
            'course_intro' => 'required',
        ]);

        $course->course_title = $request->input('course_title');
        $course->course_intro = $request->input('course_intro');

        $fileName = "course_image-" . time() . '.' . request()->course_image->getClientOriginalName();
        $request->course_image->storeAs('public/course-images', $fileName);
        $course->course_image=$fileName;

        
    $course->save();
    return redirect('/my-courses')->with('sucess', 'Course Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $course = Course::find($id);
        $course->delete();
        return redirect('/courses')->with('sucsess', 'Course Removed');
    
    }



    public function CreateStepOne(Request $request){
        session_start();
        $course = $request->session()->get('course');
        return view('course.create-step-one', compact('course',$course));
    }

    public function StoreStepOne(Request $request){

        $validatedData = $request->validate([

            'course_title' => 'required|unique:courses',
            'course_intro' => 'required',
        ]);

        if(empty($request->session()->get('course'))){

            $course = new Course();
            $course->fill($validatedData);
            $course->uuid = (string)Uuid::generate();
            $request->session()->put('course',$course);
        }
        else{
            $course->request->session()->get('course');
            $course->fill($validatedData);
            $request->session()->put('course',$course);
        }
        return redirect('/create-step-two');
    }  


    public function CreateStepTwo(Request $request){

        $course = $request->session()->get('course');
        return view('course.create-step-two', compact('course',$course));
    }

    public function StoreStepTwo(Request $request){
        $course = $request->session()->get('course');
        if(!isset($course->course_image)){
            $request->validate([
                'course_image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            $fileName = "course_image-" . time() . '.' . request()->course_image->getClientOriginalName();
            $request->course_image->storeAs('course-images', $fileName);
            $course = $request->session()->get('course');
            $course->course_image=$fileName;
            $request->session()->put('course',$course);
        }
        return redirect('/create-step-three');
    }


    public function RemoveImage(Request $request){

        $course = $request->session()->get('course');
        $course->course_image = null;
        return view('course.create-step-two', compact('course',$course));
    }



    public function CreateStepThree(Request $request){

        $course = $request->session()->get('course');
        return view('course.create-step-three', compact('course', $course));
    }
    
    
    public function store(Request $request)
    {
        


         $request->validate([

            'episode_video' => 'required|mimes:mp4,mkv,mov|max:524288',
            'episode_title' => 'required',
            'episode_description' => 'required',
        ]);

        

        

            $fileName = "episode_video-" . time() . '.' . request()->episode_video->getClientOriginalExtension();
            $request->episode_video->storeAs('episodes', $fileName);
        

        $course = $request->session()->get('course');
        $tagNames = explode(",", $request->tags);
        foreach($tagNames as $tag){
            Tag::firstOrCreate(['name' => $tag,])->save();
        }
        $tags = Tag::whereIn('name', $tagNames)->get()->pluck('id');
        $user = Auth::user();
        $course->user()->associate($user)->save();
        $course->tags()->sync($tags);
        

        $episode = new CourseEpisode;

        $episode->episode_title = $request->input('episode_title');
        $episode->episode_description = $request->input('episode_description');
        $episode->episode_video = $fileName;
        $episode->uuid = (string)Uuid::generate();
        
        $episode->course()->associate($course)->save();
        return redirect('/my-courses');
        
        
        
        
    } 


    public function indexMycourses(Request $request){

        $request->session()->forget('course');
        $courses = Auth::user()->courses()->get(); 
        return view('course.my-courses')->with('courses',$courses);
    }

    public function addEpisode($id){

        $course = Course::find($id);
        return view('course.add-episode')->with('course',$course);

    }

    public function storeNewEpisode(Request $request){


        $validatedData = $request->validate([

            'episode_video' => 'required|mimes:mp4,mkv,mov|max:524288',
            'episode_title' => 'required',
            'episode_description' => 'required',
        ]);

        $fileName = "episode_video-" . time() . '.' . request()->episode_video->getClientOriginalExtension();
        $request->episode_video->storeAs('episodes', $fileName);

        $episode = new CourseEpisode;
        $course = Course::find($request->course_id);
        
        

        $episode->episode_title = $request->input('episode_title');
        $episode->episode_description = $request->input('episode_description');
        $episode->episode_video = $fileName;
        $episode->uuid = (string)Uuid::generate();
        
        $episode->course()->associate($course)->save();
        return redirect('/my-courses');
    }

    public function download($uuid){
    $episode = CourseEpisode::where('uuid', $uuid)->firstOrFail();
    $pathToFile = storage_path('app/public/episodes/' . $episode->episode_video);
    return response()->download($pathToFile);
    }

    public function addToWatchlist($id){
        
         $addwatchlist = Watchlist::create([
            'user_id' => Auth::user()->id,
            'episode_id' => $id
        ]);
    
        return Redirect()->back(); 
    }

    public function Watchlist(){

        $user = User::with('watchlist')->find(\Auth::id());
       // return $user;
        return view('dashboard.watchlist')->with('user',$user);
    }



    public function tagsView($id){

        $courses = Tag::findOrFail($id)->courses;
        return view('course.tags')->with('courses', $courses);
    }

    public function BookmarkCourse($id){

        $bookmark = Bookmark::create([
            'user_id' => Auth::user()->id,
            'course_id' => $id
        ]);
    
        return Redirect()->back();

    }

   public function showBookmarkedCourses(){

    $user = User::with('bookmark')->find(\Auth::id());
       // return $user;
        return view('course.bookmark')->with('user',$user);

   }








        

}
