@extends('layout')
@section('body')


<div class="content-wrapper">
<div class="card-primary" style="display: flex;background:white">
    <!--<div class="card-header">
      <h3 class="card-title">Enregistrer une transaction</h3>
    </div>-->
    <!-- /.card-header -->
    <!-- form start -->

    <form  action="" method='post' style="width:700px">
        {{ csrf_field() }}
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Type Transaction</label>
          <select class="form-control" name='type'>
            <option value='tmoney'>TMONEY</option>
            <option value='flooz'>FLOOZ</option>
            <option value='ria'>RIA</option>
            <option value='western union'>WESTERN UNION</option>
            <option value='moneygram'>MONEYGRAM</option>
            
          </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Type Operation</label>
            <select class="form-control" name='type_operation'>
                <option value='depot'>DEPOT</option>
                <option value='retrait'>RETRAIT</option>
              </select>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Numero de telephone</label>
            <input required  class="form-control" name='numero' id="exampleInputPassword1" placeholder="Numero de telephone">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Montant</label>
            <input required type='number' min='500' name='montant'  class="form-control" id="exampleInputPassword1" placeholder="Montant">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer" style="width:100%;"  >
        <button type="submit" style="width:100%;"  class="btn btn-primary" >Enregistrer</button>
      </div>
    </form>


    @if (Session::has('save'))
    <div class="toast show bg-success" style="height:100px;margin-top:20px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="..." class="rounded mr-2" alt="...">
          <strong class="mr-auto">Information</strong>
          <small></small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          Transaction enregistree avec succes.
        </div>
        <script>
            var toast = document.querySelector('.toast')
            setTimeout(() => {
                toast.classList.remove('show')
            }, 3000);
        </script>
      </div>
    @endif

    @if (Session::has('error'))
    <div class="toast show bg-danger" style="height:100px;margin-top:20px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="..." class="rounded mr-2" alt="...">
          <strong class="mr-auto">Avertissement</strong>
          <small></small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          {{Session::get('error')}}.
        </div>
        <script>
            var toast2 = document.querySelector('.toast')
           
            setTimeout(() => {
                toast2.classList.remove('show')
            }, 5000);
        </script>
      </div>
    @endif

</div>

</div>
@endsection