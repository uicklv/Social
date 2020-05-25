@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="alert alert-danger mb-2 mt-2" role="alert" id="errors" style="display:none">
                Incorrect email or password. Please try again.
            </div>
            <form  id="logform"  action="">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"  name="password" class="form-control" id="password">
                </div>
                <div class="custom-control custom-checkbox mb-2">
                    <input name="remember" type="checkbox" class="custom-control-input" id="remember">
                    <label class="custom-control-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary" id="submit_b">Sign in</button>
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
                        url: '{{route('signin.post')}}',
                        data: form,
                        error: function() {
                            $('#errors').css('display', 'block');
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

