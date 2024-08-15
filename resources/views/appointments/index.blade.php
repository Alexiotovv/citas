@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Mis Citas</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif

            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" data-toggle="tab" href="#mis-citas" role="tab"
                            aria-selected="true"><i class="ni ni-calendar-grid-58 mr-2"></i>Mis Citas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" href="#citas-pendientes" role="tab"
                            aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Citas Pendientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" href="#historial" role="tab"
                            aria-selected="false"><i class="ni ni-folder-17 mr-2"></i>Historial</a>
                    </li>
                </ul>
            </div>

            <div class="card shadow">
                <div class="card">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="mis-citas" role="tabpanel">
                            @include('appointments.tables.confirmed-appointments')
                        </div>
                        <div class="tab-pane fade" id="citas-pendientes" role="tabpanel">
                            @include('appointments.tables.pending-appointments')
                        </div>
                        <div class="tab-pane fade" id="historial" role="tabpanel">
                            @include('appointments.tables.old-appointments')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalPruebas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Solicitar Pruebas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPruebas" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="cita_id" name="cita_id" readonly hidden>
                                <label for="tests_name">Nombre de Prueba</label>
                                <input type="text" class="form-control form-control-sm" id="tests_name" name="tests_name"  required>
                            </div>
                            <div class="col-md-6">
                                <label for="tests_comments">Descripcion Prueba</label>
                                <textarea name="tests_comments" id="tests_comments" class="form-control form-control-sm"  required></textarea>
                            </div>
                            
                        </div>
                        <br>
    
                        <div class="row" style="justify-content: center">
                            <button onclick="btnRegistrarPruebas(event)" class="btn btn-primary btn-sm" style="width: 20%"><i class="fas fa-plus-circle"></i> Registrar Prueba</button>
                        </div>
                        
                        <br>
                        <div class="table-responsive">
                            <table id="dtTests" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre Prueba</th>
                                        <th>Descripcion</th>
                                        <th>Resultados</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
        
                                </tbody>
                            </table>    
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Salir</button>
                        {{-- <button type="submit" class="btn btn-primary btn-sm">Guardar</a> --}}
                    </div>
    
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditarPrueba" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Pruebas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditPruebas" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" id="test_id" name="test_id" readonly hidden>
                                <label for="edit_tests_name">Nombre de Prueba</label>
                                <input type="text" class="form-control form-control-sm" id="edit_tests_name" name="edit_tests_name"  required>
                            </div>
                            <div class="col-md-12">
                                <label for="edit_tests_comments">Descripción</label>
                                <textarea name="edit_tests_comments" id="edit_tests_comments" class="form-control form-control-sm"  required></textarea>
                            </div>
                            
                        </div>
                        <br>
    
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Salir</button>
                        <button type="button" onclick="btnActualizarPruebas(event)" class="btn btn-primary btn-sm">Guardar</a>
                    </div>
    
                </form>
            </div>
        </div>
    </div>

    @include('messages.confirmacion_eliminar_asin')
    @include('resultados.create')
    @include('resultados.edit')
    

    <script>
        function btnActualizarResultados(e) {
            e.preventDefault();
            ds=$("#formActualizaResultados").serialize();
            $.ajax({
                type: "POST",
                url: "/resultados/update/",
                data: ds,
                dataType: "json",
                success: function (response) {
                    alert(response.message);
                    $("#modalEditarResultados").modal("hide");
                    cargarPruebas($("#cita_id").val());
                }
            });
        }
        
        function btnEditarResultado(id_resultado) {
            $("#result_id").val(id_resultado);
            $.ajax({
                type: "GET",
                url: "/resultados/edit/"+id_resultado,
                dataType: "json",
                success: function (response) {
                    $("#edit_title").val(response.data.title);
                    $("#edit_description").val(response.data.description);
                }
            });
            $("#modalEditarResultados").modal("show");
        }
        btnActualizarResultados

        function btnEliminarResultado(id_resultado) {
            $("#id_registro_eliminar").val(id_resultado);
            $("#ruta_eliminar").val("/resultados/destroy/")
            $("#modalConfirmarEliminar").modal("show");
        }

        function btnRegistrarResultados(e) {
            e.preventDefault();
            ds=$("#formResultados").serialize();
            $.ajax({
                type: "POST",
                url: "/resultados/store/",
                data: ds,
                dataType: "json",
                success: function (response) {
                    cargarPruebas($("#cita_id").val());
                    $("#modalAgregarResultados").modal("hide");        
                    alert(response.message);
                }
            });
        }

        function modalAgregarResultados(e,id_test) {
            e.preventDefault();
            $("#result_test_id").val(id_test);
            $("#modalAgregarResultados").modal("show");
        }

        function btnActualizarPruebas(e) {
            e.preventDefault();
            ds=$("#formEditPruebas").serialize();
            $.ajax({
                type: "POST",
                url: "/pruebas/update/",
                data: ds,
                dataType: "json",
                success: function (response) {
                    cargarPruebas($("#cita_id").val());
                    alert(response.message);
                    $("#modalEditarPrueba").modal("hide");
                }
            });
        }

        function modalEditarPrueba(e,id) {
            $("#test_id").val(id);
            $.ajax({
                type: "GET",
                url: "/pruebas/edit/"+id,
                dataType: "json",
                success: function (response) {
                    $("#edit_tests_name").val(response.data.tests_name);
                    $("#edit_tests_comments").val(response.data.tests_comments);
                }
            });
            $("#modalEditarPrueba").modal("show");
        }

        function btnConfirmarEliminar() {
            let  id_eliminar=$("#id_registro_eliminar").val();
            let ruta = $("#ruta_eliminar").val();
            $("#modalConfirmarEliminar").modal("hide");
            $.ajax({
                type: "GET",
                url: ruta+id_eliminar,
                dataType: "json",
                success: function (response) {
                    alert(response.message);
                    cargarPruebas($("#cita_id").val());
                }
            });
        }

        function btnRegistrarPruebas(e) {
            e.preventDefault();
            ds=$("#formPruebas").serialize();
            $.ajax({
                type: "POST",
                url: "/pruebas/store",
                data: ds,
                dataType: "json",
                success: function (response) {
                    limpiarFormPruebas();
                    cargarPruebas($("#cita_id").val());
                    alert(response.message);
                }
            });

        }

        function btnPruebas(cita_id) {
            $("#cita_id").val(cita_id);
            cargarPruebas(cita_id);
            $("#modalPruebas").modal("show");
        }

        function cargarPruebas(cita_id) { 
            $.ajax({
                type: "GET",
                url: "/pruebas/index/" + cita_id,
                dataType: "json",
                success: function (response) {
                    $("#dtTests tbody").html("");
                    let num = 0
                    response.pruebas.forEach(element => {
                        let resultado=""
                        
                        num += 1
                        if (element.tests_comments===null) { descripcion = "" }else{ descripcion=element.tests_comments }
                        response.resultados.forEach(resultados => {
                            if (resultados.tests_id===element.id) {
                                resultado = resultado+"Título: "+resultados.title + "<br> " +
                                " Descripción: "+resultados.description+"<br>"+
                                "<i class='fas fa-window-close' onclick='btnEliminarResultado("+ resultados.id +")'></i>"+" "+
                                "<i class='fas fa-pencil-alt' onclick='btnEditarResultado("+ resultados.id +")'></i>"+
                                "<hr>"
                                
                            }
                        });

                        $("#dtTests tbody").append("<tr>"+
                                "<td>"+ num +"</td>"+
                                "<td>"+ element.tests_name +"</td>"+
                                "<td>"+ descripcion +"</td>"+
                                "<td>"+ 
                                    "<button onclick='modalAgregarResultados(event,"+element.id+")' data-bs-toggle='tooltip' title='agregar resultados' class='btn btn-sm btn-primary'><i class='fas fa-plus-circle'></i></button>"+
                                            "<p>" + resultado + "</p>" +
                                            "<br>"+
                                "</td>"+
                                "<td>"+
                                    "<button type='button' onclick='modalEditarPrueba(event,"+ element.id +")' class='btn btn-sm btn-warning' data-bs-toggle='tooltip' title='editar prueba'><i class='fas fa-edit' ></i></button>" +
                                    "<button type='button' onclick='modalConfirmarEliminarTests(event,"+ element.id +")' class='btn btn-sm btn-danger' data-bs-toggle='tooltip' title='eliminar prueba'><i class='fas fa-window-close'></i></button>" +
                                "</td>"+
                            "</tr>"
                        );
                        
                    });

                }
            });
         }

         function modalConfirmarEliminarTests(e,id_test) {
            e.preventDefault();
            $("#id_registro_eliminar").val(id_test);
            $("#ruta_eliminar").val("/pruebas/destroy/");
            $("#modalConfirmarEliminar").modal("show");
         }

         function limpiarFormPruebas() {
            $("#tests_name").val("");
            $("#tests_comments").val("");
         }
    </script>
@endsection
