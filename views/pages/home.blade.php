@extends('layouts.App')

@section('title', 'Главная')

@section('content')
    <h2>Добро пожаловать!</h2>
    <p>Это главная страница.</p>
	123
	
	@component(['Button', ['class' => "test"]])
		Button component
	@endcomponent
@endsection
@vite(['src/pages/home.ts'])