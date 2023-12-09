@extends('errors.minimal')

@section('title', $message ?? __('Service Unavailable'))
@section('code', $code ?? '503')
@section('message', $message ?? __('Service Unavailable'))
