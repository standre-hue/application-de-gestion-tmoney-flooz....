 @extends('layout')
 @section('body')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info" >
              <div class="inner">
                <p>Flooz</p>
                <h3>{{ number_format($flooz->transactions->count(),0,',','.') }}</h3>
                
                <a href="#" class="small-box-footer text-white" style="font-size:25px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                </svg>  {{ number_format($flooz_retrait_total,0,',','.') }} </a>
                <a href="#" class="small-box-footer text-dark" style="font-size:25px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                </svg> {{ number_format($flooz_depot_total,0,',','.')  }} </a>

                
              </div>
              <div class="icon" style="">
                <img class="ion" src="dist/img/flooz.jpeg" style="width: 70px;height:70px;position: absolute;margin-top:-110px;margin-left:160px;" />
                <i class="ion ion-bag"></i>
                
              </div>
              <a href="{{ url('liste_transaction')  }}?type=flooz" class="small-box-footer">Plus<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background: rgb(254, 237, 0)">
              <div class="inner">
                <p>Tmoney</p>
                <h3>{{ number_format($tmoney->transactions->count(),0,',','.') }}</h3>
                
                <a href="#" class="small-box-footer text-white" style="font-size:25px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                </svg>  {{ number_format($tmoney_retrait_total,0,',','.') }} </a>
                <a href="#" class="small-box-footer text-dark" style="font-size:25px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                </svg> {{ number_format($tmoney_depot_total,0,',','.')  }} </a>
              </div>
              <div class="icon">
                <img class="ion" src="dist/img/tmoney.png" style="width: 90px;height:70px;position: absolute;margin-top:-110px;margin-left:150px;" />
                
              </div>
              <a href="{{ url('liste_transaction')  }}?type=tmoney" class="small-box-footer">Plus<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="background: rgb(250,110,0)">
              <div class="inner">
                <p>Ria</p>
                <h3>{{ number_format($ria->transactions->count(),0,',','.') }}</h3>
                
                <a href="#" class="small-box-footer text-white" style="font-size:25px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                </svg>  {{ number_format($ria_retrait_total,0,',','.') }} </a>
                <a href="#" class="small-box-footer text-dark" style="font-size:25px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                </svg> {{ number_format($ria_depot_total,0,',','.')  }} </a>
              </div>
              <div class="icon">
                <img class="ion" src="dist/img/ria.png" style="width: 90px;height:70px;position: absolute;margin-top:-110px;margin-left:150px;" />
               
              </div>
              <a href="{{ url('liste_transaction')  }}?type=ria" class="small-box-footer">Plus<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <p>Western Union</p>
                <h3>{{ number_format($western_union->transactions->count(),0,',','.') }}</h3>
                
                <a href="#" class="small-box-footer text-white" style="font-size:25px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                </svg>  {{ number_format($western_union_retrait_total,0,',','.') }} </a>
                <a href="#" class="small-box-footer text-dark" style="font-size:25px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                </svg> {{ number_format($western_union_depot_total,0,',','.')  }} </a>
              </div>
              <div class="icon">
                <img class="ion" src="dist/img/western.png" style="width: 70px;height:70px;position: absolute;margin-top:-110px;margin-left:160px;" />
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ url('liste_transaction')  }}?type=western union" class="small-box-footer">Plus<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <p>Moneygram</p>
                <h3>{{ number_format($moneygram->transactions->count(),0,',','.') }}</h3>
                
                <a href="#" class="small-box-footer text-white" style="font-size:25px"  ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                </svg>  {{ number_format($moneygram_retrait_total,0,',','.') }} </a>
                <a href="#" class="small-box-footer text-dark" style="font-size:25px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                </svg> {{ number_format($moneygram_depot_total,0,',','.')  }} </a>
              </div>
              <div class="icon">
                <img class="ion" src="dist/img/money.png" style="width: 70px;height:70px;position: absolute;margin-top:-110px;margin-left:160px;" />
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ url('liste_transaction')  }}?type=western union" class="small-box-footer">Plus<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="card">
          <div class="card-header row" style="display: flex;justify-content:space-between">
            <h3 class="card-title" style="display: flex">
              <i class="fas fa-money mr-1"></i>
              Transaction(s) du jour: <span style="font-weight: bold">{{ number_format($transactions_du_jour->count(),0,',','.') }}</span>
            </h3>
            

          </div>
          <table class="table datatable">
            <thead>                  
              <tr>
                <th  style="width: 0px;diplay:none;">Type Transaction</th>
                <th  style="width: 50px">Numero</th>
                <th  style="width: 50px">Type Operation</th>
                <th  style="width: 50px">Montant</th>
                
                <th  style="width: 50px">Date</th>
                <th  style="width: 50px">Heure</th>
                <th  style="width: 50px">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $transactions_du_jour as $transaction )
              <tr>
                <td>{{ ucfirst($transaction->transaction_type['nom']) }}</td>
                <td>{{ $transaction['numero'] }}</td>
                <td>{{ ucfirst($transaction->transaction_operation_type['nom']) }}</td>
                <td>{{ number_format($transaction['montant'],0,',','.') }}</td>
                
                <td>{{ date_format(date_create($transaction['created_at']),'d-m-Y') }}</td>
                <td>{{ date_format(date_create($transaction['created_at']),'H:i:s') }}</td>
                <td><a href="{{ url('more_transaction') }}/{{ $transaction['id'] }}">Plus</button></td>
              </tr>
              @endforeach


            </tbody>
          </table><!-- /.card-body -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="" style="widt:100%">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header row" style="display: flex;justify-content:space-between">
                <h3 class="card-title" style="display: flex">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Recapitulatif  Transaction:  <span style="font-weight: bold">{{ date('d-m-Y') }}</span>
                  <a href="{{ url('recapitulatif') }}"><button  id='print' class="btn btn-primary" style="width:100px;margin-left:70px;">Imprimer</button></a>
                </h3>
              </div>
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
                        <td>{{ number_format($data3[0][0],0,',','.') }}</td>
                        <td>{{ number_format($data3[0][1],0,',','.') }}</td>
                        <td>{{ number_format($data3[0][2],0,',','.') }}</td>
                        <td>{{ number_format($data3[0][3],0,',','.') }}</td>
                        <td>{{ number_format($data3[0][4],0,',','.') }}</td>
                        <td><span style="font-weight: bold">{{ number_format($data3[0][0] + $data3[0][1] + $data3[0][2] + $data3[0][3] + $data3[0][4],0,',','.') }}</span></td>
                        
                    </tr>
                    <tr>
                        <th style="width: 40px">Nombre de Depot</th>
                        <td>{{ number_format($data3[1][0],0,',','.') }}</td>
                        <td>{{ number_format($data3[1][1],0,',','.') }}</td>
                        <td>{{ number_format($data3[1][2],0,',','.') }}</td>
                        <td>{{ number_format($data3[1][3],0,',','.') }}</td>
                        <td>{{ number_format($data3[1][4],0,',','.') }}</td>
                        <td><span style="font-weight: bold">{{ number_format($data3[1][0] + $data3[1][1] + $data3[1][2] + $data3[1][3] + $data3[1][4],0,',','.') }}</span></td>
                        
                    </tr>
                    <tr>
                        <th style="width: 40px">Montant Total Retrait</th>
                        <td>{{ number_format($data3[2][0],0,',','.') }}</td>
                        <td>{{ number_format($data3[2][1],0,',','.') }}</td>
                        <td>{{ number_format($data3[2][2],0,',','.') }}</td>
                        <td>{{ number_format($data3[2][3],0,',','.') }}</td>
                        <td>{{ number_format($data3[2][4],0,',','.') }}</td>
                        <td><span style="font-weight: bold;">{{ number_format($data3[2][0] + $data3[2][1] + $data3[2][2] + $data3[2][3] + $data3[2][4],0,',','.') }}</span></td>
                        
                    </tr>
                    <tr>
                        <th style="width: 40px">Montant Total Depot</th>
                        <td>{{ number_format($data3[3][0],0,',','.') }}</td>
                        <td>{{ number_format($data3[3][1],0,',','.') }}</td>
                        <td>{{ number_format($data3[3][2],0,',','.') }}</td>
                        <td>{{ number_format($data3[3][3],0,',','.') }}</td>
                        <td>{{ number_format($data3[3][4],0,',','.') }}</td>
                        <td><span style="font-weight: bold">{{ number_format($data3[3][0] + $data3[3][1] + $data3[3][2] + $data3[3][3] + $data3[3][4],0,',','.') }}</span></td>
                    </tr>
                </tbody>
              </table>
            </div>
            <div class="card">
              <div class="card-header row" style="display: flex;justify-content:space-between">
                <h3 class="card-title" style="display: flex">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Recapitulatif Annuel Montant de Transaction:  <span style="font-weight: bold">{{ date('Y') }}</span>
                  <a href="{{ url('statistique_annuel') }}"><button  id='print' class="btn btn-primary" style="width:100px;margin-left:70px;">Imprimer</button></a>
                </h3>
                

              </div>
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
                    <td>{{ number_format($datum[1][0],0,',','.') }}</td>
                    <td>{{ number_format($datum[1][1],0,',','.') }}</td>
                    <td>{{ number_format($datum[2][0],0,',','.') }}</td>
                    <td>{{ number_format($datum[2][1],0,',','.') }}</td>
                    <td>{{ number_format($datum[3][0],0,',','.') }}</td>
                    <td>{{ number_format($datum[3][1],0,',','.') }}</td>
                    <td>{{ number_format($datum[4][0],0,',','.') }}</td>
                    <td>{{ number_format($datum[4][1],0,',','.') }}</td>
                    <td>{{ number_format($datum[5][0],0,',','.') }}</td>
                    <td>{{ number_format($datum[5][1],0,',','.') }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td style="width: 0px;font-weight:bold">Total
                    </td>
                    <td style="font-weight:bold">{{ number_format($data2['flooz'][0],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['flooz'][1],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['tmoney'][0],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['tmoney'][1],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['ria'][0],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['ria'][1],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['western_union'][0],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['western_union'][1],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['moneygram'][0],0,',','.') }}</td>
                    <td style="font-weight:bold">{{ number_format($data2['moneygram'][1],0,',','.') }}</td>
                  </tr>

                </tbody>
              </table><!-- /.card-body -->
              <h4>Nombre Total Transaction: <span style="font-weight: bold">{{ number_format($transaction_nombre_total,0,',','.') }}</span></h4>
            </div>
            <br/>
            <div class="card">
              <div class="card-header row" style="display: flex;justify-content:space-between">
                <h3 class="card-title" style="display: flex">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Recapitulatif Annuel Nombre de Transaction:  <span style="font-weight: bold">{{ date('Y') }}</span>
                  <a href="{{ url('statistique_annuel_nombre') }}"><button  id='print' class="btn btn-primary" style="width:100px;margin-left:70px;">Imprimer</button></a>
                </h3>
              </div>

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
                    <td>{{ number_format($datum[1][2],0,',','.') }}</td>
                    <td>{{ number_format($datum[1][3],0,',','.') }}</td>
                    <td>{{ number_format($datum[2][2],0,',','.') }}</td>
                    <td>{{ number_format($datum[2][3],0,',','.') }}</td>
                    <td>{{ number_format($datum[3][2],0,',','.') }}</td>
                    <td>{{ number_format($datum[3][3],0,',','.') }}</td>
                    <td>{{ number_format($datum[3][2],0,',','.') }}</td>
                    <td>{{ number_format($datum[4][3],0,',','.') }}</td>
                    <td>{{ number_format($datum[5][2],0,',','.') }}</td>
                    <td>{{ number_format($datum[5][3],0,',','.') }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td style="width: 0px;font-weight:bold">Total
                    </td>
                    <td style="font-weight:bold">{{ number_format($data2['flooz'][2],0,',','.') }}</td>
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
              <h4>Nombre Total Transaction: <span style="font-weight: bold">{{ number_format($transaction_nombre_total,0,',','.') }}</span></h4>

            </div>

  


            <!-- /.card -->

            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary">
              <!--<div class="card-header">
                <h3 class="card-title">Direct Chat</h3>

                <div class="card-tools">
                  <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                          data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>-->
              <!-- /.card-header -->
              
              <!-- /.card-body -->
             
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->

            <!-- TO DO List -->
            
            <!-- /.card -->
          </section>

          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
   
    <!-- /.content -->
  </div>
  <script type="text/javascript"> 
    //window.addEventListener("load", window.print());
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
 @endsection('body')