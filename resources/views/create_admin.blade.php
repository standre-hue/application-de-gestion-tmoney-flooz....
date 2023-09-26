@extends('layout')
@section('body')


<div class="content-wrapper">
<div class="" style="display: flex;background:white">
    <!--<div class="card-header">
      <h3 class="card-title">Enregistrer une transaction</h3>
    </div>-->
    <!-- /.card-header -->
    <!-- form start -->

    <form  action="" method='post' style="width: 700px">
        {{ csrf_field() }}
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Type Administrateur</label>
          <select class="form-control" name='type_admin'>
            <option value='1'>SIMPLE</option>   
            <option value='0'>SUPREME</option>
          </select>
        </div>


        <div class="form-group">
            <label for="exampleInputPassword1">Nom</label>
            <input required  class="form-control" name='nom' id="exampleInputPassword1" placeholder="Nom">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Prenom</label>
            <input required   name='prenom'  class="form-control" id="exampleInputPassword1" placeholder="prenom">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input required  name='email' type="email"  class="form-control" id="exampleInputPassword1" placeholder="Email">
        </div>

      </div>
      <!-- /.card-body -->

      <div class="card-footer" style="width: 100%">
        <button type="submit" style="width: 100%" class="btn btn-primary">Enregistrer</button>
      </div>
    </form>


    @if (Session::has('save'))
    <div class="toast show bg-success" style="height:100px;margin-top:20px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="..." class="rounded mr-2" alt="...">
          <strong class="mr-auto">Succes</strong>
          <small></small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          Administrateur creer avec succes.
        </div>
        <script>
            var toast = document.querySelector('.toast')
            setTimeout(() => {
                toast.classList.remove('show')
            }, 2000);
        </script>
      </div>
    @endif

    @if (Session::has('error'))
    <div class="toast show bg-danger"  style="height:100px;margin-top:20px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="..." class="rounded mr-2" alt="...">
          <strong class="mr-auto">Avertissement</strong>
          <small></small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          {{ Session::get('error')}}.
        </div>
        <script>
            var toast = document.querySelector('.toast')
            setTimeout(() => {
                toast.classList.remove('show')
            }, 6000);
        </script>
      </div>
    @endif

</div>

</div>
@endsection