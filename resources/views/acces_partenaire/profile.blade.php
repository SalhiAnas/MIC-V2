<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Acces Patenaire - MIC</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="description">
        <meta content="" name="keywords">
        @include('components.css')
    </head>
    <body>
        @include('components.nav')
        <main id="main">
            <div class="modal fade" id="update_user" tabindex="-1" aria-labelledby="update_user_label" aria-hidden="true" >
                <div class="modal-dialog" style="max-width: 650px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="update_user_label"><b>Modifier votre profile</b></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="form-outline" method="post" action="{{route('updatePassword.update' , Auth::user()->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">E-mail</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mot de passe actuel</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="password" type="password" class="rounded-0 form-control" id="exampleInputPassword1" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nouveau mot de passe</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="NewPassword" type="password" class="rounded-0 form-control" id="exampleInputPassword1" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 fst-normal">Confirmer le mot de passe</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input  name="ConfirmNewPassword" type="password" class="rounded-0 form-control" id="exampleInputPassword2" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Modifier votre profile</button>
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center container p-5 col-sm-12 col-md-8">
                {{-- @if(session('success'))
                    <div class="alert alert-success text-start" role="alert"><strong>{{ session('success') }}</strong></div>
                @endif
                @error('email')
                <div class="alert alert-danger text-start" role="alert"><strong>{{ $message }}</strong></div>
                @enderror
                @error('password')
                <div class="alert alert-danger text-start" role="alert"><strong>{{ $message }}</strong></div>
                @enderror --}}

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

                    @if($errors->any())
                        <div class="alert alert-danger text-start" role="alert"><strong>{{$errors->first()}}</strong></div>
                    @endif

                    <div class="justify-content-center row">
                    <div class="card card-body bg-light align-self-center">
                        <h1 class="m-md-5 p-5" style="font-size: 40px;">Profile</h1>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 offset-md-9 pb-5">
                                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#update_user">Modifier votre profile</button>
                            </div>
                        </div>
                        <div class="row border-bottom" style="margin: 0px 40px 15px 40px">
                            <label class="col-sm-4 col-form-label">N°Identité</label>
                            <div class="col-sm-6" style="color: #e9c46a;">
                                {{ Auth::user()->id }}
                            </div>
                        </div>
                        <div class="row border-bottom" style="margin: 0px 40px 15px 40px">
                            <label class="col-sm-4 col-form-label">Nom</label>
                            <div class="col-sm-6" style="color: #e9c46a;">
                                {{ Auth::user()->first_name }}
                            </div>
                        </div>
                        <div class="row border-bottom" style="margin: 0px 40px 15px 40px">
                            <label class="col-sm-4 col-form-label">Prénom</label>
                            <div class="col-sm-6" style="color: #e9c46a;">
                                {{ Auth::user()->last_name }}
                            </div>
                        </div>
                        <div class="row border-bottom" style="margin: 0px 40px 15px 40px">
                            <label class="col-sm-4 col-form-label">E-mail</label>
                            <div class="col-sm-6" style="color: #e9c46a;">
                                {{ Auth::user()->email }}
                            </div>
                        </div>
                        <div class="row border-bottom" style="margin: 0px 40px 15px 40px">
                            <label class="col-sm-4 col-form-label">Mot de passe</label>
                            <div class="col-sm-6" style="color: #e9c46a;">
                                ********
                            </div>
                        </div>
                        <div class="row" style="margin: 0px 40px 0px 40px">
                            <label class="col-sm-4 col-form-label">Institut</label>
                            <div class="col-sm-6" style="color: #e9c46a;">
                                {{ Auth::user()->institut }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('components.js')
    </body>
</html>
