@extends('admin.layoult')
@section('page_title','Employees')
@section('users_selected','active')


@section('content')


<div class="main-content container-fluid">
    
    <div class="page-title bg-blue-100">
        <div class="row items-center">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> User </h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="text-success">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> User  </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-users-tab" data-bs-toggle="tab" data-bs-target="#nav-users" type="button" role="tab" aria-controls="nav-users" aria-selected="true">users</button>
          <button class="nav-link" id="nav-security-tab" data-bs-toggle="tab" data-bs-target="#nav-security" type="button" role="tab" aria-controls="nav-security" aria-selected="false">security</button>
       </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-users" 
        role="tabpanel" aria-labelledby="nav-users-tab" tabindex="0">


            <div style="" class=" mt-30">
                <div class="row">

                    
                        <div class=" relative flex justify-end px-10 max-w-7xl w-2/5">
                            <a  href=""  data-toggle="modal" 
                            class="bg-lime-100  text-Teal-700
                              btn-flat js-view text-black font-monospace
                              btn  btn-sm p-2  mx-10 text-[22px]
                               display-3 btn-primary js-add-users
                               mr-24
                            
                            ">
                            <i class="fa fa-plus fa-3x"></i> 
                            Add User
                        </a>

                         </div> 
                   

                    {{-- <section class="section"> --}}

                        <div class="card mt-3 ">
                            <div class="card-body">
                                <table  id="table1" class="table display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Name </th>
                                            {{-- <th> Card number </th> --}}
                                            <th> Email </th>
                                            <th> Password </th>
                                            <th> tools </th> 
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($users as $item)
                                        <tr>
                                            <td> {{++$i}} </td>
                                            <td> {{$item->name}}</td>
                                            {{-- <td> {{$item->ID_Card}} </td> --}}
                                            <td> {{$item->email}} </td>
                                            <td> ** </td>
                                            <td> <a href=""> <button class="btn btn-sm"> reset </button> </a> </td>
                                        </tr>
                                            
                                        @endforeach
                
                                    </tbody>
                                </table>
                
                
                            </div>
                        </div>
                    {{-- </section> --}}


                    </div>
            </div>

        </div>
        <div class="tab-pane fade" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab" tabindex="0"> 
        
            
            <div style="" class=" mt-30">
                <div class="row">
                        <div class=" relative flex justify-end px-10 max-w-7xl w-2/5">
                            <a  href=""  data-toggle="modal" 
                            class="bg-lime-100  text-Teal-700
                              btn-flat js-view text-black font-monospace
                              btn  btn-sm p-2  mx-10 text-[22px]
                               display-3 btn-primary js-add-security
                               mr-24
                            ">
                            <i class="fa fa-plus fa-5x"></i> 
                            Add Security guard
                        </a>

                         </div> 
                   

                    <section class="section">

                        <div class="card mt-3 ">
                            <div class="card-body">
                                <table  id="table1" class="table display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Name </th>
                                            {{-- <th> Card number </th> --}}
                                            <th> Email </th>
                                            <th> Password </th>
                                            <th> Status </th>
                                            <th> tools </th> 
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($gateKeeper as $item)
                                        <tr>
                                            <td> {{++$i}} </td>
                                            <td> {{$item->names}}</td>
                                            {{-- <td> {{$item->ID_Card}} </td> --}}
                                            <td> {{$item->username}} </td>
                                            <td> ** </td>
                                            <td>  {{ $item->status ? "Active" : "Not" }} </td>
                                            <td> <a href=""> <button class="btn btn-sm"> reset </button> </a> </td>
                                        </tr>
                                            
                                        @endforeach
                
                                    </tbody>
                                </table>
                
                
                            </div>
                        </div>
                    </section>


                    </div>
            </div>
        
        </div>
        </div>




      </div>



        {{-- Modal  --}}


        <div id="mdl-add-users" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content card">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle"> Add a User </h5>
                      <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="card-body modal-body">

                        <form class="form" id="frmProfile" 
                        action="{{route('admin.users.create')}}"
                         method="POST">
                            @csrf

                            <div class="row ">

                                <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="names"> Names </label>
                                        <div class="position-relative">
                                            <input name="names" type="text" class="form-control rounded" placeholder="John doe" id="names" value="" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="card_id">ID number</label>
                                        <div class="position-relative">
                                            <input name="card_id" type="card_id" class="form-control rounded" id="card_id" value="" >
                                            <div class=" form-control-icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="email">  Email | Username </label>
                                        <div class="position-relative">
                                            <input name="email" type="email" 
                                            class="form-control rounded"
                                              id="email" value="" required>
                                        </div>
                                    </div>
                                </div>
 
                            </div>

                            <div class="row mt-3">
                                <input type="hidden" id="id" name="id" value="">
                                <div class="col-12 d-flex  justify-content-center">
                                    <button id="frmUpdate" type="submit" class="btn btn-primary me-1 mb-1"> Add </button>
                                </div>
                            </div>

                             
                             <div id="update-messages">
                             </div>

                        </form>
                    
                    </div>
                    <div class="modal-footer">
                      {{-- <button  type="button" class="btn btn-primary download-btn d-none">Download</button> --}}
                      <button  type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                    </div>
              </div>
            </div>
        </div>



        <div id="mdl-add-security" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content card">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle"> Add a User </h5>
                      <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="card-body modal-body">

                        <form class="form" id="frmProfile" 
                        action="{{route('admin.security.create')}}"
                         method="POST">

                            @csrf

                            <div class="row ">

                                <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="names"> Names </label>
                                        <div class="position-relative">
                                            <input name="names" type="text" class="form-control rounded" placeholder="John doe" id="names" value="" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="card_id">ID number</label>
                                        <div class="position-relative">
                                            <input name="card_id" type="card_id" class="form-control rounded" id="card_id" value="" >
                                            <div class=" form-control-icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="email">  Email | Username </label>
                                        <div class="position-relative">
                                            <input name="email" type="email" 
                                            class="form-control rounded"
                                              id="email" value="" required>
                                        </div>
                                    </div>
                                </div>
 

                            </div>

                            <div class="row mt-3">
                                <input type="hidden" id="id" name="id" value="">
                                <div class="col-12 d-flex  justify-content-center">
                                    <button id="frmUpdate" type="submit" class="btn btn-primary me-1 mb-1"> Add </button>
                                </div>
                            </div>

                             
                             <div id="update-messages">
                             </div>

                        </form>
                    
                    </div>
                    <div class="modal-footer">
                      {{-- <button  type="button" class="btn btn-primary download-btn d-none">Download</button> --}}
                      <button  type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                    </div>
              </div>
            </div>
        </div>

@endsection

@section('js')

<script>


 $(document).on('click', '.js-add-users', function(){
    var reqId = $(this).data('reqid');

    $("#mdl-add-users").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#mdl-add-users").modal('show');

 });
 
 
 $(document).on('click', '.js-add-security', function(){
    var reqId = $(this).data('reqid');

    $("#mdl-add-security").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#mdl-add-security").modal('show');

 });
 

</script>
    
@endsection
