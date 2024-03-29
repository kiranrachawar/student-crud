<!doctype html>
<html>
    <head>
        <title>Student Form</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"  crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
  
        
        <!-- FOR MULTISELECT DROPDOWN NECESSORY CDN LINK -->
            <link rel="stylesheet" href="http://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
        <!-- FOR MULTISELECT DROPDOWN NECESSORY CDN LINK -->

    </head>

    <style>
    .center {
  margin: auto;
  margin-top: 50px;
  width: 38%;
  padding: 10px;
  border-radius: 10px;
  background-color: white; 
}
</style>
    <body style="background: linear-gradient(to right, #fc2c77 0%, #6c4079 100%);">
        <!-- <div class="container"> -->
            <div class="row center mb-5">
                <div class="col-md-12">
                    <form action="/update/{{$students_fetch->id}}" class="ml-5 mb-5 mt-3" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-11">
                            <h2 class="text-center"><b>UPDATE STUDENT FORM</b></h2>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for=""><b>Name</b></label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$students_fetch->name}}">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for=""><b>Email</b></label>
                                <input type="text" name="email" class="form-control" placeholder="Email" value="{{$students_fetch->email}}">
                            </div>
                        </div>


                        <!-- <div class="col-md-11">
                            <div class="form-group">
                                <label for=""><b>Gender</b></label>
                                <input type="text" name="gender" class="form-control" placeholder="Gender" value="{{$students_fetch->gender}}">
                            </div>
                        </div> -->

                        <div class="col-md-11">
                            <div class="">
                                <label for=""><b>Gender</b></label> 
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" class="form-check-input" value="Male" {{ $students_fetch->gender == 'Male' ? 'checked' : ''}}>
                                    <label for="" class="form-check-label"><b>Male</b></label>   
                                </div>
                                <div class="form-check form-check-inline"> 
                                    <input type="radio" name="gender" class="form-check-input" value="Female" {{$students_fetch->gender == 'Female' ? 'checked' : ''}}>
                                    <label for="" class="form-check-label"><b>Female</b></label>
                                </div>
                                <div class="form-check form-check-inline"> 
                                    <input type="radio" name="gender" class="form-check-input" value="Other" {{$students_fetch->gender == 'Other' ? 'checked' : ''}}>
                                    <label for="" class="form-check-label"><b>Other</b></label>
                                </div>
                             </div>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <label for=""><b>Age</b></label>
                                <input type="text" name="age" class="form-control" placeholder="Age" value="{{$students_fetch->age}}">
                            </div>
                        </div>

                      
                         
                        <!-- TO FETCH SINGLE VALUE OF DROPDOWN -->
                        <!-- <div class="col-md-11">
                            <div class="form-group">
                                <label for=""><b>Qualification</b></label>
                                <select class="form-control" name="qualification[]" multiple="multiple">
                                    <option value="">Please Select Qualification</option>
                                    <option value="B.E." {{$students_fetch->qualification == 'B.E.' ? 'selected' : ''}}>B.E.</option>
                                    <option value="M.C.A." {{$students_fetch->qualification == 'M.C.A.' ? 'selected' : ''}}>M.C.A.</option>
                                    <option value="M.B.A." {{$students_fetch->qualification == 'M.B.A.' ? 'selected' : ''}}>M.B.A.</option>
                                    <option value="Diploma" {{$students_fetch->qualification == 'Diploma' ? 'selected' : ''}}>Diploma</option>
                                </select>
                            </div>
                        </div> -->



                        @php 
                        $value= $students_fetch['skills'];
                        $newvalue=explode(' , ' , $value);

                        $qualification=$students_fetch['qualification'];
                        $qualification_fetch=explode(' , ' , $qualification);
          
                        @endphp

                        <!-- TO FETCH MULTIPLE VALUE OF DROPDOWN -->
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for=""><b>Qualification</b></label>
                                <select id="qualification" class="form-control" name="qualification[]" multiple="multiple">
                                    <!-- <option value="">Please Select Qualification</option> -->
                                    <option value="B.E." @if(in_array('B.E.',$qualification_fetch)) selected @endif >B.E.</option>
                                    <option value="M.C.A." @if(in_array('M.C.A.',$qualification_fetch)) selected @endif>M.C.A.</option>
                                    <option value="M.B.A." @if(in_array('M.B.A.',$qualification_fetch)) selected @endif>M.B.A.</option>
                                    <option value="Diploma" @if(in_array('Diploma',$qualification_fetch)) selected @endif>Diploma</option>
                                </select>
                            </div>
                        </div>
                     

                        <div class="col-md-11">
                            <div class="form-group">
                                <div>
                                    <label for=""><b>Skills</b></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]" class="form-check-input" value="PHP" @if(in_array('PHP',$newvalue)) checked @endif >
                                    <label for="" class="form-check-label">PHP</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]"  class="form-check-input" value="JAVA" @if(in_array('JAVA',$newvalue)) checked @endif >
                                    <label for="" class="form-check-label">JAVA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]"  class="form-check-input" value="PYTHON" @if(in_array('PYTHON',$newvalue)) checked @endif >
                                    <label for="" class="form-check-label">PYTHON</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]"  class="form-check-input" value="C#" @if(in_array('C#',$newvalue)) checked @endif >
                                    <label for="" class="form-check-label">C#</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]"  class="form-check-input" value="Any Other" @if(in_array('Any Other',$newvalue)) checked @endif >
                                    <label for="" class="form-check-label">Any Other</label>
                                </div>    
                            </div>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <label for=""><b>Contact</b></label>
                                <input type="text" name="contact" class="form-control" placeholder="Contact" value="{{$students_fetch->contact}}">
                            </div>
                        </div>
                        @php
                        $img=$students_fetch['image'];
                        $img1=asset('images/'.$img);
                        if($img == "")
                        {
                            $img2=asset('images/user_avtar3.jfif');
                        }else{
                            $img2=asset('images/'.$img);
                        }
                        @endphp

                        <div class="col-md-11">
                            <div class="form-group">
                                <input type="hidden" name="selected_image" value="{{ $img2 }}">
                                <img src="{{ $img2 }}" alt="profile photo"  width="100px" height="100px" style="border-radius:60px ;">
                                <!-- <label for=""><b>Image</b></label> -->
                                <input type="file" name="image" class="form-control" placeholder="image" value="upload">
                            </div>
                        </div>

                        <div class="col-md-11" style="margin-top:30px;margin-left: -4px;">
                        <center>
                            <input type="submit" value="SUBMIT" class="btn btn-primary btn-lg" style="border-radius: 25px;
                            width: 130px;font-weight: bold; background-color: #2dab0e;border-color: #2dab0e;
                            color: #FFF;font-size: 17px;margin-right: 15px;">
                            <input type="button" value="CANCEL" onclick="window.location.href='/';" 
                            class="btn btn-danger btn-lg" style="border-radius: 25px;width: 130px;font-weight: bold;font-size: 17px;">
                        </center>
                        </div>
                    </form>
                </div>
            </div>
        <!-- </div> -->
    </body>
</html>

<script>

    // FOR MULTISELECT DROPDOWN NECESSORY CODE START
        $(document).ready(function() 
        {
            $('#qualification').multiselect({
                includeSelectAllOption: true,  
                buttonClass:'form-control',
                nonSelectedText: 'Please Select Qualification',
                buttonWidth: '421px',
                enableFiltering:true,
            });
            $('.multiselect-search ').css({"margin-left": "-7px","width":"421px"});
            $('.multiselect-container').css("width","421px");

        });

    // FOR MULTISELECT DROPDOWN NECESSORY CODE END

</script>








