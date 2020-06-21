@extends('layouts.reset')

@section('contents')
<div class="container">
    <div class="row mt-3">
        <div class="col-12 col-md-4 offset-md-4 text-center">
            <img src="{{ asset('storage/MLG_Logo-Since-1999.jpg') }}" alt="MLG Logo" class="img-responsive" width="30%">
        </div>
        <div class="col-12 col-md-6 offset-md-3 text-center mt-3 mb-0">
            <h3 class="merriweather font-weight-bold">MLG College of Learning, Inc</h3>
            <h5 class="m-0 merriweather">Brgy. Atabay, Hilongos, Leyte</h5>
        </div>
    </div>

    <div class="row justify-content-center my-3">
        <div class="col-md-10">
            <div class="card">
                <div class="row card-body p-0">
                    <div class="col-12 col-md-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900">Hi {{ $user->first_name }}!</h1>
                                <h1 class="h4 text-grey-900 mb-4">Let's Reset your Password First</h1>
                            </div>
                            <form id="resetForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">                            
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                </div>
                                
                                <ul>
                                    <li class="my-0 small text-danger" id="char">At least 8 characters long</li>
                                    <li class="my-0 small text-danger" id="caps">At least 1 Capital letter</li>
                                    <li class="my-0 small text-danger" id="num">At least 1 Number</li>
                                    <li class="my-0 small text-danger" id="spec">At least 1 Special character</li>
                                </ul>
                                
                                
                                <button type="submit" class="btn btn-primary btn-user btn-block mt-3 d-none" id="resetBtn">
                                    {{ __('Reset Password') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-lg-block bg-login-image" style="background-image: url({{asset('admin/img/mlg1.jpg')}})"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        let entries = false;
        let match = false;

        $('#password').on('keyup',function(){
            let password = $('#password').val();
            let validLength = /.{8}/.test(password);
            let hasCaps = /[A-Z]/.test(password);
            let hasNums = /\d/.test(password);
            let hasSpecials = /[~!,@#%&_\$\^\*\?\-]/.test(password);

            if(validLength == true){
                $('#char').removeClass('text-danger');
                $('#char').addClass('text-success');
            } else {
                $('#char').removeClass('text-success');
                $('#char').addClass('text-danger');
            }

            if(hasCaps == true){
                $('#caps').removeClass('text-danger');
                $('#caps').addClass('text-success');
            } else {
                $('#caps').removeClass('text-success');
                $('#caps').addClass('text-danger');
            }

            if(hasNums == true){
                $('#num').removeClass('text-danger');
                $('#num').addClass('text-success');
            } else {
                $('#num').removeClass('text-success');
                $('#num').addClass('text-danger');
            }
            
            if(hasSpecials == true){
                $('#spec').removeClass('text-danger');
                $('#spec').addClass('text-success');
            } else {
                $('#spec').removeClass('text-success');
                $('#spec').addClass('text-danger');
            }

            entries = validLength && hasCaps && hasNums && hasSpecials;
        });
        $('#password-confirm').on('keyup',function(){
            if($('#password').val() == $('#password-confirm').val()){
                $('#password-confirm').css('outline','2px solid green');
                $('#password').css('outline','2px solid green');
                match = true;
            } else {
                $('#password-confirm').css('outline','2px dotted red');
                $('#password').css('outline','2px dotted red');
                match = false;
            }

            if(match && entries){
                $('#resetBtn').removeClass('d-none')
            } else {
                $('#resetBtn').addClass('d-none');
            }
        })

        $(document).on('submit','#resetForm', function(e){
            e.preventDefault();

            let form = $('#resetForm')[0];
            let formData = new FormData(form);

            let resetUrl = "{{ route('reset.password') }}";

            $.ajax({
                url: resetUrl,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    Swal.fire({
                        icon: 'success',
                        text: 'Password reset successful!'
                    })
                    window.location.replace('/dashboard');
                }
            });
        })
    </script>
@endsection