@extends('layout')
@section('body')
<div class="content-wrapper" style="padding: 10px">
    <form style="margin: 10px;">
        <label>Periode: </label>

        <label>Du</label>
        <input type="date" name="date_debut" />

        <label>Au </label>
        <input type="date" name="date_fin" />

        
        <button type="submit" class="btn btn-primary">Afficher</button>
        <a href="{{ url('statistique') }}/?periode=today"><button type="submit" class="btn btn-primary">Aujourd'hui</button></a>
        
    </form>

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
    <h4 class="text-center" " style="text-decoration: underline"> Recapitulatif du mois:   <span style="font-weight: bold;"> {{ date('m') }} </span></h4>
    @elseif ( isset($periode) && periode == "semaine" )
    <h4 class="text-center" " style="text-decoration: underline"> Recapitulatif de la semaine:   <span style="font-weight: bold;"> {{ date('m') }} </span></h4>
    @elseif ( isset($periode) && periode == "annee" )
    <h4 class="text-center" " style="text-decoration: underline"> Recapitulatif de l'annee:   <span style="font-weight: bold;"> {{ date('m') }} </span></h4>
    @elseif ( isset($date_debut) && isset($date_fin)  )
    <h4 class="text-center" " style="text-decoration: underline"> Recapitulatif  du {{ date_format(date_create($date_debut),'d-m-Y') }} </span> au  <span style="font-weight: bold">{{ date_format(date_create($date_fin),'d-m-Y') }}</span></h4>
    @else 
    <h4 class="text-center" style="text-decoration: underline"> Recapitulatif du jour: <span style="font-weight: bold">{{ date('d-m-Y') }} </span></h4>
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
                        <td>{{ number_format($data[0][0],0,',','.') }}</td>
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
                        <td>{{ number_format($data[1][4],0,',','.')}}</td>
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
              @if ( isset($periode) && periode == "mois" )
              <a href="{{ url('recapitulatif')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "semaine" )
              <a href="{{ url('recapitulatif')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "annee" )
              <a href="{{ url('recapitulatif')}}/?periode=annee"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <a href="{{ url('recapitulatif')}}/?date_debut={{$date_debut}}&date_fin={{$date_fin}}"><button class="btn btn-primary">Imprimer</button></a>
              @else 
              <a href="{{ url('recapitulatif')}}/?periode=today"><button class="btn btn-primary">Imprimer</button></a>
              @endif
              

              <br/>
              <br/>

              @if ( isset($periode) && periode == "mois" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Flooz</span> du mois  <span style="font-weight: bold;"> {{ date('m') }} </span></h4>
              @elseif ( isset($periode) && periode == "semaine" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Flooz</span> de la semaine  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
              @elseif ( isset($periode) && periode == "annee" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Flooz</span> de l'annee  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Flooz</span> du <span style="font-weight: bold;"> {{ date_format(date_create($date_debut),'d-m-Y') }} </span> au  <span style="font-weight: bold">{{ date_format(date_create($date_fin),'d-m-Y') }}</span></h4>
              @else 
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Flooz</span> du  <span style="font-weight: bold">{{ date('d-m-Y') }}</span></h4>
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
    
                  @foreach ( $flooz->transactions as $transaction )
                  <tr>
                  
                    <td>{{ $transaction['numero'] }}</td>
                    <td>{{ number_format($transaction['montant'],0,',','.')  }}</td>
                    <td>{{ ucfirst($transaction->transaction_operation_type['nom']) }}</td>
                    <td>{{ date_format(date_create($transaction['created_at']),'d-m-Y') }}</td>
                    <td><a href="{{ url('more_transaction') }}/{{ $transaction['id'] }}">Plus</a></td>
                    
                </tr>             
                  @endforeach
                </tbody>
              </table>
              <h5>Nombre Total de Transaction: <span style="font-weight: bold"> {{ $flooz->transactions->count() }} </span></h5>
              @if ( isset($periode) && periode == "mois" )
              <a href="{{ url('recapitulatif_flooz')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "semaine" )
              <a href="{{ url('recapitulatif_flooz')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "annee" )
              <a href="{{ url('recapitulatif_flooz')}}/?periode=annee"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <a href="{{ url('recapitulatif_flooz')}}/?date_debut={{$date_debut}}&date_fin={{$date_fin}}"><button class="btn btn-primary">Imprimer</button></a>
              @else 
              <a href="{{ url('recapitulatif_flooz')}}/?periode=today"><button class="btn btn-primary">Imprimer</button></a>
              @endif

              <br/>
              <br/>


              @if ( isset($periode) && periode == "mois" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Tmoney</span> du mois  <span style="font-weight: bold;"> {{ date('m') }} </span></h4>
              @elseif ( isset($periode) && periode == "semaine" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Tmoney</span> de la semaine  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
              @elseif ( isset($periode) && periode == "annee" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Tmoney</span> de l'annee  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Tmoney</span> du <span style="font-weight: bold;"> {{ date_format(date_create($date_debut),'d-m-Y') }} </span> au  <span style="font-weight: bold">{{ date_format(date_create($date_fin),'d-m-Y') }}</span></h4>
              @else 
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Tmoney</span> du  <span style="font-weight: bold">{{ date('d-m-Y') }}</span></h4>
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
    
                  @foreach ( $tmoney->transactions as $transaction )
                  <tr>
                  
                    <td>{{ $transaction['numero'] }}</td>
                    <td>{{ number_format($transaction['montant'],0,',','.')  }}</td>
                    <td>{{ ucfirst($transaction->transaction_operation_type['nom']) }}</td>
                    <td>{{ date_format(date_create($transaction['created_at']),'d-m-Y') }}</td>
                    <td><a href="{{ url('more_transaction') }}/{{ $transaction['id'] }}">Plus</a></td>
                    
                </tr>             
                  @endforeach
                </tbody>
              </table>
              <h5>Nombre Total de Transaction: <span style="font-weight: bold"> {{ $tmoney->transactions->count() }} </span></h5>
              @if ( isset($periode) && periode == "mois" )
              <a href="{{ url('recapitulatif_tmoney')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "semaine" )
              <a href="{{ url('recapitulatif_tmoney')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "annee" )
              <a href="{{ url('recapitulatif_tmoney')}}/?periode=annee"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <a href="{{ url('recapitulatif_tmoney')}}/?date_debut={{$date_debut}}&date_fin={{$date_fin}}"><button class="btn btn-primary">Imprimer</button></a>
              @else 
              <a href="{{ url('recapitulatif_tmoney')}}/?periode=today"><button class="btn btn-primary">Imprimer</button></a>
              @endif


              <br/>
              <br/>

              
              @if ( isset($periode) && periode == "mois" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Ria</span> du mois  <span style="font-weight: bold;"> {{ date('m') }} </span></h4>
              @elseif ( isset($periode) && periode == "semaine" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Ria</span> de la semaine  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
              @elseif ( isset($periode) && periode == "annee" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Ria</span> de l'annee  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Ria</span> du {{ date_format(date_create($date_debut),'d-m-Y') }} </span> au  <span style="font-weight: bold">{{ date_format(date_create($date_fin),'d-m-Y') }}</span></h4>
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
                    <td>{{ number_format($transaction['montant'],0,',','.')  }}</td>
                    <td>{{ ucfirst($transaction->transaction_operation_type['nom']) }}</td>
                    <td>{{ date_format(date_create($transaction['created_at']),'d-m-Y') }}</td>
                    <td><a href="{{ url('more_transaction') }}/{{ $transaction['id'] }}">Plus</a></td>
                    
                </tr>             
                  @endforeach
                </tbody>
              </table>
              <h5>Nombre Total de Transaction: <span style="font-weight: bold"> {{ $ria->transactions->count() }} </span></h5>
              @if ( isset($periode) && periode == "mois" )
              <a href="{{ url('recapitulatif_ria')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "semaine" )
              <a href="{{ url('recapitulatif_ria')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "annee" )
              <a href="{{ url('recapitulatif_ria')}}/?periode=annee"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <a href="{{ url('recapitulatif_ria')}}/?date_debut={{$date_debut}}&date_fin={{$date_fin}}"><button class="btn btn-primary">Imprimer</button></a>
              @else 
              <a href="{{ url('recapitulatif_ria')}}/?periode=today"><button class="btn btn-primary">Imprimer</button></a>
              @endif

              <br/>
              <br/>

              @if ( isset($periode) && periode == "mois" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Western Union</span> du mois  <span style="font-weight: bold;"> {{ date('m') }} </span></h4>
              @elseif ( isset($periode) && periode == "semaine" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Western Union</span> de la semaine  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
              @elseif ( isset($periode) && periode == "annee" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Western Union</span> de l'annee  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Western Union</span> du {{ date_format(date_create($date_debut),'d-m-Y') }} </span> au  <span style="font-weight: bold">{{ date_format(date_create($date_fin),'d-m-Y') }}</span></h4>
              @else 
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Western Union</span> du  <span style="font-weight: bold">{{ date('d-m-Y') }}</span></h4>
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
    
                  @foreach ( $western_union->transactions as $transaction )
                  <tr>
                  
                    <td>{{ $transaction['numero'] }}</td>
                    <td>{{ number_format($transaction['montant'],0,',','.')  }}</td>
                    <td>{{ ucfirst($transaction->transaction_operation_type['nom']) }}</td>
                    <td>{{ date_format(date_create($transaction['created_at']),'d-m-Y') }}</td>
                    <td><a href="{{ url('more_transaction') }}/{{ $transaction['id'] }}">Plus</a></td>
                    
                </tr>             
                  @endforeach
                </tbody>
              </table>
              <h5>Nombre Total de Transaction: <span style="font-weight: bold"> {{ $western_union->transactions->count() }} </span></h5>
              @if ( isset($periode) && periode == "mois" )
              <a href="{{ url('recapitulatif_western_union')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "semaine" )
              <a href="{{ url('recapitulatif_western_union')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "annee" )
              <a href="{{ url('recapitulatif_western_union')}}/?periode=annee"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <a href="{{ url('recapitulatif_western_union')}}/?date_debut={{$date_debut}}&date_fin={{$date_fin}}"><button class="btn btn-primary">Imprimer</button></a>
              @else 
              <a href="{{ url('recapitulatif_western_union')}}/?periode=today"><button class="btn btn-primary">Imprimer</button></a>
              @endif

              <h4></h4>

              <br/>
              <br/>


              

              @if ( isset($periode) && periode == "mois" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Moneygram</span> du mois  <span style="font-weight: bold;"> {{ date('m') }} </span></h4>
              @elseif ( isset($periode) && periode == "semaine" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Moneygram</span> de la semaine  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
              @elseif ( isset($periode) && periode == "annee" )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Moneygram</span> de l'annee  <span style="font-weight: bold;"> {{ date('Y') }} </span></h4>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Moneygram</span> du {{ date_format(date_create($date_debut),'d-m-Y') }} </span> au  <span style="font-weight: bold">{{ date_format(date_create($date_fin),'d-m-Y') }}</span></h4>
              @else 
              <h4 class="text-center" " style="text-decoration: underline"> Liste des Transactions <span style="font-weight: bold">Moneygram</span> du  <span style="font-weight: bold">{{ date('d-m-Y') }}</span></h4>
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
    
                  @foreach ( $moneygram->transactions as $transaction )
                  <tr>
                  
                    <td>{{ $transaction['numero'] }}</td>
                    <td>{{ number_format($transaction['montant'],0,',','.')  }}</td>
                    <td>{{ ucfirst($transaction->transaction_operation_type['nom']) }}</td>
                    <td>{{ date_format(date_create($transaction['created_at']),'d-m-Y') }}</td>
                    <td><a href="{{ url('more_transaction') }}/{{ $transaction['id'] }}">Plus</a></td>
                    
                </tr>             
                  @endforeach
                </tbody>
              </table>
              <h5>Nombre Total de Transaction: <span style="font-weight: bold"> {{ $moneygram->transactions->count() }} </span></h5>
              @if ( isset($periode) && periode == "mois" )
              <a href="{{ url('recapitulatif_moneygram')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "semaine" )
              <a href="{{ url('recapitulatif_moneygram')}}/?periode=mois"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($periode) && periode == "annee" )
              <a href="{{ url('recapitulatif_moneygram')}}/?periode=annee"><button class="btn btn-primary">Imprimer</button></a>
              @elseif ( isset($date_debut) && isset($date_fin)  )
              <a href="{{ url('recapitulatif_moneygram')}}/?date_debut={{$date_debut}}&date_fin={{$date_fin}}"><button class="btn btn-primary">Imprimer</button></a>
              @else 
              <a href="{{ url('recapitulatif_moneygram')}}/?periode=today"><button class="btn btn-primary">Imprimer</button></a>
              @endif

</div>

@endsection