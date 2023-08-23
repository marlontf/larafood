@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">Planos</a></li>
    </ol>
    <h1>Planos <a href="{{ route('plans.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form name="filtrar" action="{{ route('plans.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="filter" placeholder="Insira uma pesquisa"class="form-control"
                        value="{{ $filters['filter'] ?? '' }}">
                    <div class="input-group-append" role='button' onclick="resetFilter()">
                        <span class="input-group-text"><i class="fas fa-times"></i></span>
                    </div>
                    <button type="submit" class="btn btn-dark ml-2"><i class="fas fa-filter"></i></button>
                </div>

            </form>
        </div>
        <div class="card-body">
            <table class='table table-condensed'>
                <thead>
                    <tr>
                        <th>
                            @sortablelink('name', 'Name')
                            @if (request()->input('sort') == 'name' && request()->input('direction') == 'desc')
                                <i class="fas fa-sort-down"></i>
                            @elseif (request()->input('sort') == 'name' && request()->input('direction') == 'asc')
                                <i class="fas fa-sort-up"></i>
                            @endif
                        </th>
                        <th>
                            @sortablelink('price', 'Preço')
                            @if (request()->input('sort') == 'price' && request()->input('direction') == 'desc')
                                <i class="fas fa-sort-down"></i>
                            @elseif (request()->input('sort') == 'price' && request()->input('direction') == 'asc')
                                <i class="fas fa-sort-up"></i>
                            @endif
                        </th>
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
                                R$ {{ number_format($plan->price, 2, ',', '.') }}
                            </td>
                            <td>
                                <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-sm btn-warning"
                                    aria-label="Ver"><i class="far fa-eye"></i></a>
                                <form action="{{ route('plans.destroy', $plan->url) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" aria-label="Deletar"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($plans->hasPages())
            <div class="card-footer d-flex justify-content-center">
                @if (isset($filters))
                    {!! $plans->appends($filters)->links() !!}
                @else
                    {!! $plans->links() !!}
                @endif


            </div>
        @endif

    </div>
@stop

@section('js')
    <script>
        function resetFilter() {
            document.querySelector('input[name=\'filter\']').value = ''
            window.location.href = "{{ route('plans.index') }}"
        }
    </script>
@endsection
