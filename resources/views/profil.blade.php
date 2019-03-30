@extends('index')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row profile-page">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="panel-heading">  <h4>{{$membre->nom}}</h4></div>
                            <div class="profile-body">

                                <div class="row">
                                    <div class="col-md-10">
                                        <form class="forms-sample" method="post" action="/updateprofil" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div align="center"> <img alt="User Pic" src="/showImage/{{ $membre->id }}"
                                                                      id="profile-image1" class="img-circle img-responsive">

                                                <input id="pic" class="hidden" name="pic" type="file" accept="image/*">

                                                <div style="color:#999;">click here to change profile image</div>

                                            </div>
                                            <input type="hidden" id="idMembre" name="membre_id" value="{{$membre->id}}">

                                            <div class="form-group">
                                                <label for="exampleInputName1">Nom</label>
                                                <input type="text" name="nom" class="form-control" id="nom" value="{{$membre->nom}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail2">Prénom</label>
                                                <input type="text" name="prenom" class="form-control" id="prenom" value="{{$membre->prenom}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword3">E-mail</label>
                                                <input type="email" name="email" class="form-control" id="email" value="{{$membre->email}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputCity4">Date naissance</label>
                                                <input type="text" name="dateNaissance" class="form-control" value="{{$membre->dateNaissance}}" id="dateNaissance">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputCity5">Téléphone</label>
                                                <input type="text" name="telephone" class="form-control" id="telephone" value="{{$membre->telephone}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputCity6">C.I.N</label>
                                                <input type="text" name="cin" class="form-control" id="cin" value="{{$membre->cin}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputCity7">Adresse</label>
                                                <input type="text" name="adresse" class="form-control" id="adresse" value="{{$membre->adresse}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputCity8">Mot de passe</label>
                                                <input type="text" name="mdp" class="form-control" value="{{$membre->mdp}}" id="mdp">
                                            </div>
                                            <button type="submit" class="btn btn-primary mr-2" style="float: right">
                                                Modifier
                                            </button>
                                            <button type="button" data-dismiss="modal" class="btn btn-light">Annuler
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<style type="text/css">
    input.hidden {
        position: absolute;
        left: -9999px;
    }

    #profile-image1 {
        cursor: pointer;
        width: 100px;
        height: 100px;
        border: 2px solid #03b1ce;
    }

    .tital {
        font-size: 16px;
        font-weight: 500;
    }

    .bot-border {
        border-bottom: 1px #f8f8f8 solid;
        margin: 5px 0 5px 0
    }
</style>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    $(function () {
        $('#profile-image1').on('click', function () {
            $('#pic').click();
        });
    });
</script>
