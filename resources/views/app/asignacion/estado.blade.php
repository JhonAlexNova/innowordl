<div class="pt-3">
    <div class="settings-form">
        <h4 class="text-primary">Estado</h4>
        <form action="{{route('detalles_asignacion.store')}}" method="post" class="register">
        @csrf 
        <div class="form-row">
            
            <div class="form-group col-md-3 id_dep">
                <input type="hidden"  name="id_user" value="{{$user->id_user}}">
                <label>Estado</label>
                <select name="id_estado"  class="form-control">
                    <option></option>
                    @foreach($estados as $key => $value)
                        <option value="{{$value->id}}"> {{$value->tipo}} </option>  
                    @endforeach

                    @if($user->id_estado==0)
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
                <label>Fecha <?php echo $hora_min; ?> </label>
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