@extends('admin.layoult')
@section('page_title','Employee attendance')
@section('empolyees_attendance_selected','active')

@section('content')


<div class="main-content container-fluid">
    
    <div class="page-title mx-2 bg-blue-100">
        <div class="row items-center">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Employees Attendance </h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="text-success">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> attendance  </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


        <div class=" mt-30">
                <div class="row ">

                    <div class="search mt-2 ">

                        <form class="bg-slate-200 rounded border  border-gray-500" action="" method="GET">
                            <div class="flex row justify-center m-3 ">

                                <div class="col-5">
                                    <label for="">
                                        Departement
                                    </label>
                                    <select class="form-control" name="departement" id="departement">
                                        <option value=""> -- <small> select </small> -- </option>
                                        @foreach ($depts as $dept)

                                        <option value="{{$dept}}"> {{$dept}}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-5">
                                    <label for="">
                                        Range
                                    </label>
                                    <input type="text" class="form-control font-mono  text-center bg-[#F2F4F4"  name="daterange" value="01/01/2018 - 01/15/2018" />

                                    <input type="hidden" class="form-control rounded"  name="start_date" id="start_date" required>
                                    <input type="hidden" class="form-control rounded"  name="end_date" id="end_date" required>
                                </div>
                              
                            </div>

                            <div class="flex justify-center bg-sky-100">
                                <button class="btn-sm btn-priamry px-6 text-sky-900"> Filter </button>
                            </div>
                        </form>

                    </div>


                    @php
                    function buildTaps($taps, $ymdDate){

                         $html = '';

                        $taps = array_filter($taps, function($element){

                            return date('Y-m-d', strtotime($element['tapped_at'])) == '2022-06-16';

                        });

                        $entering = array_filter($taps, function($element){
                            return $element["status"] == 'ENTERING';
                        
                        });


                        $exiting = array_filter($taps, function($element){
                        return $element["status"] == 'EXITING';
                    
                        });

                        $entering = array_slice($entering, 0);
                        $exiting = array_slice($exiting, 0);
                        

                        $long_taps = count($entering) > count($exiting) ?  count($entering) : count($exiting);

                        
                            for($i = 0; $i < $long_taps; $i++){
                            
                            $html .= "<div class='flex taps__movement flex-row w-7' >";

                            if(isset($entering[$i]))
                            {
                                $html .= "<div>" .  date('H:i', strtotime($entering[$i]['tapped_at'])) ." </div>";
                            }

                            if(isset($exiting[$i]))
                            {
                                $html .= "<div>" . date('H:i', strtotime($exiting[$i]['tapped_at']))  ." </div>";
                            }

                            if(isset($entering[$i]) && isset($exiting[$i]))
                                {
                                    $html .=  getDiff_dates($entering[$i]['tapped_at'],$exiting[$i]['tapped_at']) ;

                                }

                            $html .= "</div>";
                        }

                        return $html;
                    }

                    function getDiff_dates($start, $end){

                                // $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i',$start);
                                // $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $end);

                                $dateTimeObject1 = date_create($end); 
                                $dateTimeObject2 = date_create($start);

                                $difference = date_diff($dateTimeObject1, $dateTimeObject2);
                                
                                $minutes = $difference->days * 24 * 60;
                                $minutes += $difference->h * 60;
                                $minutes += $difference->i;

                               

                                if($difference->h > 1){
                                return $difference->h ."hours";

                                }
                                else{
                                    return $minutes ."mins";

                                }


                                }

                 $i= 0;

                @endphp

       



                    @if(count($daysTaps) > 0)

                    @foreach ($daysTaps as $date=>$dayly_taps)

                    @php
                        $i= 0;
                    @endphp

                    <section>
                        <div class="card mt-3">
                    <h1 class="text-center" > <span style="border-size: 2px" class="p-2 border rounded border-cyan-900" > {{$date}} </span> </h1>

                        <table  id="table_{{$date}}" class="table display nowrap" style="width:100%">

                            <div class="card-body">
                                <table  id="table1" class="table display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                                <th> # </th>
                                                <th> Names  </th>
                                                <th> ID number </th>
                                                <th> Phone </th>
                                                <th> Departement </th>
                                                <th> Movement </th>
                                                {{-- <th> Time</th> --}}
                                                <th>tools</th> 
                                           
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($dayly_taps as  $item)

                                        @if (ctype_alpha($item['ID_Card']) || strlen($item['names']) == 0 || preg_match('/[\^£$%&*()}{@#~?><>,|=_+¬-]/', $item['names']) || preg_match('/[\^£$%&*()}{@#~?><>,|=_+¬-]/', $item['phone'])) 
                                    
                                        {{--       
                                        {
                                            $hasC = false;
                                            $fake_data++;
                                        } --}}

                                        @else
                                                     
                                        <tr>
                                            <td> {{++$i}} </td>
                                            <td> {{ $item['names'] }} </td>
                                            <td> {{ $item['ID_Card'] }} </td>
                                            <td> {{ $item['phone']}} </td>
                                            <td> {{ $item['destination']}} </td>
                                            <td>
                                            {!!  buildTaps($item['taps'], date('Y-m-d')); !!}
                                            </td>

                                            <td> </td>
                                       
                                        </tr>
                                        @endif
                                        @endforeach
                
                                    </tbody>
                                </table>
                
                
                            </div>
                        </div>

                    </section>

                    @endforeach
                    @else
                    <div class="card mt-3 bg-blue-100">
                        <div class="card-body">
                            <h1 class="text-center" > <span class="p-2 border rounded border-cyan-300 text-sky-400" > No Records   {{request()->has('start_date') && request()['start_date'] != "" ? "for ".request()['start_date']. " to ".request()['end_date'] :"today (". date('Y-m-d') . ") "  }} </span> </h1>
            
                        </div>
                     </div>
                    
                    @endif

                    </div>
        </div>
            
        </div>



    @endsection

    @section('js')


    <script>


// $('#table1').DataTable({
    // select: true,
    // "processing": true,
    // dom: 'Bfrtip',
    // dom: 'lrtip',
    // buttons: [
        // 'copyHtml5',
        // 'excelHtml5',
        // 'csvHtml5',
        // 'pdfHtml5'
    // ]
    // });
// });


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




    @foreach ($daysTaps as $date=>$dayly_taps)

    $('#table_{{$date}}').DataTable( {
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

    @endforeach





    </script>


    @endsection

