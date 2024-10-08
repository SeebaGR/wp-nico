@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
   {{-- Minimal --}}
   <x-adminlte-modal id="modalMin" title="Agregar nuevo dominio">
    {{-- Example button to open modal --}}
    <form action="{{ route('admin.register') }}" method="post">
        @csrf
    
        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
    
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
    
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
       
            <input  type="text" name="apellido" placeholder="Apellido" class="form-control" value="{{ old('apellido') }}" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
    
        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
    
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
    
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    
        {{--nuevos campos --}}
        <div class="input-group mb-3">
       
            <input id="direccion" type="text" name="direccion" placeholder="Dirección" class="form-control" value="{{ old('direccion') }}" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
    
        <!-- Campo de Teléfono -->
        <div class="input-group mb-3">
    
            <input id="telefono" type="text" class="form-control" placeholder="Teléfono" name="telefono" value="{{ old('telefono') }}">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    
        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">
    
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
    
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    
        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">
    
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
    
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    
        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>
    
    </form>
    </x-adminlte-modal>
    <div >
        <div class="card">
            <div class="card-head d-flex flex-row-reverse">       
      
                <button type="button" label="Open Modal" data-toggle="modal" data-target="#modalMin" class="mt-3  mr-3  btn btn-primary">Agregar</button>
            </div>
            <div class="card-body">
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        ['label' => 'Cliente', 'no-export' => true, 'width' => 20],
                        ['label' => 'Dominios', 'no-export' => true, 'width' => 20],
                        ['label' => 'Acción', 'no-export' => true, 'width' => 20],
                    ];
            
                    $config = [
                        'language' => [
                            'url' => '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json',
                        ]
                    ];
                @endphp
            
                {{-- Render datatable component --}}
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                    @foreach ($clientes as $cliente)
                    @php
                        $dominiosCount = $cliente->dominios->count();
                    @endphp
                    <tr>
                        <td>{{ $cliente->user->name }}</td>
                        <td>{{ $dominiosCount }}</td>
                        <td>
                            <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info">Ver Cliente</a>
                        </td>
                    </tr>
                @endforeach
                </x-adminlte-datatable>
            </div>
        </div>


    </div>
@endsection
