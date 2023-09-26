<!DOCTYPE html>
<html>
    <head>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
      
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
          </head>

    <body>
        @if ( isset($periode) && periode == "mois" )
        <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Ria</span> du mois  <span style="font-weight: bold;"> {{ date('m') }} </span></h4>
        @elseif ( isset($periode) && periode == "semaine" )
        <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Ria</span> de la semaine  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
        @elseif ( isset($periode) && periode == "annee" )
        <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Ria</span> de l'annee  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
        @elseif ( isset($date_debut) && isset($date_fin)  )
        <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Ria</span> du <span style="font-weight: bold;"> {{ $date_debut }} </span> au  <span style="font-weight: bold">{{ $date_fin }}</span></h4>
        @else 
        <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Ria</span> du  <span style="font-weight: bold">{{ date('d-m-Y') }}</span></h4>
        @endif


        <table class="table table-bordered">
          <thead>                  
            <tr>
              
              <th style="width: 50px">Numero</th>
              <th style="width: 50px">Montant</th>
              <th style="width: 50px">Type Operation</th>
              <th style="width: 50px">Date</th>
              <th style="width: 50px">Action</th>
             
            </tr>

          </thead>
          <tbody>

            @foreach ( $ria->transactions as $transaction )
            <tr>
            
              <td>{{ $transaction['numero'] }}</td>
              <td>{{ $transaction['montant']  }}</td>
              <td>{{ $transaction->transaction_operation_type['nom'] }}</td>
              <td>{{ $transaction['created_at']  }}</td>
              <td><a href="{{ url('more_transaction') }}/{{ $transaction['id'] }}">Plus</a></td>
              
          </tr>             
            @endforeach
          </tbody>
        </table>
        <h5>Nombre Total de Transaction: <span style="font-weight: bold"> {{ $ria->transactions->count() }} </span></h5>
        <h5>Nombre Total de Retrait: <span style="font-weight: bold"> {{ $ria_nombre_retrait }} </span></h5>
        <h5>Nombre Total de Depot: <span style="font-weight: bold"> {{ $ria_nombre_depot }} </span></h5>
        <h5>Montant Total de Retrait: <span style="font-weight: bold"> {{ $ria_montant_total_retrait }} </span></h5>
        <h5>Montant Total de Depot: <span style="font-weight: bold"> {{ $ria_montant_total_depot }} </span></h5>

        <script type="text/javascript">
            window.addEventListener("load", window.print());
        </script>
    </body>

</html>