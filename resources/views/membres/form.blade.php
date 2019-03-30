@extends('index')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                    <div class="row flex-grow">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <h4>Liste des membres</h4>
                                        <button type="button" class="btn btn-success right"
                                                style="position: absolute;right: 10px;top: 20px" data-toggle="modal"
                                                data-target="#ajoutMembre">Ajouter
                                        </button>
                                    </div>

                                    <table class="table" id="searchable-table">
                                        <thead>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Téléphone</th>
                                        <th>E-mail</th>
                                        <th></th>
                                        </thead>
                                        <tbody>
                                        @foreach($membres as $membre)
                                            <tr>
                                                <td>{{ $membre->nom }}</td>
                                                <td>{{ $membre->prenom }}</td>
                                                <td>{{ $membre->telephone }}</td>
                                                <td>{{ $membre->email }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <button type="button"
                                                                    class="btn btn-icons btn-rounded btn-outline-primary"
                                                                    data-toggle="modal"
                                                                    data-target="#modifierMembre"
                                                                    data-id="{{$membre->id}}"
                                                                    data-nom="{{$membre->nom}}"
                                                                    data-prenom="{{$membre->prenom}}"
                                                                    data-email="{{$membre->email}}"
                                                                    data-date-naissance="{{$membre->dateNaissance}}"
                                                                    data-telephone="{{$membre->telephone}}"
                                                                    data-cin="{{$membre->cin}}"
                                                                    data-adresse="{{$membre->adresse}}"
                                                                    data-date-entree="{{$membre->dateEntree}}">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-4">
                                                            <button type="button"
                                                                    class="btn btn-icons btn-rounded btn-outline-success"
                                                                    data-toggle="modal"
                                                                    data-target="#detailMembre"
                                                                    data-id="{{$membre->id}}"
                                                                    data-nom="{{$membre->nom}}"
                                                                    data-prenom="{{$membre->prenom}}"
                                                                    data-email="{{$membre->email}}"
                                                                    data-date-naissance="{{$membre->dateNaissance}}"
                                                                    data-telephone="{{$membre->telephone}}"
                                                                    data-cin="{{$membre->cin}}"
                                                                    data-adresse="{{$membre->adresse}}"
                                                                    data-date-entree="{{$membre->dateEntree}}">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-4">
                                                            <form action="/membres/{{ $membre->id }}" method="post"
                                                                  class="membreDelete">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit"
                                                                        class="btn btn-icons btn-rounded btn-outline-danger">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
                    <a href="#" target="_blank">Bootstrapdash</a>. All rights reserved.
                </span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
                    <i class="mdi mdi-heart text-danger"></i>
                </span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->



    <!-- Modal Ajout membre -->
    <div class="modal fade" id="ajoutMembre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau membre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="forms-sample" action="/membres" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputName1">Nom</label>
                            <input type="text" name="nom" class="form-control" id="exampleInputName1"
                                   placeholder="Nom">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Prénom</label>
                            <input type="text" name="prenom" class="form-control" id="exampleInputEmail2"
                                   placeholder="Prénom">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword3">E-mail</label>
                            <input type="email" name="email" class="form-control" id="exampleInputPassword3"
                                   placeholder="E-mail">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputCity4">Date naissance</label>
                            <input type="text" name="dateNaissance" class="form-control" id="exampleInputCity4"
                                   placeholder="dd/mm/yyy">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity5">Téléphone</label>
                            <input type="text" name="telephone" class="form-control" id="exampleInputCity5"
                                   placeholder="Téléphone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity6">C.I.N</label>
                            <input type="text" name="cin" class="form-control" id="exampleInputCity6"
                                   placeholder="C.I.N">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity7">Adresse</label>
                            <input type="text" name="adresse" class="form-control" id="exampleInputCity7"
                                   placeholder="Adresse">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity8">Date d'entée</label>
                            <input type="text" name="dateEntree" class="form-control" id="exampleInputCity8"
                                   placeholder="Date d'entrée">
                        </div>
                        <button type="submit" class="btn btn-success mr-2" style="float: right">Ajouter</button>
                        <button type="button" data-dismiss="modal" class="btn btn-light">Annuler</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modifier Modal -->

    <div class="modal fade" id="modifierMembre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier membre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="forms-sample" method="post">
                        @method('patch')
                        @csrf

                        <input type="hidden" id="idMembre" name="membre_id" value="">

                        <div class="form-group">
                            <label for="exampleInputName1">Nom</label>
                            <input type="text" name="nom" class="form-control" id="nom">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Prénom</label>
                            <input type="text" name="prenom" class="form-control" id="prenom">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword3">E-mail</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity4">Date naissance</label>
                            <input type="text" name="dateNaissance" class="form-control" id="dateNaissance">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity5">Téléphone</label>
                            <input type="text" name="telephone" class="form-control" id="telephone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity6">C.I.N</label>
                            <input type="text" name="cin" class="form-control" id="cin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity7">Adresse</label>
                            <input type="text" name="adresse" class="form-control" id="adresse">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity8">Date d'entée</label>
                            <input type="text" name="dateEntree" class="form-control" id="dateEntree">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" style="float: right">Modifier</button>
                        <button type="button" data-dismiss="modal" class="btn btn-light">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailMembre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Détails</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="collection">
                        <li class="collection-item">
                            <strong>Nom :</strong>
                            <span style="float: right;width: 50%;text-align: left;" id="nom"></span>
                        </li>
                        <li class="collection-item">
                            <strong>Prénom :</strong>
                            <span style="float: right;width: 50%;text-align: left;" id="prenom"></span>
                        </li>
                        <li class="collection-item">
                            <strong>E-mail :</strong>
                            <span style="float: right;width: 50%;text-align: left;" id="email"></span>
                        </li>
                        <li class="collection-item">
                            <strong>Date naissance :</strong>
                            <span style="float: right;width: 50%;text-align: left;" id="dateNaissance"></span>
                        </li>
                        <li>
                            <strong>Téléphone :</strong>
                            <span style="float: right;width: 50%;text-align: left;" id="telephone"></span>
                        </li>
                        <li>
                            <strong>C.I.N :</strong>
                            <span style="float: right;width: 50%;text-align: left;" id="cin"></span>
                        </li>
                        <li>
                            <strong>Adresse :</strong>
                            <span style="float: right;width: 50%;text-align: left;" id="adresse"></span>
                        </li>
                        <li>
                            <strong>Date entrée :</strong>
                            <span style="float: right;width: 50%;text-align: left;" id="dateEntree"></span>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script.form')

    <script type="text/javascript">
        $('#modifierMembre').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var idMembre = button.data('id')
            var nom = button.data('nom')
            var prenom = button.data('prenom')
            var email = button.data('email')
            var dateNaissance = button.data('dateNaissance')
            var telephone = button.data('telephone')
            var cin = button.data('cin')
            var adresse = button.data('adresse')
            var dateEntree = button.data('dateEntree')
            var modal = $(this);

            modal.find('.modal-body #idMembre').val(idMembre);
            modal.find('.modal-body #nom').val(nom);
            modal.find('.modal-body #prenom').val(prenom);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #dateNaissance').val(dateNaissance);
            modal.find('.modal-body #telephone').val(telephone);
            modal.find('.modal-body #cin').val(cin);
            modal.find('.modal-body #adresse').val(adresse);
            modal.find('.modal-body #dateEntree').val(dateEntree);
            modal.find('.modal-body form').attr('action', '/membres/'+idMembre)
        })

        $('#detailMembre').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var id = button.data('id')
            var nom = button.data('nom')
            var prenom = button.data('prenom')
            var email = button.data('email')
            var dateNaissance = button.data('dateNaissance')
            var telephone = button.data('telephone')
            var cin = button.data('cin')
            var adresse = button.data('adresse')
            var dateEntree = button.data('dateEntree')
            var modal = $(this)

            modal.find('.modal-body #id').text(id);
            modal.find('.modal-body #nom').text(nom);
            modal.find('.modal-body #prenom').text(prenom);
            modal.find('.modal-body #email').text(email);
            modal.find('.modal-body #dateNaissance').text(dateNaissance);
            modal.find('.modal-body #telephone').text(telephone);
            modal.find('.modal-body #cin').text(cin);
            modal.find('.modal-body #adresse').text(adresse);
            modal.find('.modal-body #dateEntree').text(dateEntree);

        })
    </script>
@endsection
