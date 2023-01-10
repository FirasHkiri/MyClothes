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
    <!-- Preloader -->

    <div class="CenterPage">
        <div class="screencenter">
            <img src="{{ asset('assets/img/logo.png') }}" class="imgrounded" alt="Logo" height="80" width="80">
            </p>
        </div>
        <div class="screencenter">
            <img src="{{ asset('assets/img/name.png') }}" alt="name" height="45" width="125"></p>
            <div class="txtstyle">
                <p> Our B2B technology platform enables apparel brands to match their customers with the best-fitting
                    products. </p>
            </div>
        </div>
        <h5>Sign up</h5>
        <br>
        <form action="{{ route('validate_signup') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <input type="text" name="name" class="form-control imgrounded" placeholder="Name" />
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control imgrounded" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control imgrounded" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" class="form-control imgrounded" placeholder="Confirm Password">
                @if ($errors->has('confirm_password'))
                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                @endif
            </div>
              <div class="form-group mb-1">
              <label>Logo</label> <br>
              <input type="file" name="image" class="form-control" placeholder="image">
              @if ($errors->has('image'))
              <span class="text-danger">{{ $errors->first('image') }}</span>
              @endif
            </div>
            <br>
            <div class="txtstyle">
                <p> You already have an account? <a style="text-decoration:none" href="{{ route('signin') }}">Sign
                        in</a></p>
            </div>
            <br>
            <div class="screencenter">
                <button type="submit" class="btn btn-primary">Sign up</button>
            </div>
        </form>
    </div>
    @include('layouts.fixed.footer-scripts') 
</body>

</html>
