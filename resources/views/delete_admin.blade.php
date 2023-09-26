@extends('layout')
@section('body')
<div class="content-wrapper">
    <section class="content">
        <div class="error-page">
          <h2 class="headline text-danger">500</h2>
  
          <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Avertissement.</h3>
  
            <p>
                Voulez vous supprimer l'administrateur <b>{{ $user['nom'] }} {{ $user['prenom'] }}</b>? il ne pourras plus se connecter a l'application
            </p>
  
            <form class="search-form" method="post">
              <div class="input-group">
                {{ csrf_field() }}
  
                <div class="input-group-append">
                    <a href="{{ url('more_admin') }}/{{ $user['id'] }}" class="btn btn-dark" style="margin-right: 10px">Annuler
                    </a>
                  <button type="submit" name="submit" class="btn btn-danger">Supprimer
                  </button>
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