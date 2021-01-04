<form action="{{route('usuarios.store')}}" method="post" class="register">
    @csrf 
    <div class="form-row">
        <div class="form-group">
            <label>Archivo <small>xls, csv</small></label>
            <input type="file" accept=".xls,.csv" class="form-control">
        </div>
    </div>
    <div class="modal-footer"></div>
    <button type="submit" class="btn btn-outline-primary">REGISTRAR</button>
</form>