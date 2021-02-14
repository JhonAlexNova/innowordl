<div class="pt-3">
    <div class="settings-form">
        <h4 class="text-primary">Estado del estudiante en inducción</h4>
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {!! Session::get('success') !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
        <form action="{{route('detalles_asignacion.store')}}" method="post" class="register">
        @csrf 
        <div class="form-row">
            
                <input type="hidden"  name="id_user" value="{{$user->id_user}}">
                <input type="hidden"  name="id_estado" value="{{$user->id_estado}}">
                <input type="hidden"  name="id_nivel" value="{{ $usere->id_nivel }}">
            
            <div class="form-group col-md-3 id_dep">
                <input type="hidden"  name="id_user" value="{{$usere->id_user}}">
                <label>Estado</label>
                <select name="estado_etapa"  class="form-control" id="estado">
                    <option></option>
                    @foreach($estados_eta as $key => $value)
                        @if($value->id==$user->id_estado)
                            <option value="{{$value->id}}" selected="on"> {{$value->nombre}}   </option>
                        @else
                            <option value="{{$value->id}}"> {{$value->nombre}}  </option>
                        @endif
                    @endforeach

                    @if($usere->id_estado==0)
                        <option value="0" selected="on"> REGISTRADO Y ASIGNADO </option>                            
                    @endif
                </select>
            </div>
            <div class="form-group col-md-3" id="id_nivel">
                <label>Nivel</label>
                <p>{{$usere->id_nivel}}</p>
                <!--<select name="id_nivel"  class="form-control">
                    <option></option>
                    @foreach($niveles as $key => $value)
                        @if($value->id==$usere->id_nivel)
                            <option value="{{$value->id}}" selected="on"> {{$value->nombre}}   </option>
                        @else
                            <option value="{{$value->id}}"> {{$value->nombre}}  </option>
                        @endif
                    @endforeach

                    @if($usere->id_estado==0)
                        <option value="0" selected="on"> REGISTRADO Y ASIGNADO </option>                            
                    @endif
                </select>-->
            </div>
            <div class="form-group col-md-3" id="id_grupo">
                <label>Grupo</label>
                <select name="id_grupo"  class="form-control">
                    <option></option>
                    @foreach($grupos as $key => $value)
                        @if($value->id==$usere->id_nivel)
                            <option value="{{$value->id}}" selected="on"> {{$value->nombre}}   </option>
                        @else
                            <option value="{{$value->id}}"> {{$value->nombre}}  </option>
                        @endif
                    @endforeach

                    @if($usere->id_estado==0)
                        <option value="0" selected="on"> REGISTRADO Y ASIGNADO </option>                            
                    @endif
                </select>
            </div>
            <div class="form-group col-md-3 id_ciudad">
                <?php 
                    date_default_timezone_set('America/Bogota');
                    $fecha_min = date('Y-m-d');
                    $hora_min = date('H');

                 ?>
                <label>Fecha  </label>
                <input type="date" name="fecha" class="form-control" min="<?php echo $fecha_min; ?>">
            </div>
            <div class="form-group col-md-3 id_ciudad">
                <label>Hora</label>
                <select name="hora" class="form-control">
                    <option></option>
                    <?php 
                        $hora = 7;
                        $value = 7;
                        $jornada = 'AM';
                        while ($value<=21) {
                            if($hora==12){
                                $jornada = 'PM';
                            }
                            echo "<option value='".$value."'>".$hora." ".$jornada."</option>";
                            $value++;
                            $hora++;
                            if($hora==13){
                                $hora = 1;
                            }
                        }
                     ?>
                </select>
            </div>
            <div class="form-group col-md-3 id_ciudad">
                <label>Minuto</label>
                <select name="minuto" class="form-control">
                    <option></option>
                    <option value="00">0</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>
            </div>

            <div class="form-group col-md-12">
                <label >Observación</label>
                <textarea name="observacion" class="form-control" rows="10" required="on"></textarea>
            </div>

        </div>
        <div class="modal-footer"></div>
        <button type="submit" class="btn btn-outline-primary">ACTUALIZAR</button>
    </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        
        $("#id_nivel").hide();
        $("#id_grupo").hide();
         $('#estado').on('change', function() {
            if(this.value == 4){
                $("#id_nivel").show();
                $("#id_grupo").show();
            }else{
                $("#id_nivel").hide();
                $("#id_grupo").hide();
               
            }
         });
    })
  
</script>