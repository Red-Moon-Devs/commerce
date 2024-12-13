@extends('admin.dashboard')

@section('content')
<div class="main-panel">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des utilisateurs</h4>

                <!-- Affichage du message de succès -->
                @if(session('success'))
                    <div id="successMessage" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Message d'erreur -->
                @if(session('error'))
                    <div id="errorMessage" class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <script>
                    // Disparition des messages après 3 secondes
                    window.onload = function() {
                        // Masquer le message de succès après 3 secondes
                        setTimeout(function() {
                            var successMessage = document.getElementById('successMessage');
                            if (successMessage) {
                                successMessage.style.display = 'none'; // Cacher le message de succès
                            }
                        }, 3000); // 3000 ms = 3 secondes

                        // Masquer le message d'erreur après 3 secondes
                        setTimeout(function() {
                            var errorMessage = document.getElementById('errorMessage');
                            if (errorMessage) {
                                errorMessage.style.display = 'none'; // Cacher le message d'erreur
                            }
                        }, 3000); // 3000 ms = 3 secondes
                    }

                    
                </script>

               


                <!-- Conteneur avec scrollbar -->
                <div class="table-responsive pt-3" style="max-height: 380px; overflow-y: auto;">
                    <table class="table table-bordered">
                    <thead>
                            <tr>
                                <th>#</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                   
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUsermodal{{ $user->id }}" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                </td>
                               
                            </tr>


                            <div class="modal fade" id="deleteUsermodal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUsermodal{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteUserModalLabel{{ $user->id }}">Confirmation de suppression</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Êtes-vous sûr de vouloir supprimer cet Utilisateur ? Cette action sera irréversible.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- Fin du conteneur avec scrollbar -->
            </div>
        </div>
    </div>
</div>




@endsection
