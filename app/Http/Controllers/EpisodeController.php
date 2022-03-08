<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseEpisode;
use App\Course;
use App\DataTables\CoursesDataTable;
use Redirect,Response,DB,Config;
use Webpatser\Uuid\Uuid;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $episodes = CourseEpisode::with('course')->get();
            return datatables()->of($data)
            ->addColumn('course', function(CourseEpisode $episode){
                return $episode->course->course_title;
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
            
            return view('course.episode-list');
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
            'episode_title' => 'required',
            'episode_description' => 'required',
            'episode_video' => 'required|mimes:mp4,mkv,mov|max:524288',
            
            ]);
            
            $episodeId = $request->user_id;
            
            $episode = CourseEpisode::updateOrCreate(['id' => $episodeId],['episode_title' => $request->episode_title,
                                                     'episode_description' => $request->episode_description,
                                                     
                                                    ]);
            
                     
             $fileName = "episode_video-" . time() . '.' . request()->episode_video->getClientOriginalExtension();
            $request->episode_video->storeAs('episodes', $fileName);
            $episode->save();
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

        $episodes = CourseEpisode::where($where)->with('course')->first();
       
        return Response::json($episodes);
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

        $episodes = CourseEpisode::where($where)->with('course')->first();
       
        return Response::json($episodes);
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
        $r=$request->validate([
            'episode_title' => 'required',
            'episode_description' => 'required',
            'episode_video' => 'required|mimes:mp4,mkv,mov|max:524288',
            
            ]);
            
            $episodeId = $request->user_id;
            
            $episode = CourseEpisode::updateOrCreate(['id' => $episodeId],['episode_title' => $request->episode_title,
                                                     'episode_description' => $request->episode_description,
                                                     
                                                    ]);
            
                     
             $fileName = "episode_video-" . time() . '.' . request()->episode_video->getClientOriginalExtension();
            $request->episode_video->storeAs('episodes', $fileName);
            $episode->save();

                                                
                                            
            if(empty($request->user_id)){
            $msg = 'Course created successfully.';
            }
            else{
            $msg = 'Episode data is updated successfully';
            }
            
           
            return redirect()->route('episodelist.index')->with('success',$msg);
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
    public function unapprovedEpisodes(Request $request){

        $where = $where = array('isApproved' => 0);
        $episodes = CourseEpisode::where($where)->with('course')->get();
            
        return view('admin.unapproved-episodes',compact('episodes',$episodes));
    }

    public function approveEpisode(Request $request){

        $episode = CourseEpisode::find($request->episode_id);
        $episode->isApproved = $request->isApproved;
        $episode->save();
  
        return response()->json(['success'=>'User status change successfully.']);
    }
}
