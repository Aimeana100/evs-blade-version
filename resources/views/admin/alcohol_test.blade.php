@extends('admin.layoult')
@section('page_title','Visitors ')
@section('visitors_selected','active')

@section('css')

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    
@endsection

@section('content')

<div class="main-content container-fluid">
    
    <div class="page-title  bg-blue-100">
        <div class="row items-center">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Alcohol tests </h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="text-success">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> alchol  </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class=" mt-30">
        <div class="row ">


            <section>
                <div class="card mt-3 bg-blue-100">
                    <div class="card-body">
                        <table  id="table_1" class="table display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> gatename </th>
                                    <th> fullname_tested </th>
                                    <th> fullname_tester </th>
                                    <th> witness </th>
                                    <th> sn_instrument </th>
                                    <th> time </th>
                                    <th> result </th>
                                    <th> sn_instrument2 </th>
                                    <th> result2 </th>
                                    <th> smell_of_alcohol </th>
                                    <th> slurred_speech </th>
                                    <th> talkative </th>
                                    <th> unsteady_on_feet </th>
                                    <th> bloodshot_eyes </th>
                                    <th> Cooperative </th>
                                    <th> observation </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp

                                @foreach ($alcoholTest as  $item)       
                                <tr>
                                    <td> {{++$i}} </td>
                                    <td> {{ $item->gatename }} </td>
                                    <td> {{ $item->fullname_tested }} </td>
                                    <td> {{ $item->fullname_tester }} </td>
                                    <td> {{ $item->witness }} </td>
                                    <td> {{ $item->sn_instrument }} </td>
                                    <td> {{ $item->time }} </td>
                                    <td> {{ $item->result }} </td>
                                    <td> {{ $item->sn_instrument2 }} </td>
                                    <td> {{ $item->result2 }} </td>
                                    <td> {{ $item->smell_of_alcohol }} </td>
                                    <td> {{ $item->slurred_speech }} </td>
                                    <td> {{ $item->talkative }} </td>
                                    <td> {{ $item->unsteady_on_feet }} </td>
                                    <td> {{ $item->bloodshot_eyes }} </td>
                                    <td> {{ $item->Cooperative }} </td>
                                    <td> {{ $item->observation }} </td>
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




@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>


<script>






    $('#table_1').DataTable( {
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
    
     </script>
    
    
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="{{asset('user_assets/assets/js/momentjs/latest/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('user_assets/assets/css/daterangepicker/daterangepicker.min.js')}}"></script>
    
    
    
        <script>
    
    
            $(document).ready(function () {
    
    
    
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                
                today = mm + '/' + dd + '/' + yyyy;
                // document.write(today);
                
                $('input[name="daterange"]').val(today+' '+today);
    
                $(function() {
                    $('input[name="daterange"]').daterangepicker({
                        opens: 'center',
                        drops: 'down',
                        // minDate: today
                        maxDate: today
                    }, function(start, end, label) {
                        $('#start_date').val(start.format('YYYY-MM-DD'));
                        $('#end_date').val(end.format('YYYY-MM-DD'));
                
                        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                    });
                    });
    
                });
    
    
    
    
        </script>
    
    
@endsection

