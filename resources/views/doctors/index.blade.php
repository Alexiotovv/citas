@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Doctores</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('/medicos/create')}}" class="btn btn-sm btn-primary">Crear Nueva</a>
        </div>
      </div>
    </div>
    <div class="card-body">
        @if (session('notification'))
        <div class="alert alert-success" role="alert">
            {{ session('notification')}}
        </div>
        @endif
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

            @foreach($doctors as $doctor)
            <tr>
              <th scope="row">
                {{$doctor -> name}}
              </th>
              <td>
                {{$doctor -> email}}
              </td>
              <td>
                {{$doctor -> identity_card}}
              </td>
              <td>
                {{$doctor -> address}}
              </td>
              <td>
                {{$doctor -> phone}}
              </td>

              <td>
                <form action="{{ url('/medicos/'.$doctor->id) }}" method="POST">
                @csrf
                  @method('DELETE')
                  <a href="{{url('/medicos/'.$doctor->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                  <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>

              </td>
            </tr>
            @endforeach

        </tbody>
      </table>
    </div>
    <div class="card-body">
        {{ $doctors->links()}}
    </div>
  </div>
@endsection
