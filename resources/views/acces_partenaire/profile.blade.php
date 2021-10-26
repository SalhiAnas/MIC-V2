<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
    <head>
        <title>Acces Patenaire - MIC</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <meta content="" name="description">
        <meta content="" name="keywords">
        <script src="https://kit.fontawesome.com/5fdfb057c8.js" crossorigin="anonymous"></script>
        @include('components.css')
    </head>
    <body>
    <div class="modal fade" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-uppercase text-white"><i class="fas fa-exclamation text-danger pe-3"></i>Change password</h4>
                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-5">For security reasons, <strong>please</strong>, change your default password.</p>
                </div>
            </div>
        </div>
    </div>
    @include('components.nav')
    <main id="main">
        <style type="text/css">
            body{
                background: #f7f7ff;
            }
            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 0 solid transparent;
                border-radius: .25rem;
                margin-bottom: 1.5rem;
                box-shadow: 0 2px 6px 0 rgb(218 218 253 /65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
            }
            .me-2 {
                margin-right: .5rem!important;
            }
            h6,h5{
                font-family: 'Roboto', sans-serif;
            }
            h6{
                font-size: 14px;
                color: #424949de;
            }
        </style>
        <div class="container mt-5">
            <div class="main-body">
                @if($errors->any())
                    <script>
                    $(document).ready(function(){
                        $("#getCodeModal").modal('show');
                    });
                    </script>
{{--                    <div class="alert alert-danger text-start" role="alert"><strong>{{$errors->first()}}</strong></div>--}}
                @endif
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body py-3">
                                <div class="flex-column align-items-center text-center">
                                    <img src="img/profile.png" width="120px" height="120px" alt="Photo de profil" class="rounded-circle p-1 bg-transparent" width="110">
                                    <div class="mt-2">
                                        <h4 class="text-capitalize">{{Auth::user()->last_name}} {{Auth::user()->first_name}}</h4>
                                        <p class="text-secondary mb-1 text-capitalize"><b class="text-dark">Institut : </b>{{Auth::user()->institut}}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-5"><i class="fas fa-user-edit fs-4 pe-3"></i>Mettre à jour les informations personnelles</h5>
                                <form id="form" action="{{route('updatePassword.edit' , Auth::user()->id)}}" method="put">
                                    @csrf
                                    @method('PUT')
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('False'))
                                        <div class="alert alert-danger">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </div>
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="pt-2">Adresse e-mail</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="email" value="{{Auth::user()->email}}" class="rounded-0 form-control" name="email">
                                        </div>
                                    </div>

                                    <!-- Button trigger modal -->
                                   <div class="row">
                                        <div class="mr-0" style="max-width: max-content; margin-left: auto;">
                                            <button type="button" class="mt-3 mb-3 rounded-1 btn btn-success bg-base border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Enregistrer les modifications</button>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirm your password</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="inputPassword5" class="form-label">Password</label>
                                                <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="password">
                                                {{-- <div id="passwordHelpBlock" class="form-text">
                                                  Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                                </div> --}}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="mr-0" style="max-width: max-content; margin-left: auto;">
                                            <button type="submit" class="mt-3 mb-3 rounded-1 btn btn-success bg-base border-0 ">Enregistrer les modifications</button>
                                        </div>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="col-lg">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="pb-5" ><i class="fas fa-user-lock fs-4 pe-3"></i>Changer le mot de passe</h5>
                                    <form action="{{route('updatePassword.update' , Auth::user()->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        @if ($message = Session::get('successPassword'))
                                        <div class="alert alert-success">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif
                                        @if ($message = Session::get('FalsePassword'))
                                        <div class="alert alert-danger">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </div>
                                        @endif
                                        @if ($message = Session::get('PasswordsDifferent'))
                                        <div class="alert alert-danger">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </div>
                                        @endif
                                        @if ($message = Session::get('ShortPassword'))
                                        <div class="alert alert-danger">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </div>
                                        @endif

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="pt-2">Mot de passe actuel</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="password" type="password" class="rounded-0 form-control" id="exampleInputPassword1" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="pt-2">Nouveau mot de passe</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="NewPassword" type="password" class="rounded-0 form-control" id="exampleInputPassword1" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="pt-2">Confirmer le mot de passe</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input  name="ConfirmNewPassword" type="password" class="rounded-0 form-control" id="exampleInputPassword2" required>
                                            </div>
                                        </div>
                                        <div class="mr-0" style="max-width: max-content; margin-left: auto;">
                                            <button type="submit" class="mt-3 mb-3 rounded-1 btn btn-success border-0 ">Enregistrer les modifications</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('components.js')
    </body>
</html>
