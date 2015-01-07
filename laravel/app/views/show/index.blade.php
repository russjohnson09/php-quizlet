@extends('layouts.master')

@section('content')
@include('layouts.recordslist', array('records'=>$shows,'controller' => 'ShowController'))
@stop