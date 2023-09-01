@extends('adminlte::page')

@section('title', "Detalhes do plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.index', $plan->url) }}" class="active">Detalhes</a></li>
    </ol>
    <h1>Detalhes do plano {{$plan->name}} <a href="{{ route('details.plan.create',$plan->url) }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class='table table-condensed'>
                <thead>
                    <tr>
                        <th>
                            Nome
                        </th>
                        <th width="130">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>
                                {{ $detail->name }}
                            </td>
                            <td>
                                <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-sm btn-warning"
                                    aria-label="Ver"><i class="far fa-eye"></i></a>
                                <a href="{{route('details.plan.edit',[$plan->url, $detail->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
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
        @if ($details->hasPages())
            <div class="card-footer d-flex justify-content-center">
                @if (isset($filters))
                    {!! $details->appends($filters)->links() !!}
                @else
                    {!! $details->links() !!}
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
