@extends('layout')
@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Transaction Detail</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Type Transaction</span>
                      <span class="info-box-number text-center text-muted mb-0">{{ ucfirst($transaction->transaction_type['nom']) }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Numero</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ $transaction['numero'] }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Type Transaction</span>
                        <span class="info-box-number text-center text-muted mb-0">{{ ucfirst($transaction->transaction_operation_type['nom']) }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Montant</span>
                        <span class="info-box-number text-center text-muted mb-0">{{  number_format($transaction['montant'],0,',','.')  }}</span>
                      </div>
                    </div>
                  </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Date</span>
                      <span class="info-box-number text-center text-muted mb-0">{{ date_format(date_create($transaction['created_at']),'d-m-Y') }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Heure</span>
                      <span class="info-box-number text-center text-muted mb-0"> {{ date_format(date_create($transaction['created_at']),'H:i:s') }} <span>
                    </div>
                  </div>
                </div>
              </div>
              @if ($transaction['deleted'] == true)
              <h5>Motif de Suppression: <b style="margin-bottom: 40px;">{{$transaction['motif']}}</b></h5>
              
              @endif
              <div class="row">
                <div class="col-12">
                  <h4>Administrateur</h4>
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#" style="font-size: 20px;">{{ $transaction->log->user['nom'] }} {{ $transaction->log->user['prenom'] }}</a>
                        </span>
                        <span class="description">Avec nous depuis  {{ date_format(date_create($transaction->log->user['created_at']),'d-m-Y')  }} </span>
                      </div>
                      <!-- /.user-block -->

  
                    </div>

               

                  
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2" style="width: 100%">
              @if ($transaction['deleted'] == true)
              <a ><button  disabled class="btn btn-danger"> Supprimer</button></a>
              
              @else
              <a href="{{ url('delete_transaction')}}/{{ $transaction['id']}}"><button  class="btn btn-danger">Supprimer</button></a>
              @endif
                            
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection