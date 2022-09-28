@extends('admin.layoult')
@section('page_title','Employees')
@section('empolyees_selected','active')


@section('content')



<div class="main-content container-fluid">
    
    <div class="page-title bg-blue-100">
        <div class="row items-center">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Employees </h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="text-success">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Employee  </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


      <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active " id="personal-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            <div style="" class=" mt-30">
                <div class="row">

                    
                        <div class=" relative flex justify-end px-10 max-w-7xl w-2/5">
                            <a  href=""  data-toggle="modal" 
                            class="bg-lime-100  text-Teal-700
                              btn-flat js-view text-black font-monospace
                              btn  btn-sm p-2  mx-10 text-[22px]
                               display-3 btn-primary js-add 
                            
                            ">
                            <i class="fa fa-plus fa-5x"></i> Add </a>

                         </div> 
                   

                    {{-- <section class="section"> --}}

                        <div class="card mt-3 ">
                            <div class="card-body">
                                <table  id="table1" class="table display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Names </th>
                                            <th> Card number </th>
                                            <th> Phone </th>
                                            <th> Departement </th>
                                            <th> Gender </th>
                                            <th> tools </th> 
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $i = 0;
                                        @endphp

                                        @foreach ($employees as $item)
                                        <tr>
                                            <td> {{++$i}}</td>
                                            <td> {{$item->names}}</td>
                                            <td> {{$item->ID_Card}} </td>
                                            <td> {{$item->phone}} </td>
                                            <td> {{$item->department}} </td>
                                            <td> {{$item->gender}} </td>
                                            <td></td>
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

      </div>

    
</div>




        {{-- Modal  --}}

        <div id="mdl-add" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content card">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle"> Add staff </h5>
                      <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="card-body modal-body">

                        <form action="{{route('employee.upload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h1 class="text-center"> Upload xls file  </h1>
                            <input type="file" name="file" class="form-control" id="file" accept=".xlsx, .xls, .csv" required>
                            <button class="w-full max-w-sm mx-10 p-2 text-emerald-700 mt-4  bg-[#5797CC] btn-primary" type="submit">  Upload </button>
                        </form>

                        <hr>

                        


                        <form class="form" id="frmProfile" 
                        action="{{route('admin.update.acount')}}"
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

                                <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="card_id">ID number</label>
                                        <div class="position-relative">
                                            <input name="card_id" type="card_id" class="form-control rounded" id="card_id" value="" required>
                                            <div class=" form-control-icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="phone">  Phone </label>
                                        <div class="position-relative">
                                            <input name="phone" type="text" class="form-control rounded"  id="phone" value="">
                                        </div>
                                    </div>
                                </div>
                                                           
                                <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="departement"> Departement </label>
                                        <div class="position-relative">
                                            <fieldset class="form-group">
                                                <select name="departement" class="form-select" id="departement">
                                                    <option value=""> -- Select -- </option>

                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                                           
                                <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="gender"> Position </label>
                                        <div class="position-relative">
                                            <fieldset class="form-group">
                                                <select name="gender" class="form-select" id="gender">
                                                    <option value=""> -- Select -- </option>

                                                </select>
                                            </fieldset>
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

@endsection

@section('js')

<script>

 // populate request details of long view

 $(document).on('click', '.js-add', function(){
    var reqId = $(this).data('reqid');

    $("#mdl-add").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#mdl-add").modal('show');

 });


</script>
    
@endsection
