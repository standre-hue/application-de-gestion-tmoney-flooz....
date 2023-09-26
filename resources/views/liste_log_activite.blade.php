@extends('layout')
@section('body')



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Journal des Activites</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Journal des Activites</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
   
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table datatable">
                <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Type Operation</th>
                  <th>Date</th> 
                  <th>Heure</th>
                  <th>Action</th>
                 
                </tr>
                </thead>
                <tbody>
                  @foreach ($logs as $log )
                  <tr>
                    <td>{{ $log->user['nom'] }}</td>
                    <td>{{ $log->user['prenom'] }}</td>
                    <td>{{ $log['type_activite'] }}</td>
                    <td>{{ date_format(date_create($log['created_at']),'d-m-Y') }}</td>
                    <td>{{ date_format(date_create($log['created_at']),'H:i:s') }}</td>
                    @if ($log->transaction != null)
                    <td><a href="{{url('more_transaction')}}/{{ $log->transaction['id'] }}">Plus</a></td>
                    @elseif ($log->transaction == null)
                    <td><a href="{{url('more_admin')}}/{{ $log->user['id'] }}">Plus</a></td>
                    @endif
                    

                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Type Operation</th>
                    <th>Date</th> 
                    <th>Heure</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <h3>Nombre total: {{ $logs->count() }}</h3>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>





<!-- jQuery -->
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
<!-- page script -->
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

