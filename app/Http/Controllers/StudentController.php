<?php

namespace App\Http\Controllers;

use App\Models\new_student;
use Illuminate\Http\Request;
use GuzzleHttp;
//use GuzzleHttp\Client;

use Illuminate\Support\Facades\File;
use Twilio\Rest\Client;


class StudentController extends Controller
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
            'name' => ['required', 'alpha'],
            'email' => ['required','email'],
           'gender' => ['required'],
           'age' => ['required','numeric'],
            'qualification' => ['required'],
            'skills' => ['required'],
            'contact' => ['required','digits:10','numeric'],
            'image' => ['image'],
            
            'gender' => ['required'],
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


    public function search(new_student $new_student, Request $request )
    {
         $std=new_student::paginate(3);
    //    // $search=$request['search'] ?? "";
    //    // dd($search);
    //    //$search=$request->get('search');
        //  if(!empty($request->search))
        // {
            $search= $request->search;
            $std=new_student::where('name', 'LIKE', '%'.$request->search.'%')->paginate(3);
            //echo $std;
            //print_r($std);
        //    $std=new_student::where('name', 'LIKE', '%'.$search.'%')->get();
        // }
         //$std=new_student::paginate(3);
 
    
        return view('students_data',['students_data'=>$std]);
    }



    public function show(new_student $new_student, Request $request )
    {
  
          $std=new_student::paginate(3);
    
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

    public function send()
    {
       // echo "test";

       $json = [
              'token'=> '1cea1c9b02c4447588a8a91e1935c950',
              'source'=> 9833074828,
              'destination'=> 9967407118,
              'type'=> 'text',
              'body'=>[
                'text'=> 'laravel'
              ]
            ];

            //echo json_encode($json);
            $client = new GuzzleHttp\Client();
            $response = $client->request('POST','http://waping.es/api/send',
            ['headers'=>['Content-Type'=>'application/json'],
            'json'=>$json
            ]
        );

        echo $response->getStatusCode."<br>";
        echo $response->getBody();
    }

    public function form()
    {    
        return view('whatsapp_form');
    }

    public function messageSendform()
    {    
        return view('message_send_form');
    }

    public function emailForm()
    {  
        echo "hello";  
        //return view('email_form');
    }

    public function messagestore(Request $request)
    {    
        try{
            $account_sid = env('TWILIO_SID');
            $account_token = env('TWILIO_TOKEN');
            $number = env('TWILIO_FORM');

            $client = new Client($account_sid,$account_token);
            $client->messages->create('+91'.$request->number,[
                'from' => $number,
                'body' => $request->message,
            ]);

           return "Message sent.........";
        }catch(\Exception $th){
            return $th->getMessage();
        }
    }

    public function loops()
    {  
        //1
            // for($i = 1; $i <= 5; $i++){
            //     for($j = 1; $j <= 5; $j++){
            //         echo "*";
            //     }
            //     echo "<br/>";
            // }
            // *****
            // *****
            // *****
            // *****
            // *****

        //2
            // for($i = 1; $i <= 5; $i++){
            //     for($j = 5; $j >= $i; $j--){
            //         echo "*";
            //     }
            //     echo "<br/>";
            // }

            // *****
            // ****
            // ***
            // **
            // *

        //3
            // for($i = 1; $i <= 5; $i++){
            //     for($j = 1; $j <= $i; $j++){
            //         echo "*";
            //     }
            //     echo "<br/>";
            // }
            // *
            // **
            // ***
            // ****
            // *****

        //4
            // for($i = 5; $i >= 1; $i--){
            //     for($j = 1; $j <= 5-$i; $j++){
            //         echo "&nbsp&nbsp";
            //     }
            //     for($k = 1; $k <= $i; $k++){
            //         echo "*";
            //     }
            //     echo "<br/>";
            // }
                // *****
                //  ****
                //   ***
                //    **
                //     *

            //5
                // for($i = 5; $i >= 1; $i--){
                //     for($j = 1; $j <= 5-$i; $j++){
                //         echo "&nbsp";
                //     }
                //     for($k = 1; $k <= $i; $k++){
                //         echo "*";
                //     }
                //     echo "<br/>";
                // }


            //    for($i = 1; $i <= 5; $i++){
            //         for($j = 1; $j <= 5-$i; $j++){
            //             echo "&nbsp";
            //         }
            //         for($k = 1; $k <= $i; $k++){
            //             echo "*";
            //         }
            //         echo "<br/>";
            //     }


            // $rows = 5; // Number of rows in the pyramid

            // for ($i = 1; $i <= $rows; $i++) {
            //     // Print spaces
            //     for ($j = 1; $j <= $rows - $i; $j++) {
            //         echo "&nbsp";
            //     }
            //     // Print asterisks
            //     for ($k = 1; $k <= 1 * $i - 1; $k++) {
            //         echo "*";
            //     }
            //     echo "<br/>";
            // }

            $a = 10;
            //$b = $a++ + $a++;
            // echo $a++;
            // echo $a;

            // echo "<br>";
            // echo "<br>";

            $test = "my name is kiran";
            $length = strlen($test);
            $names = ['a','e','i','o','u'];
            $count = 0;

            for($i = 0; $i < $length; $i++){
                if(in_array($test[$i],$names) )
                {
                    $count++;
                  ///  echo $test[$i] . "\n"."<br/>";
                }
                
            }
           // echo $count;




        //    function reverstring($number){
        //         $convert_string = (string)$number;

        //         $reversstr = strrev($number);

        //         $text = "abc";
        //         $conver_ro_int = (int)$text;
        //         echo $convert_string ;
        //         echo "<br/>";
        //         echo "<br/>";

        //         echo $reversstr ;
        //         echo "<br/>";
        //         echo "<br/>";

        //         echo $conver_ro_int ;

        //    }

        //    $number = 123456;
        //    reverstring($number);
        //    echo "<br/>";
        //    echo "<br/>"; echo "<br/>";
        //    echo "<br/>";

        //     $number1 = 123456;
        //     $numberStr = (string) $number1;
        //     echo $numberStr;

        // $array = [10,20,15,63,89,54];

        // //$lenght = strlen($arr);

        // $max = $array[0];
        // foreach($array as $num){
        //     if($num > $max){
        //         $max = $num;
        //     }
        // }
        // echo $max;



        //   $rows = 6; // Number of rows in the pyramid

        //     for ($i = 1; $i <= $rows; $i++) {
        //         // Print spaces
        //         for ($j = 1; $j <= $rows - $i; $j++) {
        //             echo "a";
        //         }
        //         // Print asterisks
        //         for ($k = 1; $k <= 1 * $i - 1; $k++) {
        //             echo "*";
        //         }
        //         echo "<br/>";
        //     }



            // $row = 6;

            // for ($i = 1; $i <= $row; $i++){
                
            //     for($j = 1; $j <= $row - $i; $j++){

            //         echo "&nbsp";
            //     }

            //     for($k = 1; $k <= 1 * $i - 1; $k++){
            //         echo "*";
            //     }
            //     echo "<br/>";
            // }

            for($i = 1; $i <= 5; $i++){
                for($j = 1; $j <= 5; $j++){
                    echo "*";
                }
                echo "<br/>";
            }

           
                
    }

   

}
