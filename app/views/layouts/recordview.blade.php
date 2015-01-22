@extends('layouts.master')

@section('content')
@include('layouts.recordslist', array('records'=>$records,'controller' => $controller))
@stop