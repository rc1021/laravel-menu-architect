@extends('menu_architect::master')

@section('title', 'Menu')

@section('content')
<h1 class="page-title">
    <i class="glyphicon glyphicon-list"></i> Menus
    <a href="{{route('menu_arct.create')}}" class="btn btn-success">
        <i class="glyphicon glyphicon-plus"></i> Add New
    </a>
</h1>

<div class="alert alert-info">
    <strong>How To Use:</strong>
    <p>
        You can output a menu html anywhere on your site by calling <code>menu_arct('name')</code>, <a target="_blank" href="{{route('menu_arct.example')}}">see more examples.</a>
    </p>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Menu List</div>
    </div>
    <table class="table"> 
        <thead> 
            <tr> 
                <th width="100%">Name</th> 
                <th nowrap>Actions</th> 
            </tr> 
        </thead> 
        <tbody> 
            @foreach ($model->items as $item)
            <tr> 
                <td>
                    {{ $item->name }}
                </td> 
                <td>
                    <a href="{{ route('menu_arct.edit', [$item]) }}" class="btn btn-primary"><i class="glyphicon glyphicon-wrench"></i>&nbsp;Edit</a>
                </td> 
            </tr> 
            @endforeach
            <tr> 
                <td colspan="2" class="text-center">No Menu!</td> 
            </tr> 
        </tbody> 
    </table>
</div>
@endsection

@section('js')

@endsection

@section('css')

@endsection