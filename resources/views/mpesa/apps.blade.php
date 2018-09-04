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
                        <th>Type</th>
                    </tr>
                    </thead>
                </table>
            @endif
        </div>
    </div>
@endsection