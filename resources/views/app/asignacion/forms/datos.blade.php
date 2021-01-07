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
            @include('app.asignacion.forms.datos')
        </div>
        <div id="estado" class="tab-pane fade">
            @include('app.asignacion.forms.estado')
        </div>
        <div id="detalles" class="tab-pane fade">
            @include('app.asignacion.forms.historial')
        </div>
    </div>
</div>


<div class="pt-3">
    <div class="settings-form">
        <h4 class="text-primary">Account Setting</h4>
        <form action="{{route('usuarios.update',$user->id_user)}}" method="post" class="register">
        @csrf 
        @method('put')
        <div class="form-row">
            
            <div class="form-group col-md-3 nombres">
                <label>Nombres</label>
                <input type="text" name="nombres" class="form-control" placeholder="Ingresar nombres" required="on" value="{{$user->nombres}}">
            </div>
            <div class="form-group col-md-3 apellidos">
                <label>Apellidos</label>
                <input type="text" name="apellidos" class="form-control" placeholder="Ingresar apellidos" required="on" value="{{$user->apellidos}}">
            </div>
            <div class="form-group col-md-3 telefono">
                <label>Numero de contacto</label>
                <input type="text" name="telefono" class="form-control" placeholder="Ingresar numero de contacto" value="{{$user->telefono}}">
            </div>
            <div class="form-group col-md-3 email">
                <label>Correo</label>
                <input type="text" name="email" class="form-control" placeholder="Correo electronico" autocomplete="Correo electronico" value="{{$user->email}}">
            </div>
           
            <div class="form-group col-md-3 id_ciudad">
                <label>Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{$user->direccion}}">
            </div>
            <div class="form-group col-md-3 id_tipo_doc">
                <label>Tipo documento</label>
                <select name="id_tipo_documento" class="form-control">
                    <option></option>
                    @foreach($tipos_documentos as $key => $value)
                         @if($user->id_tipo_documento == $value->id)
                            <option value="{{$value->id}}" selected="on"> {{$value->tipo}} </option>
                         @else
                            <option value="{{$value->id}}"> {{$value->tipo}} </option>
                         @endif
                        
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3 documento">
                <label>Documento</label>
                <input type="text" name="documento" class="form-control" placeholder="Ingresar numero documento" value="{{$user->documento}}">
            </div>

            <div class="form-group col-md-3 documento">
                <label>Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control"  value="{{$user->fecha_nacimiento}}">
            </div>

            @if(Session::get('id_rol')==20)
                <div class="form-group col-md-3 asignacion">
                    <label>Broker asignado</label>
                    <select name="id_broker" class="form-control">
                        <option></option>
                        @foreach($users as $key => $value)
                            <option value="{{$value->id_}}"> {{$value->nombres}} {{$value->apellidos}} </option>
                        @endforeach
                    </select>
                </div> 
            @endif

                 


        </div>
        <div class="modal-footer"></div>
        <button type="submit" class="btn btn-outline-primary">REGISTRAR</button>
    </form>
    </div>
</div>