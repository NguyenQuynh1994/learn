@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Result</h4></div>
                    <div class="panel-body">
                        <h3> {{ $lesson->name }}
                            Result: {{ $correct }} /{{ $total }}
                            </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
