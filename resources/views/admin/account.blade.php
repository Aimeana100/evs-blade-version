@extends('admin.layoult')
@section('page_title','Admin Dashboard')
@section('profile_selected','active')


@section('content')

<div class="main-content container-fluid">
    <div class="page-title items-center bg-blue-100">
        <div class="row md:px-8 md:py-2 items-center">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Profile  </h3>
            </div>
        </div>
    </div>
    <!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="m-auto flex flex-col ">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        @if(session('success'))
        <div id="alert-4" class="flex p-4 mb-4 bg-yellow-100 rounded-lg dark:bg-yellow-200" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-yellow-700 dark:text-yellow-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div class="ml-3 text-sm font-medium text-yellow-700 text-success dark:text-yellow-800">
              {{session('success') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-yellow-100 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex h-8 w-8 dark:bg-yellow-200 dark:text-yellow-600 dark:hover:bg-yellow-300" data-dismiss-target="#alert-4" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
          </div>
        @endif

        @if(session('error'))
        <div id="alert-4" class="flex p-4 mb-4 bg-yellow-100 rounded-lg dark:bg-yellow-200" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-yellow-700 dark:text-yellow-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div class="ml-3 text-sm font-medium text-yellow-700 text-success dark:text-yellow-800">
              
                {{session('error') }}

            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-yellow-100 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex h-8 w-8 dark:bg-yellow-200 dark:text-yellow-600 dark:hover:bg-yellow-300" data-dismiss-target="#alert-4" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
          </div>
        @endif
       
    </div>

    <div class="row match-height">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" id="frmProfile" action="{{route('admin.update.acount')}}" method="POST">
                            @csrf

                            <div class="row ">
                                <div class="col-4 p-0">
                                    <div class=" mb2 ">
                                        <div class="avatar-wrapper">
                                            <img class="profile-pic" id="profile-pic" src="" />
                                            <div class="upload-button">
                                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                            </div>
                                            <input id="photo" name="photo" class="file-upload" type="file" accept="image/*"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 flex flex-col justify-center">

                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="names"> Names </label>
                                        <div class="position-relative">
                                            <input name="names" type="text" class="form-control rounded" placeholder="John doe" id="names" value="{{$user_me->name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="email">Email</label>
                                        <div class="position-relative">
                                            <input name="email" type="email" class="form-control rounded" placeholder="john@gmail.com" id="email" value="{{$user_me->email}}">
                                            <div class=" form-control-icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-10 col-lg-8">
                                    <div class="form-group has-icon-left">
                                        <label for="staff_id">  staff ID </label>
                                        <div class="position-relative">
                                            <input name="staff_id" type="text" class="form-control rounded" placeholder="staff_id" id="staff_id" value="{{$user_me->NID}}">
                                        </div>
                                    </div>
                                </div>




                                </div>
                            </div>

                            <div class="row mt-3">
                                <input type="hidden" id="id" name="id" value={{$user_me->id}}>

                                <!-- populate the base64 encoded image in the textarea -->
                                {{-- <textarea id="signature64" name="signed" style="display:none"></textarea> --}}

                                <div class="col-12 d-flex  justify-content-center">
                                    <button id="frmUpdate" type="submit" class="btn btn-primary me-1 mb-1">Update Profile</button>
                                </div>
                            </div>

                            {{-- <div class="d-flex justify-content-center">
                                <div style="margin: auto" class="spinner-border  spinner-border-add" role="status">
                                 <span class="sr-only">Loading...</span>
                             </div> --}}
                             </div>

                             <div id="update-messages">
                             </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    
 </div>

@endsection

