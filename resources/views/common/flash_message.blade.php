@if (session('success'))
    <div class="flash alert-info">
        <p class="panel-body">
            {{ session('success') }}
        </p>
    </div>
@endif
@if (count($errors) > 0)
    <div>
        <strong>Whoops! Something went wrong!</strong>
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
