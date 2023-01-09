<!DOCTYPE html>
<html>

<head>
    <title>MyClothes</title>
    @include('layouts.fixed.head')
    @include('layouts.fixed.loader')
    <style>
        .CenterPage {
            width: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }

        .txtstyle {
            font-size: 13px;
            font-weight: 490;
            text-align: center;
            color: grey
        }

        .screencenter {
            text-align: center
        }

        .imgrounded {
            border-radius: 13px
        }

        .btn-primary {
            background-color: #320662 !important;
            padding: 11px;
            width: 170px;
            border-radius: 13px;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
      <div id="loader">
          <div class="spinner"></div>
      </div>

    <div class="CenterPage">
        <div class="screencenter">
            <img src="{{ asset('assets/img/logo.png') }}" class="imgrounded" alt="Logo" height="80" width="80">
        </div>
        <div class="screencenter">
            <img src="{{ asset('assets/img/name.png') }}" alt="name" height="45" width="125">
            <div class="txtstyle">
                <p> Our B2B technology platform enables apparel brands to match their customers with the best-fitting
                    products. </p>
            </div>
        </div>
        <h5>Sign in</h5>
        <br>
        <form action="{{ route('validate_signin') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                {{-- <label>Email address :</label> --}}
                <input type="email" name="email" class="form-control imgrounded" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group mb-3">
                {{-- <label>Password :</label> --}}
                <input type="password" name="password" class="form-control imgrounded" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-check pull-left">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <br>
            <br>
            <div class="txtstyle">
                <p> Forget your password ?
                    <br>
                    <a style="text-decoration:none" href="#">Recover your password</a>
                </p>
            </div>
            <div class="txtstyle">
                <p> You don't have and account? <a style="text-decoration:none" href="{{ route('signup') }}">Sign up</a>
                </p>
            </div>
            <div class="screencenter">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
    </div>
    @include('layouts.fixed.footer-scripts') 
</body>

</html>
