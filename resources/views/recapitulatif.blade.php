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
        <div class="" style="padding: 10px">
            <!--<form style="margin: 10px;">
                <label>Periode: </label>
        
                <label>Du</label>
                <input type="date" name="date_debut" />
        
                <label>Au </label>
                <input type="date" name="date_fin" />
        
                <a href="{{ url('statistique') }}/?periode=today"><button type="submit" class="btn btn-primary">Aujourd'hui</button></a>
                <button type="submit" class="btn btn-primary">Afficher</button>
                
            </form>-->
        
            <!--<div class="card">
                <div class="card-header">
                  <h3 class="card-title">Recapitulatif Transaction <span style="font-weight: bold">Flooz</span></h3>
        
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped ">
                        <thead>                  
                          <tr>
                            <th  style="width: 0px;diplay:none;">Type Transaction</th>
                            <th  style="width: 50px">Numero</th>
                            <th  style="width: 50px">Montant</th>
                            <th  style="width: 50px">Type Operation</th>
                            <th  style="width: 50px">Date</th>
                            <th  style="width: 50px">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ( $flooz->transactions as $transaction )
                          <tr>
                            <td>{{ $transaction->transaction_type['nom'] }}</td>
                            <td>{{ $transaction['numero'] }}</td>
                            <td>{{ $transaction['montant'] }}</td>
                            <td>{{ $transaction->transaction_operation_type['nom'] }}</td>
                            <td>{{ $transaction['created_at'] }}</td>
                            <td><a href="{{ url('modify_transaction') }}/{{ $transaction['id'] }}"><button class="btn btn-primary">Plus</button></a></td>
                          </tr>
                          @endforeach
        
        
                        </tbody>
                      </table
                </div>
               
                <div class="card-footer">
                  <h6>Nombre de Transaction: <span style="font-weight: bold">{{ $flooz->transactions->count() }}</span></h6><br>
                  <h6>Nombre de Depot: <span style="font-weight: bold">{{ $flooz->transactions->count() }}</span></h6><br>
                    <h6>Montant Total de Depot: <span style="font-weight: bold">{{ $flooz->transactions->count() }}</span></h6><br>
                        <h6>Nombre de Retrait: <span style="font-weight: bold">{{ $flooz->transactions->count() }}</span></h6><br>
                            <h6>Montant Total de Retrait: <span style="font-weight: bold">{{ $flooz->transactions->count() }}</span></h6><br>
                </div>
                
            </div>
        
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Recapitulatif Transaction <span style="font-weight: bold">Tmoney</span></h3>
        
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped ">
                        <thead>                  
                          <tr>
                            <th  style="width: 0px;diplay:none;">Type Transaction</th>
                            <th  style="width: 50px">Numero</th>
                            <th  style="width: 50px">Montant</th>
                            <th  style="width: 50px">Type Operation</th>
                            <th  style="width: 50px">Date</th>
                            <th  style="width: 50px">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ( $flooz->transactions as $transaction )
                          <tr>
                            <td>{{ $transaction->transaction_type['nom'] }}</td>
                            <td>{{ $transaction['numero'] }}</td>
                            <td>{{ $transaction['montant'] }}</td>
                            <td>{{ $transaction->transaction_operation_type['nom'] }}</td>
                            <td>{{ $transaction['created_at'] }}</td>
                            <td><a href="{{ url('modify_transaction') }}/{{ $transaction['id'] }}"><button class="btn btn-primary">Plus</button></a></td>
                          </tr>
                          @endforeach
        
        
                        </tbody>
                      </table
                </div>
                
                <div class="card-footern">
                  <h6>Nombre de Transaction: <span style="font-weight: bold">{{ $flooz->transactions->count() }}</span></h6><br>
                  <h6>Nombre de Depot: <span style="font-weight: bold">{{ $flooz->transactions->count() }}</span></h6><br>
                    <h6>Montant Total de Depot: <span style="font-weight: bold">{{ $flooz->transactions->count() }}</span></h6><br>
                        <h6>Nombre de Retrait: <span style="font-weight: bold">{{ $flooz->transactions->count() }}</span></h6><br>
                            <h6>Montant Total de Retrait: <span style="font-weight: bold">{{ $flooz->transactions->count() }}</span></h6><br>
                </div>
                
            </div>-->

            @if ( isset($periode) && periode == "mois" )
            <h4 class="text-center" " style="text-decoration: underline"> Recapitulatif  du mois  <span style="font-weight: bold;"> {{ date('m') }} </span></h4>
            @elseif ( isset($periode) && periode == "semaine" )
            <h4 class="text-center" " style="text-decoration: underline"> Recapitulatif  de la semaine  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
            @elseif ( isset($periode) && periode == "annee" )
            <h4 class="text-center" " style="text-decoration: underline"> Recapitulatif  de l'annee  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
            @elseif ( isset($date_debut) && isset($date_fin)  )
            <h4 class="text-center" " style="text-decoration: underline"> Recapitulatif  du <span style="font-weight: bold;"> {{ $date_debut }} </span> au  <span style="font-weight: bold">{{ $date_fin }}</span></h4>
            @else 
            <h4 class="text-center" " style="text-decoration: underline"> Recapitulatif du   <span style="font-weight: bold">{{ date('d-m-Y') }}</span></h4>
            @endif
                      <table class="table table-bordered">
                        <thead>                  
                          <tr>
                            <th  style="width: 0px;diplay:none;"></th>
                            <th style="width: 50px">Flooz</th>
                            <th style="width: 50px">Tmoney</th>
                            <th style="width: 50px">Ria</th>
                            <th style="width: 50px">Western Union</th>
                            <th style="width: 50px">Moneygram</th>
                            <th  style="width: 50px">Total</th>
                          </tr>
          
                        </thead>
                        <tbody>
            
        
                            <tr>
                                <th style="width: 40px">Nombre de Retrait</th>
                                <td>{{ number_format($data[0][0],0,',','.')}}</td>
                                <td>{{ number_format($data[0][1],0,',','.')}}</td>
                                <td>{{ number_format($data[0][2],0,',','.')}}</td>
                                <td>{{ number_format($data[0][3],0,',','.')}}</td>
                                <td>{{ number_format($data[0][4],0,',','.')}}</td>
                                <td><span style="font-weight: bold">{{ number_format($data[0][0] + $data[0][1] + $data[0][2] + $data[0][3] + $data[0][4],0,',','.') }}</span></td>
                                
                            </tr>
                            <tr>
                                <th style="width: 40px">Nombre de Depot</th>
                                <td>{{ number_format($data[1][0],0,',','.')}}</td>
                                <td>{{ number_format($data[1][1],0,',','.')}}</td>
                                <td>{{ number_format($data[1][2],0,',','.')}}</td>
                                <td>{{ number_format($data[1][3],0,',','.')}}</td>
                                <td>{{ $data[1][4]}}</td>
                                <td><span style="font-weight: bold">{{ number_format($data[1][0] + $data[1][1] + $data[1][2] + $data[1][3] + $data[1][4],0,',','.') }}</span></td>
                                
                            </tr>
                            <tr>
                                <th style="width: 40px">Montant Total Retrait</th>
                                <td>{{ number_format($data[2][0],0,',','.')}}</td>
                                <td>{{ number_format($data[2][1],0,',','.')}}</td>
                                <td>{{ number_format($data[2][2],0,',','.')}}</td>
                                <td>{{ number_format($data[2][3],0,',','.')}}</td>
                                <td>{{ number_format($data[2][4],0,',','.')}}</td>
                                <td><span style="font-weight: bold;">{{ number_format($data[2][0] + $data[2][1] + $data[2][2] + $data[2][3] + $data[2][4],0,',','.') }}</span></td>
                                
                            </tr>
                            <tr>
                                <th style="width: 40px">Montant Total Depot</th>
                                <td>{{ number_format($data[3][0],0,',','.')}}</td>
                                <td>{{ number_format($data[3][1],0,',','.')}}</td>
                                <td>{{ number_format($data[3][2],0,',','.')}}</td>
                                <td>{{ number_format($data[3][3],0,',','.')}}</td>
                                <td>{{ number_format($data[3][4],0,',','.')}}</td>
                                <td><span style="font-weight: bold">{{ number_format($data[3][0] + $data[3][1] + $data[3][2] + $data[3][3] + $data[3][4],0,',','.') }}</span></td>
                            </tr>
        
                        </tbody>
                      </table>
   
                      
        
                      <br/>
        
                      <!--<h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Flooz</span> du jour: <span style="font-weight: bold">{{ date('d-m-Y') }}</span></h4>
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
            
                          @foreach ( $flooz->transactions as $transaction )
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
                      <h5>Nombre Total de Transaction: <span style="font-weight: bold"> {{ $flooz->transactions->count() }} </span></h5>
                      <button class="btn btn-primary">Imprimeer</button>-->
        
                      
        
        </div>
        <script type="text/javascript">
            window.addEventListener("load", window.print());
        </script>
    </body>



</html>