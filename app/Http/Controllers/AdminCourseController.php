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

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $courses = Course::with('User','tags')->get();
            return datatables()->of($data)
            ->addColumn('users', function(Course $course){
                return $course->user->name;
            })
            ->addColumn('tags', function (Course $course) {
                return $course->tags->map(function($tag) {
                    return str_limit($tag->name,30, '...');
                })->implode(',');
            })
           
            ->addIndexColumn()
            ->addColumn('action', function($row){
            
            $action = '<a class="btn btn-info" id="show-user" data-toggle="modal" data-id='.$row->id.'>Show</a>
            <a class="btn btn-success" id="edit-user" data-toggle="modal" data-id='.$row->id.'>Edit </a>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <a id="delete-user" data-id='.$row->id.' class="btn btn-danger delete-user">Delete</a>';
            
            return $action;
            
            })
            ->rawColumns(['action'])
            ->make(true);
            }
            
            return view('course.course-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r=$request->validate([
            'course_title' => 'required',
            'course_intro' => 'required',
            
            ]);
            
            $courseId = $request->user_id;
            
            $course = Course::updateOrCreate(['id' => $courseId],['course_title' => $request->course_title,
                                                     'course_intro' => $request->course_intro,
                                                     
                                                    ]);
            
            $tagNames = explode(",", $request->tags);
            foreach($tagNames as $tag){
            Tag::firstOrCreate(['name' => $tag,])->save();}
            $tags = Tag::whereIn('name', $tagNames)->get()->pluck('id');
            $user = Auth::user();
            $course->user()->associate($user)->save();
            $course->tags()->sync($tags);
                                                    
                              
                                            
            if(empty($request->user_id)){
            $msg = 'Course created successfully.';
            }
            else{
            $msg = 'Course data is updated successfully';
            }
            
           
            return redirect()->route('admincourses.index')->with('success',$msg);
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where = array('id' => $id);

        $courses = Course::where($where)->with('User','tags')->first();
       
        return Response::json($courses);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $user = Course::where($where)->with('tags')->first();
        return Response::json($user);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
