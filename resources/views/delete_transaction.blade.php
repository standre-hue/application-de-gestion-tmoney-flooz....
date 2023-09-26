@extends('layout')
@section('body')
<div class="content-wrapper">
    <section class="content">
        <div class="error-page">
          <h2 class="headline text-danger"><i class="fas fa-exclamation-triangle text-danger"></i></h2>
  
          <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Avertissement.</h3>
  
            <p>
                Voulez vous supprimer la <b>{{$transaction['transaction_operation_type']['nom']}} {{$transaction['transaction_type']['nom']}}  de {{number_format($transaction['montant'],0,',','.')}} </b> effectue par le numero <b>{{$transaction['numero']}}</b>? La transaction sera toujours disponible dans les archives
            </p>
  
            <form class="search-form" method="post">
              <div class="">
                {{ csrf_field() }}
                <div>
                  <textarea placeholder="motif de suppression" required class="form-control"  type="textarea"  name="motif" ></textarea>
                  <br/>
                </div>
                <div class="input-group-append">
                    <a href="{{ url('more_transaction') }}/{{ $transaction['id'] }}" class="btn btn-dark" style="margin-right: 10px">Annuler
                    </a>
                  <button  type="submit" name="submit" class="btn btn-danger">Supprimer
                  </button>
                  <
                </div>
              </div>
              <!-- /.input-group -->
            </form>
          </div>
        </div>
        <!-- /.error-page -->
  
      </section>
</div>
@endsection()