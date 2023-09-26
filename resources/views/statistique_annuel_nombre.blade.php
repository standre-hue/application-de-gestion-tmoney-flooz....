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
        <h3 class="text-center"> Recapitulatif de l'annee: <span style="font-weight: bold">{{ date('Y') }}</span></h3>
              <br/>
              <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th  style="width: 0px;diplay:none;">Mois</th>
                    <th colspan="2" style="width: 50px">Flooz</th>
                    <th colspan="2" style="width: 50px">Tmoney</th>
                    <th colspan="2" style="width: 50px">Ria</th>
                    <th colspan="2" style="width: 50px">Western Union</th>
                    <th colspan="2" style="width: 50px">Moneygram</th>
                  </tr>
                  <tr>
                    <th style="width: 0px"></th>
                    <th style="width: 40px">Retrait</th>
                    <th style="width: 40px">Depot</th>
                    <th style="width: 40px">Retrait</th>
                    <th style="width: 40px">Depot</th>
                    <th style="width: 40px">Retrait</th>
                    <th style="width: 40px">Depot</th>
                    <th style="width: 40px">Retrait</th>
                    <th style="width: 40px">Depot</th>
                    <th style="width: 40px">Retrait</th>
                    <th style="width: 40px">Depot</th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $data as $datum )
                  <tr>
                    <td style="width: 0px">@if ($datum[0] == 1 )
                      Janvier
                      @elseif ($datum[0] == 2)
                      Fevrier
                      @elseif ($datum[0] == 3)
                      Mars
                      @elseif ($datum[0] == 4)
                      Avril
                      @elseif ($datum[0] == 5)
                      Mai
                      @elseif ($datum[0] == 6)
                      Juin
                      @elseif ($datum[0] == 7)
                      Juillet
                      @elseif ($datum[0] == 8)
                      Aout
                      @elseif ($datum[0] == 9)
                      Septembre
                      @elseif ($datum[0] == 10)
                      Octobre
                      @elseif ($datum[0] == 11)
                      Novembre
                      @elseif ($datum[0] == 12)
                      Decembre
                    @endif</td>
                    <td>{{ $datum[1][2] }}</td>
                    <td>{{ $datum[1][3] }}</td>
                    <td>{{ $datum[2][2] }}</td>
                    <td>{{ $datum[2][3] }}</td>
                    <td>{{ $datum[3][2] }}</td>
                    <td>{{ $datum[3][3] }}</td>
                    <td>{{ $datum[3][2] }}</td>
                    <td>{{ $datum[4][3] }}</td>
                    <td>{{ $datum[5][2] }}</td>
                    <td>{{ $datum[5][3] }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td style="width: 0px;font-weight:bold">Total
                    </td>
                    <td style="font-weight:bold">{{ number_format($data2['flooz'][2],0,',','.')  }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['flooz'][3],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['tmoney'][2],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['tmoney'][3],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['ria'][2],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['ria'][3],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['western_union'][2],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['western_union'][3],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['moneygram'][2],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['moneygram'][3],0,',','.') }}</td>
                  </tr>

                </tbody>
              </table>
              <br/>
              <h3>Nombre Total Transaction: <span style="font-weight: bold">{{ number_format($transaction_nombre_total,0,',','.') }}</span></h3>
    </body>
    <script type="text/javascript"> 
        window.addEventListener("load", window.print());
      </script>
</html>