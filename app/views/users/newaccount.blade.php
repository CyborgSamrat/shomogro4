@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title bariol-thin">Sign up for <b>Shomogro</b></h3>
                    </div>
                    <?php $message = Session::get('message'); ?>
                    @if( isset($message) )
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <div class="panel-body">
                        {{ Form::open(["route" => 'user.create', "method" => "POST", "id" => "user_signup"]) }}
                        {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                        {{ Form::password('__to_hide_password_autocomplete', ['class' => 'hidden']) }}


                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                {{ Form::text('mobileNumber', '', ['id' => 'mobileNumber', 'class' => 'form-control', 'placeholder' => '01785469872', 'required', 'autocomplete' => 'off']) }}
                            </div>
                            <span class="text-danger">{{ $errors->first('mobileNumber') }}</span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('birthday', '', ['id' => 'birthday', 'class' => 'form-control', 'placeholder' => '12/06/1992', 'required', 'autocomplete' => 'off']) }}
                            </div>
                            <span class="text-danger">{{  $errors->first('birthday') }}</span>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        {{  Form::password('password', ['id' => 'password1', 'class' => 'form-control', 'placeholder' => 'Password', 'required', 'autocomplete' => 'off']) }}
                                    </div>
                                    <span class="text-danger">{{  $errors->first('password') }}</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        {{  Form::password('password_confirmation', ['class' => 'form-control', 'id' =>'password2', 'placeholder' => 'Confirm password', 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div id="pass-info"></div>
                                </div>
                            </div>

                            {{-- Captcha validation --}}
                            @if(isset($captcha) )
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                        <span id="captcha-img-container">
                                            @include('laravel-authentication-acl::client.auth.captcha-image')
                                        </span>
                                            <a id="captcha-gen-button" href="#" class="btn btn-small btn-info margin-left-5"><i class="fa fa-refresh"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
                                            {!! Form::text('captcha_text',null, ['class'=> 'form-control', 'placeholder' => 'Fill in with the text of the image', 'required', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div>
                                    <span class="text-danger">{!! $errors->first('captcha_text') !!}</span>
                                </div>
                            @endif
                        </div>
                        <input type="submit" value="Register" class="btn btn-info btn-block">
                        </form>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 margin-top-10">
                                {{ link_to_route('user.login','Already have an account? Login here') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Js files --}}
    {{ HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') }}
    {{ HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/password_strength/strength.js') }}

    <script>
        $(document).ready(function() {
            //------------------------------------
            // password checking
            //------------------------------------
            var password1 		= $('#password1'); //id of first password field
            var password2		= $('#password2'); //id of second password field
            var passwordsInfo 	= $('#pass-info'); //id of indicator element

            passwordStrengthCheck(password1,password2,passwordsInfo);

            //------------------------------------
            // captcha regeneration
            //------------------------------------

            $("#captcha-gen-button").click(function(e){
                e.preventDefault();

                $.ajax({
                    url: "/captcha-ajax",
                    method: "POST",
                    headers: { 'X-CSRF-Token' : '{!! csrf_token() !!}' }
                }).done(function(image) {
                    $("#captcha-img-container").html(image);
                });
            });
        });
    </script>


@stop