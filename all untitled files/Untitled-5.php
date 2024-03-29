<?php

namespace App\Http\Controllers;

use App\Models\new_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validate=$request->validate([
            //'name' => ['required', 'alpha'],
            //'email' => ['required','email'],
            //'gender' => ['required'],
            //'age' => ['required','numeric'],
            'qualification' => ['required'],
            'skills' => ['required'],
            //'contact' => ['required','digits:10','numeric'],
            'image' => ['image'],
            
            //'gender' => ['required'],
        ]);
        $std=new new_student;
        //return $request->input();
        $std->name=$request->get('name');
        $std->email=$request->get('email');
        $std->gender=$request->get('gender');
        $std->age=$request->get('age');
       // $std->qualification=$request->get('qualification');
       // $std->skills=$request->get('skills');
       $std->qualification=implode(' , ' , $request->get('qualification'));
       $std->skills=implode(' , ' , $request->get('skills'));
        //$std->skills=json_encode($request->get('skills'));
        $std->contact=$request->get('contact');
        // $std->image=$request->get('image');

        if($request->hasfile('image'))
        {
           // $file1 = $request->get('image');
            
            $file = $request->file('image');
            // $file2=$file->originalName();
            // dd($file2);
            //$extention = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            //dd($name);
            $filename = $name;
            $file->move('images/',$filename);
            $std->image=$filename;
        }

        $std->save();
       //toastr.success('ok');
       //$request->session()->put('msg','data');
        return redirect("/")->with('msg','Students Data Submitted Successfully');
        //return redirect("/");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\new_student  $new_student
     * @return \Illuminate\Http\Response
     */
    public function show(new_student $new_student, Request $request )
    {
        $std=new_student::paginate(3);
       // $search=$request['search'] ?? "";
       // dd($search);
       //$search=$request->get('search');
         if(!empty($request->search))
        {
            echo $request->search;
            $std=new_student::where('name', 'LIKE', '%'.$request->search.'%')->get();
            echo $std;
            print_r($std);
        //    $std=new_student::where('name', 'LIKE', '%'.$search.'%')->get();
         }
         else{
            $std=new_student::paginate(3);
         }
        //  $std=$std->paginate();
        //  $std=new_student::all();
         // $std=new_student::paginate(3);
    
        return view('students_data',['students_data'=>$std]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\new_student  $new_student
     * @return \Illuminate\Http\Response
     */
    public function edit(new_student $new_student,$id)
    {
        $std=new_student::find($id);
        return view('students_edit',['students_fetch'=>$std]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\new_student  $new_student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, new_student $new_student,$id)
    {
        $std=new_student::find($id);
        $std->name=$request->get('name');
        $std->email=$request->get('email');
        $std->gender=$request->get('gender');
        $std->age=$request->get('age');
        //$std->qualification=$request->get('qualification');
        $std->qualification=implode(' , ' , $request->get('qualification'));
        $std->skills=implode(' , ' , $request->get('skills'));
        $std->contact=$request->get('contact');
        
        $destination='images/'.$std->image;
        // if(File::exists($destination))
        // {
        //     File::delete($destination);
        // }
         if($request->hasfile('image'))
        {
            $file = $request->file('image');
            // $extention = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
             $filename = $name;
             $file->move('images/',$filename);
             $std->image=$filename;
            
        }   

       

        $std->save();
       return redirect("/")->with('update_message','Students Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\new_student  $new_student
     * @return \Illuminate\Http\Response
     */
    public function destroy(new_student $new_student,$id)
    {
        $std=new_student::find($id);
        $destination = 'images/'.$std->image;
        // if(File::exists($destination))
        // {
        //     File::delete($destination);
        // }
        $std->delete();
        return redirect('/')->with('delete_message','Students Data Deleted Successfully');
    }
}
