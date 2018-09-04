@extends('payments::layouts.payments')

@section('content')
    <div class="row">
        <div class="col-12">
            @if($apps->isEmpty())
                <div class="alert alert-warning">
                    <p>You have not added apps</p>
                </div>
            @else
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Shortcode</th>
                        <th>Environment</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($apps as $app)
                        <tr>
                            <th>{{$app->id}}</th>
                            <th>{{$app->short_code}}</th>
                            <th>{{ucfirst($app->environment)}}</th>
                            <th>{{strtoupper($app->type)}}</th>
                            <th><a href="#" class="btn btn-sm btn-danger">Delete</a></th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection