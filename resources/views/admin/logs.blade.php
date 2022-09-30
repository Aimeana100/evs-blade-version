@extends('admin.layoult')
@section('page_title','Employees')
@section('logs_selected','active')

@section('content')

<div class="main-content container-fluid">
    
    <div class="page-title bg-blue-100">
        <div class="row items-center px-4">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> User Logs</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="text-success">Dashboard</a></li>
                        <li class="breadcrumb-item " aria-current="page"> <a href="{{route('admin.users')}}" class="text-success">Users</a>   </li>
                        <li class="breadcrumb-item active" aria-current="page">  logs  </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


      <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active"
         id="personal-tab-pane"
         role="tabpanel" 
         aria-labelledby="home-tab" 
         tabindex="0">

            <div style="" class=" mt-30">
                <div class="row">

                    
                       
                   

                    <section class="section">

                        <div class="card mt-3 ">
                            <div class="card-body">
                                <table  id="table1" class="table display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> User name </th>
                                            <th> Logged at  </th>
                                            <th> tools </th> 
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $i = 0;
                                        @endphp

                                        @foreach ($logs as $item)
                                        <tr>
                                            <td> {{++$i}}</td>
                                            <td> {{$item->names}}</td>
                                            <td> {{$item->time}} </td>
                                            <td></td>
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
