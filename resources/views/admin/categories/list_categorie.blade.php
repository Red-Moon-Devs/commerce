@extends('admin.dashboard')

@section('content')
<div class="main-panel">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des catégories</h4>

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

                <!-- Button to Open Create Category Modal -->
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategoryModal">
                        <i class="fas fa-plus"></i> Ajouter une catégorie
                    </button>
                </div>

                <!-- Conteneur avec scrollbar -->
                <div class="table-responsive pt-3" style="max-height: 380px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Libellé</th>
                                <th>Description</th>
                                <th>Proportion des produits par catégories</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $categorie)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $categorie->libelle }}</td>
                                    <td>{{ $categorie->description }}</td>
                                    <td>
                                            @php
                                                $produitsCount = $categorie->produits->count();
                                                $progress = $totalProduits > 0 ? ($produitsCount / $totalProduits) * 100 : 0;
                                            @endphp
                                            <div class="progress">
                                                <div class="progress-bar 
                                                    @if($progress <= 25) bg-danger 
                                                    @elseif($progress <= 50) bg-warning 
                                                    @elseif($progress <= 75) bg-info
                                                    @else bg-success @endif" 
                                                    role="progressbar" 
                                                    style="width: {{ $progress }}%" 
                                                    aria-valuenow="{{ $progress }}" 
                                                    aria-valuemin="0" 
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                    </td>
                                    <td>
                                        <!-- Button to Open Edit Category Modal with Icon -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCategoryModal{{ $categorie->id }}" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        
                                        <!-- Confirmation Delete Button with Icon -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCategoryModal{{ $categorie->id }}" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal for Editing Category -->
                                <div class="modal fade" id="editCategoryModal{{ $categorie->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel{{ $categorie->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryModalLabel{{ $categorie->id }}">Modifier la catégorie</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('categories.update', $categorie->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="libelle">Libellé</label>
                                                        <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $categorie->libelle }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control" id="description" name="description" required>{{ $categorie->description }}</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-warning">Mettre à jour</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for Deleting Category (Confirmation Popup) -->
                                <div class="modal fade" id="deleteCategoryModal{{ $categorie->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel{{ $categorie->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteCategoryModalLabel{{ $categorie->id }}">Confirmation de suppression</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Êtes-vous sûr de vouloir supprimer cette catégorie ? Cette action sera irréversible.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                                                <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display:inline;">
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

<!-- Modal for Creating Category -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Créer une nouvelle catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="libelle">Libellé</label>
                        <input type="text" class="form-control" id="libelle" name="libelle" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
