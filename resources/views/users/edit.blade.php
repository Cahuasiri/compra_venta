@extends('adminlte::page')

@section('content')   
<form action="{{ route('users.update', $user) }}" method="POST">
   @method('PUT') 
   @include('users._form_edit')
</form>   
@stop