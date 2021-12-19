<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crayon</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            #alert-container{
                position: absolute;
                top:10px;
                right:10px;
                display: none;
                z-index: 2000;
            }
        </style>
    </head>
    <body>
    <div id="alert-container">
       <div id="alert" class="alert alert-primary" role="alert">
        </div>
       </div>
       <div>
       <div class="container mt-5">
        <!-- Content here -->

        <div class="d-flex justify-content-between">
            <h4>List of Users</h4>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" >Add</button>
        </div>

        <table class="table mt-3 table-bordered">
            <thead class="bg-light">
                <tr>
                <th >S.N</th>
                <th >Name</th>
                <th >Address</th>
                <th >Email</th>
                <th >Phone</th>
                <th >Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userArray as $key=>$user)
                <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td class="d-flex " >
                <button type="button" class="btn btn-primary" onclick="getUserData(<?php echo $user->id; ?>)" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
       </div>


       <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- {{$errors}} -->
                <form class="row g-3" id="userform">
                {{ csrf_field() }}
                    <div class="form-group row mt-3">
                        <label for="name" >Name *</label>
                        <input type="text"  class="form-control" name="name" id="name" value="">
                    </div>
                   
                    <div class="form-group row mt-3">
                        <label for="name" >Email *</label>
                        <input type="email"  class="form-control" name="email" id="email" value="">
                    </div>

                    <div class="form-group row mt-3">
                        <label for="name" >Phone *</label>
                        <input type="number"  class="form-control" name="phone" id="phone" value="" min="10">
                    </div>

                    <div class="form-group row mt-3">
                        <label for="address" >Address *</label>
                        <textarea name="address" id="address"></textarea>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" class="btn btn-primary mb-3" rows="10" name="save">Save</button>
                    </div>
                </form>
                </div>
                
                </div>
            </div>
        </div>




        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- {{$errors}} -->
                <form class="row g-3" id="usereditform">
                {{ csrf_field() }}
                    <div class="form-group row mt-3">
                        <label for="name" >Name *</label>
                        <input type="hidden"  class="form-control" name="user_id" id="edit_id" value="">
                        <input type="text"  class="form-control" name="name" id="edit_name" value="">
                    </div>
                   
                    <div class="form-group row mt-3">
                        <label for="name" >Email *</label>
                        <input type="email"  class="form-control" name="email" id="edit_email" value="">
                    </div>

                    <div class="form-group row mt-3">
                        <label for="name" >Phone *</label>
                        <input type="number"  class="form-control" name="phone" id="edit_phone" value="" min="10">
                    </div>

                    <div class="form-group row mt-3">
                        <label for="address" >Address *</label>
                        <textarea name="address" id="edit_address"></textarea>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" class="btn btn-primary mb-3" rows="10" name="save">Save</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function(){
                $('#userform').on('submit',function(event){
                event.preventDefault();
                $.ajax({
                    type:"POST",
                    url:"/useradd",
                    data:$('#userform').serialize(),
                    success: function(response){
                    $('input').css('border','1px solid #ccc');
                    $('textarea').css('border','1px solid #ccc');
                    $('#alert').removeClass('alert-danger');
                    $('#alert').addClass('alert-primary');
                    $('#alert-container').css('display','block');
                    $('#alert').text('Data Added Successfully!');
                    $('input').val("");
                    $('textarea').val("");
                    $('#exampleModal').modal('hide');
                    $('#alert-container').delay(1000).fadeOut('slow');
                    setTimeout(function(){
                        location.reload();
                    },1500)
                    },
                    error: function(error){
                   let flieds = error.responseJSON.errors;
                   //console.log(flieds);
                   $('#alert').text('Somthing went wrong!');
                   $('input').css('border','1px solid #ccc');
                   $('textarea').css('border','1px solid #ccc');
                    $('#alert-container').css('display','block');
                    $('#alert').removeClass('alert-primary');
                    $('#alert').addClass('alert-danger');
                    key = Object.keys(flieds);
                    key.map((e)=>{
                     return   $('#alert').append(`<br/> ${e} : ${flieds[e]}`);
                    });
                    key.map((e)=>{
                    return  $(`#${e}`).css('border','1px solid red');
                    });
                    }
                });
                
                })
            })


            const getUserData = (id) =>{
                $.get(`useredit/${id}`,function(data){
                    $('#edit_id').val(data.id);
                    $('#edit_name').val(data.name);
                    $('#edit_email').val(data.email);
                    $('#edit_phone').val(data.phone);
                    $('#edit_address').val(data.address);
                })
            }



            $(document).ready(function(){
                $('#usereditform').on('submit',function(event){
                event.preventDefault();
                $.ajax({
                    type:"PUT",
                    url:"/userupdate",
                    data:$('#usereditform').serialize(),
                    success: function(response){
                    $('input').css('border','1px solid #ccc');
                    $('textarea').css('border','1px solid #ccc');
                    $('#alert').removeClass('alert-danger');
                    $('#alert').addClass('alert-primary');
                    $('#alert-container').css('display','block');
                    $('#alert').text('Data Updated Successfully!');
                    $('input').val("");
                    $('textarea').val("");
                    $('#exampleModal').modal('hide');
                    $('#alert-container').delay(1000).fadeOut('slow');
                    setTimeout(function(){
                        location.reload();
                    },1500)
                    },
                    error: function(error){
                 let flieds = error.responseJSON.errors;
                   $('#alert').text('Somthing went wrong!');
                   $('input').css('border','1px solid #ccc');
                   $('textarea').css('border','1px solid #ccc');
                    $('#alert-container').css('display','block');
                    $('#alert').removeClass('alert-primary');
                    $('#alert').addClass('alert-danger');
                    key = Object.keys(flieds);
                    key.map((e)=>{
                     return   $('#alert').append(`<br/> ${e} : ${flieds[e]}`);
                    });
                    key.map((e)=>{
                    return  $(`#edit_${e}`).css('border','1px solid red');
                    });


                    }
                });
                
                })
            })

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
