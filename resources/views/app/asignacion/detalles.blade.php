@extends('layouts.dash')
@section('title','usuarios')
@section('content')
<div class="row">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Detalles asignación</a></li>
        </ol>
    </div>
</div>





<div class="row">
    <div class="col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="profile-blog mb-5">
                    <h5 class="text-primary d-inline">Información</h5>
                    <img src="images/profile/1.jpg" alt="" class="img-fluid mt-4 mb-4 w-100">
                    <p><b>Nombres: </b>   {{$user->nombres}}  <br></p>
                    <p><b>Apellidos: </b>   {{$user->apellidos}} <br></p>
                    <p><b>Documento: </b>   {{$user->documento}} <br></p>
                    <p><b>Telefono: </b>   {{$user->telefono}} <br></p>
                    <p><b>Correo: </b>   {{$user->email}} <br></p>
                    <p><b>Fecha registro: </b>   {{$user->fecha_registro}} {{$user->hora_reg}} <br></p>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="profile-tab">
                    <div class="custom-tab-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="#profile" data-toggle="tab" class="nav-link show active">Datos</a>
                            </li>
                            <li class="nav-item"><a href="#estado" data-toggle="tab" class="nav-link">Estado</a>
                            </li>
                             <li class="nav-item"><a href="#detalles" data-toggle="tab" class="nav-link">Historial de cambios</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="profile" class="tab-pane fade active show">
                                @include('app.asignacion.datos')
                            </div>
                            <div id="estado" class="tab-pane fade">
                                @include('app.asignacion.estado')
                            </div>
                            <div id="detalles" class="tab-pane fade">
                                @include('app.asignacion.historial')
                            </div>
                        </div>
                    </div>
					<!-- Modal -->
					<div class="modal fade" id="replyModal">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Post Reply</h5>
									<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
								</div>
								<div class="modal-body">
									<form>
										<textarea class="form-control" rows="4">Message</textarea>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Reply</button>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/controller/CiudadController.js')}}"></script>
@endsection