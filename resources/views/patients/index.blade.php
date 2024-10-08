@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Pacientes</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/pacientes/create') }}" class="btn btn-sm btn-primary">Crear Nueva</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
            <h3 class="mb-0">Buscar</h3>
            <form action="{{ route('patients.index') }}" method="GET">
            <div class="row">

                    <div class="col-md-2">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre">
                    </div>
                    <div class="col-md-2">
                        <label for="correo">Correo</label>
                        <input type="text" class="form-control form-control-sm" id="correo" name="correo">
                    </div>
                    <div class="col-md-2">
                        <label for="documento">Documento</label>
                        <input type="text" class="form-control form-control-sm" id="documento" name="documento">
                    </div>
                    <div class="col-md-2">
                        
                        <br>
                        <button class="btn btn-primary btn-sm" id="buscar" name="buscar">Buscar</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($patients as $patient)
                        <tr>
                            <th scope="row">
                                {{ $patient->name }}
                            </th>
                            <td>
                                {{ $patient->email }}
                            </td>
                            <td>
                                {{ $patient->cedula }}
                            </td>
                            <td>
                                {{ $patient->address }}
                            </td>
                            <td>
                                {{ $patient->phone }}
                            </td>
                            <td>
                                <form action="{{ url('pacientes/' . $patient->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ url('/pacientes/' . $patient->id . '/edit') }}"
                                        class="btn btn-sm btn-primary">Editar</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $patients->links() }}
        </div>
    </div>
@endsection
