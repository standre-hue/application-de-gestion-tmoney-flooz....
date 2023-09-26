@extends('layout')
@section('body')


<div class="content-wrapper">
<div class="card card-primary">
    <!--<div class="card-header">
      <h3 class="card-title">Enregistrer une transaction</h3>
    </div>-->
    <!-- /.card-header -->
    <!-- form start -->

    <form  action="" method='post'style="width:700px" >
        {{ csrf_field() }}
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Compte</label>
          <select class="form-control" disabled name='type'>
            <option value="{{$compte['type_compte']}}">{{  Str::upper($compte['type_compte']) }}</option>            
          </select>
        </div>



        <div class="form-group">
            <label for="exampleInputPassword1">Montant</label>
            <input type='number' min='2000' name='montant' required  class="form-control" id="exampleInputPassword1" placeholder="Montant">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer" style="width:100%;display:flex;justify-content:space-between" >
        <button type="submit" style="width:48%" class="btn btn-primary">Enregistrer</button>
        <button type="button"style="width:48%"  class="btn btn-dark">Annuler</button>
      </div>
    </form>


    @if (Session::has('save'))
    <div class="toast show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="..." class="rounded mr-2" alt="...">
          <strong class="mr-auto">Succes</strong>
          <small>11 mins ago</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          Approvisionnement effectue.
        </div>
        <script>
            var toast = document.querySelector('.toast')
            setTimeout(() => {
                toast.classList.remove('show')
            }, 2000);
        </script>
      </div>
    @endif

</div>

</div>
@endsection