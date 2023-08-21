@extends('adminlte::page')

@section('title', 'Cadastrar Novo Plano')

@section('content_header')
    <h1>Cadastrar Novo Plano</h1>

@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('plans.store')}}" method="POST" class="form">
                @csrf
                <div class="form-group">
                    <label >Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome">
                </div>
                <div class="form-group">
                    <label >Preço:</label>
                    <input type="number" step="0.01" name="price" class="form-control" placeholder="Preço">
                </div>
                <div class="form-group">
                    <label >Descrição:</label>
                    <input type="text" name="description" class="form-control" placeholder="Descrição">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@stop
