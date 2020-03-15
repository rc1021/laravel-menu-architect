@extends('menu_architect::page')

@section('title', 'Create Menu')

@section('content_header')
<h1 class="page-title">
    <i class="glyphicon glyphicon-list"></i> Create Menu
</h1>
@stop

@section('content')
<form method="POST" action="{{ route('menu_arct.store') }}" class="form-horizontal">
    @csrf
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Menu Form Create</div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Menu Name" autocomplete="off">
                    @error('name')
                        <div class="text-danger"><i class="glyphicon glyphicon-alert"></i>&nbsp;{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

@endsection

@section('js')

@endsection

@section('css')

@endsection