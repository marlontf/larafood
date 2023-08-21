@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Planos <a href="{{route('plans.create')}}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            #filtros
        </div>
        <div class="card-body">

            <table class='table table-condensed'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th width="100">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>
                                {{ $plan->name }}
                            </td>
                            <td>
                                R$ {{number_format($plan->price, 2, ',','.')}}
                            </td>
                            <td>
                                <a href="{{route('plans.show', $plan->url)}}" class="btn btn-sm btn-warning" aria-label="Ver"><i class="far fa-eye"></i></a>
                                <form action="{{route('plans.destroy', $plan->url)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" aria-label="Deletar"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($plans->hasPages())
            <div class="card-footer d-flex justify-content-center">
                {!! $plans->links() !!}
            </div>
        @endif

    </div>
@stop
