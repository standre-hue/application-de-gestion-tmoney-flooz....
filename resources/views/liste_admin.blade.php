@extends('layout')
@section('body')



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste des Administrateurs</h1>
            @if (auth()->user()['type_admin'] == 0)
            <a href="{{ url('create_admin') }}"><button class="btn btn-primary">&nbsp&nbsp&nbsp Ajouter &nbsp&nbsp&nbsp</button></a>
            @endif
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Liste des Administrateurs</li>
            </ol>
            <br>
            
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
                  <th>Type Administrateur</th>
                  <th>Status</th>
                  <th>Date de creation</th> 
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user )
                  <tr>
                    <td>{{ $user['nom'] }}</td>
                    <td>{{ $user['prenom']  }}</td>
                    @if ($user['type_admin'] == 0 )
                        <td>Administrateur Supreme</td>
                    @else
                        <td>Administrateur Simple</td>
                    @endif
                    @if ($user['deleted'] == false )
                        <td>Actif</td>
                    @else
                        <td>Inactif</td>
                    @endif
                    <td>{{ date_format(date_create($user['created_at']),'d-m-Y') }}</td>
                    <td><a href="{{url('more_admin')}}/{{ $user['id'] }}">Plus</a></td>

                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Type Administrateur</th>
                    <th>Status</th>
                    <th>Date de Creation</th> 
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <h3>Nombre total: {{ $users->count() }}</h3>
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

