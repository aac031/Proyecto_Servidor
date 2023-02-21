<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<style>
    .form-signin {
        background-color: #133337;
        max-width: 1200px;
        width: 400px;
        padding: 20px;
        margin: auto;
        margin-top: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        color: #fff;
    }

    .bg {
        background-color: black;
        height: 100vh;
    }

    .title {
        padding: 30px;
        margin-bottom: 150px;
    }

    .card {
        padding: 30px;
    }
</style>

<div class="bg">
    <div class="title card bg-dark text-white text-center">
        <h1>Centro de Imágen Personal</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark text-white">
                    <div class="card-header text-center">
                        <h2>Inicie sesión</h2>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="form-signin">
                        @csrf

                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-label-group">
                            <label for="email">{{ ('Email:') }}</label><br><br>
                            <input id="email" type="email" name="email" class="form-control" required autofocus>
                        </div>
                        <br>
                        <div class="form-label-group">
                            <label for="password">{{ ('Password:') }}</label><br><br>
                            <input id="password" type="password" name="password" class="form-control" required>
                        </div>
                        <br>
                        <div class="form-label-group text-center">
                            <button type="submit" class="btn btn-lg btn-primary">
                                {{ ('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>