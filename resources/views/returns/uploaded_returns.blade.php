@extends('layouts.master')


@section('styles')

        <!-- Bootstrap CSS -->
        {{--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  --}}


        {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">  --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

        <link href="{{ asset('assets/libs/custombox/custombox.min.css') }}" rel="stylesheet">

        {{-- <link href="{{ asset('assets/josh/style.css') }}" rel="stylesheet"> --}}

    <style>
        thead {
            background: #34080b !Important;
            color: white;
          }
    </style>

@endsection

@section('content')
<br>
<!-- Start Content-->
<div class="container-fluid" >
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


                <div class="row">

                    <div class="col-md-12 card-box">

                        <h3 class="" style="color: #34080b">History of uploaded files</h3>
                        <hr>
                            <table class="table table-bordered" style="zoom: 0.9;" id="datatable-styling">

                                    <thead class=" ">
                                        <tr class="text-center">
                                            <th scope="col">NO.</th>
                                            <th scope="col">Revision ID</th>
                                            <th scope="col">ReturnType ID </th>
                                            <th scope="col">Clear Data</th>
                                            <th scope="col">Filename</th>
                                            <th scope="col">Posted Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $count = 1;
                                        @endphp


                                        @foreach ($uploaded_returns as $return)
                                            <tr >

                                                <td scope="col" class="text-center">{{ $count }} </td>
                                                <td scope="col" class="text-center">{{ $return->revision_id }} </td>
                                                <td scope="col" class="text-center">{{ $return->return_type_id }}</td>
                                                <td scope="col" class="text-center">{{ $return->clear_data }}</td>
                                                <td scope="col" class="text-center">
                                                    <a href="{{ url('download-return', ['filename' => $return->filename ]) }}">
                                                        {{ $return->filename }}
                                                    </a>

                                                </td>
                                                <td scope="col" class="text-center">{{ $return->created_at }}</td>


                                            </tr>

                                                @php
                                                    $count++;
                                                @endphp
                                        @endforeach

{{--

                                            <tr >
                                                <td scope="col" class="text-center">####-######-##-## </td>
                                                <td scope="col" class="text-center">Atwima</td>
                                                <td scope="col" class="text-center">No Data</td>
                                                <td scope="col" class="text-center">Profite</td>
                                                <td scope="col" class="text-center">
                                                   MONEY

                                                </td>
                                                <td scope="col"  class="text-center">No Data</td>
                                                <td  class="text-center">
                                                     <i class="fe-bar-chart-2 text-primary" style="cursor: pointer;"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                                                     <i class="fe-download text-primary" style="cursor: pointer;"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                                                     <i class="fe-upload text-primary"  data-toggle="modal"
                                                    data-target="#exampleModalCenter" style="cursor: pointer;"></i>
                                                </td>


                                            </tr>


                                            <tr >
                                                <td scope="col" class="text-center">####-######-##-## </td>
                                                <td scope="col" class="text-center">Atwima</td>
                                                <td scope="col" class="text-center">No Data</td>
                                                <td scope="col" class="text-center">Profite</td>
                                                <td scope="col" class="text-center">
                                                   MONEY

                                                </td>
                                                <td scope="col"  class="text-center">No Data</td>
                                                <td  class="text-center">
                                                     <i class="fe-bar-chart-2 text-primary" style="cursor: pointer;"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                                                     <i class="fe-download text-primary" style="cursor: pointer;"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                                                     <i class="fe-upload text-primary"  data-toggle="modal"
                                                    data-target="#exampleModalCenter" style="cursor: pointer;"></i>
                                                </td>


                                            </tr>


                                            <tr >
                                                <td scope="col" class="text-center">####-######-##-## </td>
                                                <td scope="col" class="text-center">Atwima</td>
                                                <td scope="col" class="text-center">No Data</td>
                                                <td scope="col" class="text-center">Profite</td>
                                                <td scope="col" class="text-center">
                                                   MONEY

                                                </td>
                                                <td scope="col"  class="text-center">No Data</td>
                                                <td  class="text-center">
                                                     <i class="fe-bar-chart-2 text-primary" style="cursor: pointer;"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                                                     <i class="fe-download text-primary" style="cursor: pointer;"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                                                     <i class="fe-upload text-primary"  data-toggle="modal"
                                                    data-target="#exampleModalCenter" style="cursor: pointer;"></i>
                                                </td>


                                            </tr>
 --}}





                                    </tbody>

                        </table>
                    </div>



                </div>
    <!-- end row-->




        <!-- Modal for REQUEST -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title custom-color" id="exampleModalLongTitle">#####-####-###-###-#</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <p>
                                 <span class="custom-color">
                                      This is a simple hero unit, a simple jumbotron-style component for  .
                                      </span>
                                <div class="form-group">
                                    <label>Clear Previous Data *:</label>

                                    <div class="radio">
                                        <input type="radio" name="previous_data" id="genderM" value="YES" required="" data-parsley-multiple="clear_previous">
                                        <label for="genderM">
                                            YES
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="previous_data" id="genderF" value="NO" data-parsley-multiple="clear_previous" checked>
                                        <label for="genderF">
                                            NO
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="h5">Narration</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Return document</label> <br>
                                    <input type="file">
                                </div>
                                <br>


                            </p>

                        </div>
                        <div class="modal-footer">

                            <button type="button" name="" id="" class="btn btn-success" >Submit</button>

                            <button type="button" class="btn btn-secondart" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal for REQUEST -->

        <!-- Custom Modal -->
        <div id="custom-modal" class="modal-demo">
            <button type="button" class="close" onclick="Custombox.modal.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title custom-bg-color">
                {{  isset($date_range) ? $date_range : date('dd-mm-YY') }}
            </h4>
            <div class="custom-modal-text">
               <p>
                <canvas id="pie_chart" width="300" height="180"></canvas>
               </p>
            </div>
        </div>




        <!-- Modal for RESPONSE -->
        <div class="modal fade" id="exampleModalCenterResponse" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterResponseTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="exampleModalLongTitle">REQ0001 - RESPONSE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            This is a simple hero unit, a simple jumbotron-style component for calling extra
                            attention
                            to
                            featured content or information.
                        </p>
                        <p>
                            This is a simple hero unit, a simple jumbotron-style component for calling extra .
                        </p>
                        <p>

                            featured content or information.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" >Close</button> -->
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for RESPONSE -->


</div>

@endsection

@section('scripts')

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        {{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>  --}}
        <!-- CHART init js -->
        <script src="{{  asset('assets/js/chartjs/Chart.min.js') }}"></script>

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- Modal-Effect -->
        <script src="{{ asset('assets/libs/custombox/custombox.min.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#datatable-styling').DataTable();
            });
        </script>

        <script>
            var ctx = document.getElementById('pie_chart').getContext('2d');
              var myBarChart = new Chart(ctx, {
              type: 'pie',
              data:{
              {{--  labels: @json($graph_label),  --}}
              labels: ['Success', 'Failures'],
              datasets: [{
                      label: 'Transactions',
                      data: [200, 3],
                      {{--  data: @json($graph_data),  --}}
                      backgroundColor: [

                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 99, 132,1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)'
                      ],
                      borderColor: [

                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 99, 132, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)'
                      ],
                      borderWidth: 1
                  }]
              }

          });

        </script>


@endsection
