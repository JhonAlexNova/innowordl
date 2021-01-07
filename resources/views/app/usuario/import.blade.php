<form action="{{route('usuarios.store')}}" method="post" class="register" enctype="multipart/form-data">
    @csrf 
    <div class="form-row">
        <div class="form-group">
            <label>Archivo <small>xls, csv</small></label>
            <input type="file" name="file" accept=".xls,.csv,.xlsx" class="form-control">
        </div>
    </div>
    <div class="modal-footer"></div>
    <button type="submit" class="btn btn-outline-primary">Importar</button>
</form>