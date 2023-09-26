@extends('layout')
@section('body')



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <style>
      .active_{
        background: red;
      }
      table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
  bottom: .5em;
}
    </style>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="width:700px">Liste des Transactions @if (Session::has('date_debut') && Session::has('date_fin') )
              du <span style="font-weight: bold;font-size:25px;"> {{ date_format(date_create(Session::get('date_debut')),'d-m-Y') }}</span> au <span style="font-weight: bold;font-size:25px;"> {{ date_format(date_create(Session::get('date_fin')),'d-m-Y') }}</span>
            @endif @if (@isset($arc))
              Archivees
            @endif</h1>

            @if (@isset($arc))
            <a href="{{ url('liste_transaction')}}"><h5>Liste des Transactions</h5></a>
            
            @else
            <a href="{{ url('liste_transaction')}}?archive=true"><h5>Liste des Transactions Archivees</h5></a>
            @endif
              <form style="display: flex;align-items:center;">
                <label>Periode: </label>
                <label>Du</label>
                <input type="date" name="date_debut"/>
                <label>Au</label>
                <input type="date" name="date_fin"/>
                <input type="submit" class="btn btn-primary" value="Rechercher" style="margin-left: 10px"/>
                <a href="{{ url('liste_transaction')}}"><button  style="margin-left: 10px;height:40px;width:150px;" class="btn btn-primary" value="Afficher Tous">Afficher Tous</button></a>
              </form>
              
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Liste Transaction</li>
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
              <table  class="table datatable">
                <thead>
                <tr>
                  <th>Type Transaction</th>
                  <th>Numero</th>
                  <th>Type Operation</th>
                  <th>Montant</th>
                 
                  <th>Date</th> 
                  <th>Heure</th> 
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($transactions as $transaction )
        
                  <tr>
                    <td>{{ ucfirst($transaction->transaction_type['nom']) }}</td>
                    <td class="nbr">{{ $transaction['numero'] }}</td>
                    <td>{{ ucfirst($transaction->transaction_operation_type['nom']) }}</td>
                    <td>{{ number_format($transaction['montant'],0,',','.') }}</td>
                    
                    <td>{{ date_format(date_create($transaction['created_at']),'d-m-Y') }}</td>
                    <td>{{ date_format(date_create($transaction['created_at']),'H:i:s') }}</td>
                    <td><a href="{{ url('more_transaction') }}/{{ $transaction['id'] }}">Plus</a></td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Type Transaction</th>
                  <th>Numero</th>
                  <th>Type Operation</th>
                  <th>Montant</th>
                 
                  <th>Date</th>
                  <th>Heure</th> 
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <h3>Nombre total: {{ $transactions->count() }}</h3>
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
<script src="plugins/utils.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

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

<!-- page script -->
<script>
  const t = document.querySelector('.nbr')
  t.innerHTML = formatNumber(t.innerHTML)
  $(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

  var datatable = new DataTable('#example');
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
@endsection()

