<!DOCTYPE html>
<html lang="en">
    <style>
        /*.w-5
        {
            display: none;
        }*/
    </style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Data</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"  crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"  crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>



    <!-- DATATABLE LINKS START-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"  crossorigin="anonymous">
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"  crossorigin="anonymous">

    <script src=" https://code.jquery.com/jquery-3.5.1.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"  crossorigin="anonymous"></script> -->
    <!-- DATATABLE LINKS END-->


</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-left: 20px;margin-top: 20px;">
                <h5>Click To Add More Students Data
                <a href="form" class="btn btn-primary">Add</a></h5>
            </div>
        </div>
        <div>
            <h1 style="text-align: center;margin-top: 20px;margin-bottom: 20px;"><b>nbvgfcdtrfgyhbvgc</b></h1>
        </div>

        @if(session()->has('msg'))
        <div class="col-md-3  alert alert-success" id="alert" style="margin-left: auto;font-weight: bold;">
            <button class="close" data-dismiss="alert">x</button>
            {{session()->get('msg')}}
        </div> 

        @elseif(session()->has('update_message'))
        <div class="col-md-3 alert alert-success" id="update_alert" style="margin-left: auto;font-weight: bold;">
            <button class="close" data-dismiss="alert">x</button>
            {{session()->get('update_message')}}
        </div>

        @elseif(session()->has('delete_message'))
        <div class="col-md-3 alert alert-success" id="delete_alert" style="margin-left: auto;font-weight: bold;">
            <button class="close" data-dismiss="alert">x</button>
            {{session()->get('delete_message')}}
        </div>
        @endif
     

       <div class="col-md-3" style="margin-left: 1155px;margin-bottom: 10px;">
            <form action="search" method="GET" autocomplete="off">
                <div class=" form-check-inline">
                    <input type="text" class="form-control" name="search" placeholder="Search by name" style="margin-left: 10px;" value="">
                    <button type="submit" class="btn btn-success" style="margin-left: 10px;">Search</button>
                    <a href="{{url('/')}}">
                        <button class="btn btn-secondary" type="button" style="margin-left: 10px;">Reset</button>
                    </a>                    
                </div>
            </form>
        </div>
      

        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table  table-inverse table-dark" id="data">
                    <thead style="font-size: 17px;background-color: #007bff;border: 4px solid #007bff;">
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Qualification</th>
                            <th>Skills</th>
                            <th>Contact</th>
                            <th>Profile Photo</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($students_data as $student_data)
                  
                        <tr>
                            <td>@php echo $i++; @endphp</td>
                            <td>{{$student_data->id}}</td>
                            <td>{{$student_data->name}}</td>
                            <td>{{$student_data->email}}</td>
                            <td>{{$student_data->gender}}</td>
                            <td>{{$student_data->age}}</td>
                            <td>{{$student_data->qualification}}</td>
                            <td>{{$student_data->skills}}</td>            
                            <td>{{$student_data->contact}}</td>
                            <td>
                                @php
                                $img = $student_data['image'];
                                $img1 = asset('images/'.$img);
                                
                                if(is_null($img))
                                {
                                    $img2=asset('images/user_avtar3.jfif');
                                                                                                   
                                }else{
                                    $img2 = asset('images/'.$img);
                                }
                                @endphp                            
                                <img src="{{ $img2 }}" alt="profile photo" width="100px" height="100px" style="border-radius:60px ;">                          
                            </td>
                            <td><a href="/delete/{{$student_data->id}}" class="btn btn-danger" style="margin-top: 30px;" >Delete</a></td>
                            <td><a href="/edit/{{$student_data->id}}" class="btn btn-info" style="margin-top: 30px;">Edit</a></td>
                        </tr>
                        
                        @endforeach
                        @php  
                        $i++;
                        @endphp
                        
                    </tbody>
                </table>
                {{ $students_data->render() }}
            </div>
        </div>
    </div>


    <script>

        var str = "hello";
        var number = 1;
        var numbers = [1,2,3];



        // for($i = 0; $i < str.length; $i++ ){
        //     if(str[$i] == 'h'){
        //         console.log(str[$i].toUpperCase(str[$i]));
        //     }else{
        //         console.log(str[$i]);
        //     }
        // }

        for($i = 0; $i < str.length; $i++ ){
            if(str[$i] == 'h'){
                console.log(str[$i].toUpperCase(str[$i]));
            }else{
                console.log(str[$i]);
            }
        }
        // $('document').ready(function() {
        //     setTimeout(function() {
        //         $('#alert').remove();
        //     },3000);

        // //$('#data').DataTable();

        // });

        // setTimeout(function() {
        //     $('#update_alert').remove();
        // },3000);

        // setTimeout(function() {
        //     $('#delete_alert').remove();
        // },3000);
    </script>

</body>
</html>