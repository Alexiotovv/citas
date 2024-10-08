<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Médico</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($oldAppointments as $cita)
                <tr>
                    <td>
                        {{ $cita->doctor->name }}
                    </td>
                    <td>
                        {{ $cita->scheduled_date }}
                    </td>
                    <td>
                        {{ $cita->status }}
                    </td>
                    <td>
                        <a href="{{ url('/miscitas/'.$cita->id)}}" class="btn btn-info bt-sm">Ver</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
