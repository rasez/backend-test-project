@extends('layouts.default')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Upload Csv</h6>
        </div>
        <div class="card-body">
            @include('layouts.errors')
            <form method="POST" action="{{ route('store-csv') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group"><label for="walletName">Browse file</label><input class="form-control" name="csv" id="walletName" type="file" step="0.01" placeholder=""></div>

                <div class="form-group">
                    <button class="btn btn-success">Upload Csv</button>
                </div>
            </form>
        </div>
    </div>
@endsection
