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

                    @if (session('success'))
                    <div class="alert alert-success">
                        <ul>
                  
                                <li>{{ session('success') }}</li>
                           
                        </ul>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">
                        <ul>
                  
                                <li>{{ session('error') }}</li>
                           
                        </ul>
                    </div>
                    @endif
                    
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
                        {{-- <a href="" class="update" data-name="name" data-type="text" data-pk="{{ $user->id }}" data-title="Enter name">{{ $user->name }}</a> --}}

                                        @foreach ($employees as $item)
                                        <tr>
                                            <td> {{++$i}}</td>
                                            <td> 
                                                <a class="update" data-name="name" data-type="text" data-pk="{{ $item->id }}" data-title="Enter name"> {{$item->names}} </a>

                                                
                                            </td>
                                            <td> 
                                                <a class="update" data-name="name" data-type="text" data-pk="{{ $item->id }}" data-title="Enter name"> {{$item->ID_Card}}  </a>
                                                
                                            </td>
                                            <td>
                                                <a class="update" data-name="name" data-type="text" data-pk="{{ $item->id }}" data-title="Enter name"> {{$item->phone}}  </a>

                                                 </td>
                                            <td>
                                                <a class="update" data-name="name" data-type="text" data-pk="{{ $item->id }}" data-title="Enter name"> {{$item->department}}  </a>

                                                 
                                                 </td>
                                            <td> {{$item->gender}} </td>
                                            <td>
                                                <button class="text-red-400" ><i class="fa fa-ban" aria-hidden="true"></i></button>
                                            </td>
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
                    
                    </div>
                    <div class="modal-footer">
                      {{-- <button  type="button" class="btn btn-primary download-btn d-none">Download</button> --}}
                      <button  type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                    </div>
              </div>
            </div>

@endsection


@section('js')


{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
<script> $.fn.poshytip={defaults:null} </script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

<script>


$('#table1').DataTable( {
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            {
                extend: 'collection',
                className: 'custom-html-collection',
                buttons: [
                    '<h3>Export</h3>',
                    'pdf',
                    'csv',
                    'excel',
                    '<h3 class="not-top-heading">Column Visibility</h3>',
                    'colvis',
                    'colvis'
                ]
            }
        ]
    } );



 // populate request details of long view
 $(document).on('click', '.js-add', function(){
    var reqId = $(this).data('reqid');

    $("#mdl-add").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#mdl-add").modal('show');

 });


    $.fn.editable.defaults.mode = 'inline';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    }); 
  
    $('.update').editable({
           url: "{{ route('employee.update') }}",
           type: 'text',
           pk: 1,
           name: 'name',
           title: 'Enter name'
    });


    $(".deleteProduct").click(function(){
	    	$(this).parents('tr').hide();
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/employee/delete/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Delete');
	            }
	        });
	    });

</script>
    
@endsection
