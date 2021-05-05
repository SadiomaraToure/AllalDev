
<x-adminapp-layout>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Enregistrement Admin ALAL</h3>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Echec enregistrement.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admins.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="form-group">
                    <strong>Nom:</strong>
                    <input type="text" name="nom" class="form-control">
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="form-group">
                    <strong>Prenom:</strong>
                    <input type="text" name="prenom" class="form-control">
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="form-group">
                    <strong>Téléphone:</strong>
                    <input type="text" name="telephone" class="form-control">
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="form-group">
                    <strong>E-mail:</strong>
                    <input type="text" name="email" class="form-control">
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="form-group">
                    <strong>Sexe:</strong>
                    <select name="sexe" class="form-control">
  <option value="M">Masculin</option>
  <option value="F">Feminin</option>
</select>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="form-group">
                    <strong>Matricule:</strong>
                    <input type="text" name="matricule" class="form-control">
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="form-group">
                    <strong>Profil:</strong>
                    <select name="profil" class="form-control">
  <option value="PRESIDENT_REGIONAL">PRESIDENT REGIONAL</option>
  <option value="PRESIDENT_ASC">PRESIDENT ASC</option>
  <option value="PRESIDENT ZONE">PRESIDENT ZONE</option>
  <option value="ARBITRE">ARBITRE</option>

</select>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <button type="submit" class="btn btn-success">Ajouter Admin</button>
            </div>
        </div>

    </form>
    </x-adminapp-layout>

