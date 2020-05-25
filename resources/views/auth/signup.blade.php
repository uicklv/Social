@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form id="logform" action="" >
                @csrf
                <div class="form-group" id="div_email">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}">
                        <span class="help-block text-danger" id="email_error" role="alert" style="display: none;"></span>
                </div>
                <div class="form-group" id="div_username">
                    <label for="username">Login</label>
                    <input type="text" name="username" class="form-control" id="username" value="{{old('username')}}">
                        <span class="help-block text-danger" id="username_error" role="alert" style="display: none;"></span>
                </div>
                <div class="form-group" id="div_password">
                    <label for="password">Password</label>
                    <input type="password"  name="password" class="form-control" id="password">
                    <span class="help-block text-danger" id="password_error" role="alert" style="display: none;"></span>
                </div>
                <div class="form-group" id="div_password_confirmation">
                    <label for="password_confirmation">Password Confirm</label>
                    <input type="password"  name="password_confirmation" class="form-control" id="password_confirmation">
                    <span class="help-block text-danger" id="password_confirmation_error" role="alert" style="display: none;"></span>
                </div>
                <button type="submit" class="btn btn-primary" id="submit_b" >Sign up</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function() {

            var handleSignInFormSubmit = function() {
                $('#submit_b').click(function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form').serialize();


                    $.ajax({
                        method: 'POST',
                        url: '{{route('signup.handle')}}',
                        data: form,
                        error: function(xhr) {
                            var response = jQuery.parseJSON(xhr.responseText);
                            console.log(response.errors);
                            if(response.errors){
                                for(var k in response.errors)
                                {
                                    $('#' + k + '_error').html('');
                                    document.getElementById('div_' + k).classList.add('has-error');
                                    $('#' + k + '_error').css('display', 'block');
                                    for(var i = 0; i < response.errors[k].length; i++) {
                                        $('#' + k + '_error').append(response.errors[k][i]);
                                    }
                                }
                            }
                        },
                        success: function(response, status, xhr, $form) {
                           window.location.href = "{{route('startpage')}}";
                        }
                    });
                });
            }

            handleSignInFormSubmit();
        });
    </script>
@endpush
