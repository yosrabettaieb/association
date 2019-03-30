@extends('index')
@section('content')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <script language="javascript" type="text/javascript" src="../js/extension.js"></script>

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- ***********************************tableau document Administratif*******************************-->
            <div class="row">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                    <div class="row flex-grow">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <h4>Documents administratif</h4> <!-- class="card-title"-->

                                        <button type="button" class="btn btn-success"
                                                style="position: absolute; right: 30px ; top: 30px" ;
                                                data-toggle="modal" data-target="#add">
                                            Ajouter
                                        </button>
                                    </div>

                                    <table class="table table-hover" id="searchable-table">
                                        <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Date de creation</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($documents as $document)
                                            <tr>
                                                <td>{{$document->nomDocument}}</td>
                                                <td>{{$document->description}}</td>
                                                <td>{{$document->created_at->format('d-m-Y')}}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <!--*********boutton download******************-->
                                                            <a href="/download/{{$document->id}}"
                                                               class="btn btn-icons btn-rounded btn-outline-success">
                                                                <i class="fa fa-download"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-3">
                                                            <!--*********boutton edit******************-->

                                                            <a href="/documentSideBar/{{$document->id}}"
                                                               class="btn btn-icons btn-rounded btn-outline-primary"
                                                               data-toggle="modal" data-target="#edit"
                                                               data-id="{{$document->id}}"
                                                               data-nomdocument="{{$document->nomDocument}}"
                                                               data-description="{{$document->description}}">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-3">
                                                            <!--*********boutton show******************-->
                                                            <button type="button" action="/show/{{ $document->id }}"

                                                                    class="btn btn-icons btn-rounded btn-outline-success"
                                                                    data-toggle="modal" data-target="#details"
                                                                    data-id="{{$document->id}}"
                                                                    data-nomdocument="{{$document->nomDocument}}"
                                                                    data-description="{{$document->description}}"
                                                                    data-pathe="{{$document->path}}"
                                                                    data-created="{{$document->created_at}}">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-3">
                                                            <!--*********boutton supprimer******************-->
                                                            <form class="docDelete"
                                                                  action="{{ action('DocumentsController@destroy', $document->id)}}"
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



        <!-- *************** Modal Ajout membre ************** -->

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                        <form class="forms-sample" action="/documentSideBar" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nomdocument">Nom document</label>
                                <input type="text" class="form-control" id="nomdocument" name="nomDocument"
                                       placeholder="Nom document" onChange='getoutput()' required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="Description" required>
                            </div>
                            <div class="form-group">
                                <label for="fillle">Importer un fichier</label>
                                <input type="file" onChange='getoutput()' name="file" id="fillle"
                                       class="form-control" required>
                                <input id='ext' type='hidden' name='extension'>
                                <input id="pat" type="hidden" name="path">
                            </div>
                            <button type="submit" class="btn btn-success mr-2" style="float: right">Confirmer</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!--   ************************************ Show Modal ******************************************* -->
        <div class="modal fade" id="details" tabindex="-1" aria-labelledby="exempleModalLabel" aria-hidden="true">
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
                            <ul class="">
                                <li class="">
                                    <strong>Nom document :</strong>
                                    <span style="float: right;width: 50%;text-align: left;" id="nomdocument"></span>
                                </li>
                                <li class="">
                                    <strong>Description :</strong>
                                    <span style="float: right;width: 50%;text-align: left;" id="description"></span>
                                </li>
                                <li class="">
                                    <strong>Date de creation :</strong>
                                    <span style="float: right;width: 50%;text-align: left;" id="created"></span>
                                </li>
                                <li class="">
                                    <strong>Chemin :</strong>
                                    <span style="float: right;width: 50%;text-align: left;" id="pathe"></span>
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



        <!-- ****************     Modal modifier membre ***************-->

        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">modifier membre</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="forms-sample" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <input type="hidden" name="document_id" id="id" value="">
                            <!--pour récuperer l'id de document eli besh nmodifiwha -->
                            <div class="form-group">
                                <label for="nomdocument">Libéllé</label>
                                <input type="text" class="form-control" id="nomdocument" name="nomDocument"
                                       value="">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       value="">
                            </div>
                            <div class="form-group">
                                <label for="fille">Importer un fichier</label>
                                <input type="file" onChange='getoutput2()' name="file" id="fille"
                                       class="form-control">
                                <input id='extension' type='hidden' name='extension'>
                                <input id="pathem" type="hidden" name="path">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2" style="float: right">modifier</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script.form')
    <script>

        $('#edit').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var id = button.data('id')
            var nomdocument = button.data('nomdocument')
            var description = button.data('description')
            var pathe = button.data('pathe')
            var modal = $(this)

            modal.find('.modal-body #nomdocument').val(nomdocument);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #description').val(description);

            modal.find('.modal-body form').attr('action', '/update/' + id)

        })
        //ajax pour recuperer les valeurs
        $('#details').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var id = button.data('id')
            var nomdocument = button.data('nomdocument')
            var description = button.data('description')
            var pathe = button.data('pathe')
            var created = button.data('created')
            var modal = $(this)
            modal.find('.modal-body #nomdocument').text(nomdocument);
            modal.find('.modal-body #id').text(id);
            modal.find('.modal-body #description').text(description);
            modal.find('.modal-body #pathe').text(pathe);
            modal.find('.modal-body #created').text(created);

        })
    </script>
@endsection
