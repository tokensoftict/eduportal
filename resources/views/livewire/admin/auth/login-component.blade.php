@extends('adminlte::auth.login')

@section('login_url')
{{ 'admin/loginprocess' }}
@endsection

@section('dashboard_url')
    {{ 'admin/dashboard' }}
@endsection


