@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> Biểu đồ kết quả học tập</h4>
                </div>
                <div class="panel-body">
                    <div id="curve_chart" style="width: 900px; height: 500px"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
