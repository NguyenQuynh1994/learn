@if (session('result'))
    <div class="flash alert-info">
        <p class="panel-body">
            {{ session('result') }}
        </p>
    </div>
@endif
