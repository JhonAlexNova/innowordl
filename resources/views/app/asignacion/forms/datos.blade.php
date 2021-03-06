<div class="pt-3">
    <div class="settings-form">
         @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {!! Session::get('success') !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
        <h4 class="text-primary">Datos personales</h4>
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


            @if($_REQUEST['page']=='matriculados')
                @if(Session::get('id_rol')==2)
                     <div class="form-group col-md-3 asignacion">
                        <input type="hidden"  name="page" value="{{ $_REQUEST['page'] }}">
                         <input type="hidden"  name="id_matricula" value="{{ $matricula->id }}">
                        <label>Broker asignado</label>
                        <select name="id_broker" class="form-control">
                            <option></option>


                            @foreach($users as $key => $value)
                                @if($matricula->id_broker==$value->id_)
                                    <option value="{{$value->id_}}" selected="selected"> {{$value->nombres}} {{$value->apellidos}} </option>
                                @else
                                    <option value="{{$value->id_}}"> {{$value->nombres}} {{$value->apellidos}} </option>
                                @endif
                                
                            @endforeach
                        </select>
                    </div> 
                @endif
                   
            @endif

                 


        </div>
        <div class="modal-footer"></div>
        <button type="submit" class="btn btn-outline-primary">Actualizar</button>
    </form>
    </div>
</div>