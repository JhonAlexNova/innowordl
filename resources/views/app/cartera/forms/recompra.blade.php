<div class="custom-tab-1">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a href="#detalles_programa" data-toggle="tab" class="nav-link show active">Detalles programa</a></li>
        <li class="nav-item"><a href="#seguimiento" data-toggle="tab" class="nav-link ">Seguimiento</a></li>
    </ul>
    <br>
     <div class="tab-content">
        
        <div id="detalles_programa" class="tab-pane fade show active">
           
            <form action="">
                <div class="row">
                    
                    <div class="col-md-3 form-group">
                        <b>Fecha inicio</b>
                        <input type="text" class="form-control" disabled value="{{ $programa_user->fecha_inicio }}">
                    </div>
                     <div class="col-md-3 form-group">
                        <b>Fecha fin</b>
                        <input type="text" class="form-control" disabled value="{{ $programa_user->fecha_fin }}">
                    </div>
                     <div class="col-md-3 form-group">
                        <b>Fecha inicio</b>
                        <select name="estado" class="form-control" disabled>
                            <option value="Aprobado">Aprobado</option>
                            <option value="Reprobado">Reprobado</option>
                            <option value="En proceso">En proceso</option>
                        </select>
                        <script>
                            $('select[name=estado] option[value="{{ $programa_user->estado }}"]').prop('selected',true);

                        </script>
                    </div>

                    <div class="col-md-3 form-group">
                        <b>Nivel</b>
                        <input type="text" class="form-control" disabled value="{{ $programa_user->niveles->nombre }}">
                    </div>
                     <div class="col-md-3 form-group">
                        <b>Grupos</b>
                        <input type="text" class="form-control" disabled value="{{ $programa_user->grupos->nombre }}">
                    </div>
                </div>
            </form>
        </div>

        <div id="seguimiento" class="tab-pane fade">
            @if(Session::get('error'))
                <p> {{ Session::get('error') }} </p>
            @endif
            <form action="{{ route('detalles_asignacion.store') }}" method="post">
                @csrf
                <input type="hidden" value="5" name="id_modulo">
                <input type="hidden" value="{{ $user->id }}" name="id_user">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <b>Estado</b>
                        <select name="id_estado" class="form-control">
                            <option>--Seleccionar--</option>
                            @foreach($estadosModulo as $key => $value)
                                <option value="{{ $value->estados->id }}">  {{ $value->estados->tipo }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <?php 
                            $fecha_min = date('Y-m-d');
                            $hora_min = date('H');

                         ?>
                        <label>Fecha  </label>
                        <input type="date" name="fecha" class="form-control" min="<?php echo $fecha_min; ?>">
                    </div>


                    <div class="form-group col-md-3">
                        <b>Hora</b>
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
                        <b>Minuto</b>
                        <select name="minuto" class="form-control">
                            <option></option>
                            <option value="00">0</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                    </div>

                    <div class="col-md-12 form-group">
                        <b>Observación</b>
                        <textarea name="observacion" class="form-control" rows="7"></textarea>
                    </div>
                    
                </div>

                <div class="form-group">
                        <hr>
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    
</div>