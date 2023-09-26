@extends('layout')
@section('body')

<div class="content-wrapper" style="padding: 10px">
    @if(App\Models\Compte::where('type_compte','flooz')->get()[0]['solde'] <= 20000)
    <div class="" style="width: 500px">
        <div class="card bg-danger">
          <div class="card-header" >
            <h3 class="card-title">Avertissement</h3>

            <div class="card-tools" >
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body" >
            Le solde de votre compte Flooz est inferieur a 20 000
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    @endif
    <div class="card">
        <h5>Flooz</h5>
        <h5>Solde: <span style="font-weight:bold">{{  number_format($flooz['solde'],0,',','.') }}</span></h5>

        <a href="{{ url('approvisionner_compte') }}?type_compte=flooz"><button class="btn btn-primary">Recharger</button></a>

        <table class="table datatable" style="margin: 10px">
            <thead>
                <tr>
                    <th>
                        Administrateur
                    </th>
                    <th>
                        Montant
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Heure
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flooz->approvisionnements as $approvisionnement )
                <tr>
                    <td>{{ $approvisionnement->user['nom'] }} {{ $approvisionnement->user['prenom'] }}</td>
                    <td>{{ number_format($approvisionnement['montant'],0,',','.')  }}</td>
                    <td>{{ date_format(date_create($approvisionnement['created_at']),'d-m-Y')  }}</td></td>
                    <td>{{ date_format(date_create($approvisionnement['created_at']),'H:i:s')  }}</td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @if(App\Models\Compte::where('type_compte','tmoney')->get()[0]['solde'] <= 20000)
    <div class="" style="width: 500px;margin-top:50px;margin-bottom:-20px;">
        <div class="card bg-danger">
          <div class="card-header" >
            <h3 class="card-title">Avertissement</h3>

            <div class="card-tools" >
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body" >
            Le solde de votre compte Tmoney est inferieur a 20 000
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    @endif
    <div class="card" style="margin-top: 40px">
        <h5>Tmoney</h5>
        <h5>Solde: <span style="font-weight:bold">{{ number_format($tmoney['solde'],0,',','.') }}</span></h5>

        <a href="{{ url('approvisionner_compte') }}?type_compte=tmoney"><button class="btn btn-primary">Recharger</button></a>

        <table class="table datatable" style="margin: 10px">
            <thead>
                <tr>
                    <th>
                        Administrateur
                    </th>
                    <th>
                        Montant
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Heure
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tmoney->approvisionnements as $approvisionnement )
                <tr>
                    <td>{{ $approvisionnement->user['nom'] }} {{ $approvisionnement->user['prenom'] }}</td>
                    <td>{{ number_format($approvisionnement['montant'],0,',','.')  }}</td>
                    <td>{{ date_format(date_create($approvisionnement['created_at']),'d-m-Y')  }}</td></td>
                    <td>{{ date_format(date_create($approvisionnement['created_at']),'H:i:s')  }}</td></td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
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