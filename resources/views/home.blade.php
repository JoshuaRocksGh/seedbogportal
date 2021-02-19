@extends('layouts.master')


@section('styles')
<style type="text/css">
  thead{
    background: #4a81d4;
    color: white;
  }
</style>
@endsection

@section('content')

<!-- Start Content-->
<div class="container-fluid">
    @if (Session::has('success'))
       <div class="alert alert-success">
           <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
           <p>{{ Session::get('success') }}</p>
       </div>
   @endif
    {{--  <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="form-inline">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control border-white" id="dash-daterange">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-blue border-blue text-white">
                                        <i class="mdi mdi-calendar-range font-13"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->  --}}

    <br>
    <div class="row">

            <div class="col-md-12 col-xl-12">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-12">
                           <span class="h3">
                           <span class="custom-color">
                                Monthly Returns Statistics
                           </span>
                           </span>
                        </div>

                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->



    </div>
    <!-- end row-->

    <div class="row">

    <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-soft-primary border" style="background-color: #3b9705">
                                <i class="fe-bar-chart-2 font-22 avatar-title"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-right">
                                <h3 class="text-dark mt-1">
                                    @if(Session::has('all_return_count'))
                                        {{ Session::get('all_return_count') }}
                                     @else
                                     *
                                    @endif
                                </h3>
                               <a href="{{ url('returns') }}">
                                   <h4 class="text-muted mb-1 custom-color">

                                       ALL RETURNS
                                    </h4>
                                </a>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-soft-primary border" style="background-color: #0537da;">
                                <i class="fe-upload font-22 avatar-title"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"> {{ $uploaded_returns_count }}</h3>
                               <a href="{{ url('uploaded-returns') }}">
                                   <h4 class="text-muted mb-1 custom-color">UPLOADED RETURNS</h4>
                                </a>

                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

             <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-soft-primary border" style="background-color: #da055e;">
                                <i class="fe-aperture font-22 avatar-title"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-right">
                                <h3 class="text-dark mt-1">Last Login</h3>
                                <h4 class="text-muted mb-1 custom-color">{{Session::get('last_login_date')}}</h4>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
{{--



            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-soft-primary border" style="background-color: #3575ec;">
                                <i class="fe-briefcase font-22 avatar-title"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"> 477,899</h3>
                                <h4 class="text-muted mb-1 custom-color">UTB</h4>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-soft-primary border" style="background-color: #b15407;">
                                <i class="fe-sunrise font-22 avatar-title"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"> 1,000</h3>
                                <h4 class="text-muted mb-1 custom-color">SEEB</h4>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-soft-primary border" style="background-color: #fc3a74;">
                                <i class="fe-gift font-22 avatar-title"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"> 5,988</h3>
                                <h4 class="text-muted mb-1 custom-color">BEST POINT</h4>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col--> --}}


    </div>


<!--     <div class="row">
      <div class="col-md-6">
         <div class="card">
            <div class="card-body">
              <h4 class="header-title mb-3">APPLICATION FORM SALES</h4>
              <table class="table">
                <thead>
                  <tr>
                    <th>FORM NAME</th>
                    <th>YEST. SALES</th>
                    <th>TODAY SALES</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>

            </div>
          </div>
      </div>
      <div class="col-md-6">
        <div class="card">
            <div class="card-body">
              <h4 class="header-title mb-3">APPLICATION FORMS AVAILABILITY</h4>
              <table class="table">
                <thead>
                  <tr>
                    <th>FORM NAME</th>
                    <th>NO. AVAIL</th>
                    <th>NO. SOLD</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
      </div>

    </div> -->


</div>


@endsection

@section('scripts')

 <script src="{{asset('assets/libs/morris-js/morris.min.js')}}"></script>
 <script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>
 <script src="{{asset('assets/js/pages/dashboard-1.init.js')}}"></script>
 <script type="text/javascript">
   function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }


    $( document ).ready(function() {
       $("#avatar").css("background-color", getRandomColor());
    });
 </script>

@endsection
