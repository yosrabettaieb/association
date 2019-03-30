@extends('index')
@section('content')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- ***********************************tableau des depenses*******************************-->
            <div class="row">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                    <div class="row flex-grow">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <h4>Liste des dépenses</h4> <!-- class="card-title"-->

                                        <!-- boutton ajouter un depense va appeler modal "add"-->
                                        <button type="button" class="btn btn-success"
                                                style="position: absolute; right: 30px ; top: 30px" ;
                                                data-toggle="modal" data-target="#add">
                                            Ajouter
                                        </button>
                                    </div>
                                    <table class="table table-hover" id="searchable-table">
                                        <thead>
                                        <tr>
                                            <th>Libelle</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Montant</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Paiement</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($depenses as $depense)
                                            <tr>
                                                <td>{{$depense->libelle}}</td>
                                                <td>{{$depense->description}}</td>
                                                <td>{{$depense->montant}}</td>
                                                <td>{{$depense->date}}</td>
                                                <td>{{$depense->payement}}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <!--*********boutton edit******************-->
                                                            <a href="/documentSideBar/{{$depense->id}}/edit"
                                                               class="btn btn-icons btn-rounded btn-outline-primary"
                                                               data-toggle="modal" data-target="#edit"
                                                               data-id="{{$depense->id}}"
                                                               data-libelle="{{$depense->libelle}}"
                                                               data-description="{{$depense->description}}"
                                                               data-montant="{{$depense->montant}}"
                                                               data-date="{{$depense->date}}"
                                                               data-payement="{{$depense->payement}}">
                                                                <i class="glyphicon glyphicon-edit"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-4">
                                                            <button type="button"
                                                                    class="btn btn-icons btn-rounded btn-outline-success"
                                                                    data-toggle="modal" data-target="#myModal"
                                                                    data-id="{{$depense->id}}"
                                                                    data-libelle="{{$depense->libelle}}"
                                                                    data-description="{{$depense->description}}"
                                                                    data-montant="{{$depense->montant}}"
                                                                    data-date="{{$depense->date}}"
                                                                    data-payement="{{$depense->payement}}">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-4">
                                                            <!--*********boutton supprimer******************-->
                                                            <form class="docDelete"
                                                                  action="{{ action('DepensesController@destroy', $depense->id)}}"
                                                                  method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-icons btn-rounded btn-outline-danger">
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
        <!-- ****************************************************************************************
                       *************************************Ajout Modal **************************************
                       ***************************************************************************************-->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter une dépense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="forms-sample" action="depense" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="libelle">libelle</label>
                                <input type="text" class="form-control" id="libelle" name="libelle"
                                       placeholder="libelle" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control " id="description" name="description"
                                       placeholder="Description" required>
                            </div>
                            <div class="form-group">
                                <label for="montant">Montant</label>
                                <input type="text" class="form-control" id="montant" name="montant"
                                       placeholder="Montant" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date"
                                       placeholder="Date" required>
                            </div>
                            <div class="form-group">
                                <label for="payement">Payement</label>
                                <select class="form-control" id="payement" name="payement" required>
                                    <option value="cheque">Espéce</option>
                                    <option value="espece">Chéque</option>
                                    <option value="carte bancaire">Carte bancaire</option>
                                    <option value="virement">Virement</option>
                                    <option value="prelevement">Prélèvement</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>

                            <input type="hidden" class="form-control" id="type" name="type" value="depense">

                            <button type="submit" class="btn btn-success mr-2" style="float: right">Confirmer</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- ************************************************************************************
               ************************************ Show Modal ********************************************
               *****************************************************************************************-->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exempleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Détails</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="content">
                            <!--  <input type="hidden" name="depense_id" id="id" value="{ {$depense->id}}"> -->
                            <!--pour récuperer l'id de document eli besh nfichiwha -->
                            <ul class="">
                                <li class="">
                                    <strong>Nom document :</strong>
                                    <span style="float: right;width: 50%;text-align: left;" id="libelle"></span>
                                </li>
                                <li class="">
                                    <strong>Description :</strong>
                                    <span style="float: right;width: 50%;text-align: left;" id="description"></span>
                                </li>
                                <li class="">
                                    <strong>Date de creation :</strong>
                                    <span style="float: right;width: 50%;text-align: left;" id="montant"></span>
                                </li>
                                <li class="">
                                    <strong>Chemin :</strong>
                                    <span style="float: right;width: 50%;text-align: left;" id="date"></span>
                                </li>
                                <li class="">
                                    <strong>Chemin :</strong>
                                    <span style="float: right;width: 50%;text-align: left;" id="payement"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- ****************************************************************************************
               *************************************Edit Modal **************************************
               ***************************************************************************************-->
        <div class="modal fade" id="edit" role="dialog" tabindex="-1" aria-labelledby="exempleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modifier la dépense</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form class="forms-sample" action="/updateDep" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="depense_id" id="id" value="">
                            <!--pour récuperer l'id de document eli besh nmodifiwha -->

                            <div class="form-group">
                                <label for="libelle">libelle</label>
                                <input type="text" class="form-control" id="libelle" name="libelle"
                                       value="" placeholder="libelle" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       value="" placeholder="Description" required>
                            </div>
                            <div class="form-group">
                                <label for="montant">Montant</label>
                                <input type="" class="form-control" id="montant" name="montant"
                                       value="" placeholder="Montant" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date"
                                       value="" placeholder="Date" required>
                            </div>
                            <div class="form-group">
                                <label for="payement">Payement</label>
                                <select class="form-control" id="payement" name="payement" required>
                                    <option value="cheque">Espéce</option>
                                    <option value="espece">Chéque</option>
                                    <option value="carte bancaire">Carte bancaire</option>
                                    <option value="virement">Virement</option>
                                    <option value="prelevement">Prélèvement</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2" style="float: right">modifier</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ************ end edit modal **************-->
    </div>
@endsection

@section('script.form')
    <script>

        $('#edit').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var id = button.data('id')
            var libelle = button.data('libelle')
            var description = button.data('description')
            var montant = button.data('montant')
            var date = button.data('date')
            var payement = button.data('payement')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #libelle').val(libelle);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #montant').val(montant);
            modal.find('.modal-body #date').val(date);
            modal.find('.modal-body #payement').val(payement);

        })

        //ajax pour recuperer les valeurs
        $('#myModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var id = button.data('id')
            var libelle = button.data('libelle')
            var description = button.data('description')
            var montant = button.data('montant')
            var date = button.data('date')
            var payement = button.data('payement')
            var modal = $(this)
            modal.find('.modal-body #libelle').text(libelle);
            modal.find('.modal-body #id').text(id);
            modal.find('.modal-body #description').text(description);
            modal.find('.modal-body #montant').text(montant);
            modal.find('.modal-body #date').text(date);
            modal.find('.modal-body #payement').text(payement);

        })
    </script>
@endsection

