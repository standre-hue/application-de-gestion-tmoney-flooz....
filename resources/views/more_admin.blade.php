@extends('layout')
@section('body')
<section class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="../../dist/img/user4-128x128.jpg"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ $user['nom'] }} {{ $user['prenom'] }}</h3>

            @if ($user['type_admin'] == 0)
            <p class="text-muted text-center">Administrateur Supreme</p>
            @else
            <p class="text-muted text-center">Administrateur Simple</p>
            @endif
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item" style="font-size: 15px;">
                  <b>Nombre de transaction</b> <a class="float-right">{{ $user->transactions->count()}} </a>
                </li>
                <li class="list-group-item style="font-size: 15px;">
                  <b>Nombre d'activite</b> <a class="float-right">{{ $logs->count() }}</a>
                </li>

              </ul>
              @if($user['deleted'] == false)
              @if ($user['type_admin'] == 1)
              <a href="{{ url('delete_admin')}}/{{$user['id']}}" class="btn btn-danger btn-block" style="color:white"><b>Supprimer</b></a>
              @endif

              @else
              <a  class="btn  btn-block" style="background:rgb(184, 165, 165);color:white"><b>Inactif</b></a>
              @endif
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <!-- Post -->
                  <div class="post">
                    <div class="">
                      <h5>Liste des Transactions</h5>
                     <table class="table datatable ">
                        <thead>
                            <th>Type Transaction</th>
                            <th>Numero</th>
                            <th>Type Operation</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach (  $transactions as $transaction )
                            <tr>
                                <td>{{ ucfirst($transaction->transaction_type['nom']) }}</td>
                                <td>{{ $transaction['numero'] }}</td>
                                <td>{{ ucfirst($transaction->transaction_operation_type['nom']) }}</td>
                                <td>{{ date_format(date_create($transaction['created_at']),'d-m-Y') }}</td>
                                <td>{{ date_format(date_create($transaction['created_at']),'H:i:s') }}</td>
                                <td><a href="{{ url('more_transaction') }}/{{$transaction['id']}}">Plus</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                     </table>
                    </div>
                  </div>
                  <div class="post clearfix">
                    <h5>Liste des activites</h5>
                    <table class="table datatable">
                      <thead>
                        <th>Type Operation</th>
                        <th>Date</th> 
                        <th>Heure</th>
                      </thead>
                      <tbody>
                          @foreach (  $logs as $log )
                          <tr>
                              <td>{{ $log['type_activite'] }}</td>
                              <td>{{ date_format(date_create($log['created_at']),'d-m-Y') }}</td>
                              <td>{{ date_format(date_create($log['created_at']),'H:i:s') }}</td>
                              
                          </tr>
                          @endforeach

                      </tbody>
                   </table>
                  </div>
                </div>
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": false,
        });
      });
    </script>
  </section>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
@endsection()