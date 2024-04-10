<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog" aria-labelledby="modalImport">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="text-align: center;">
                <form action="{{ url('importequipo') }}" method="POST" enctype="multipart/form-data"
                    onsubmit="return validateForm()">
                    @csrf
                    <input type="file" name="file" id="myFileInput" style="display: none;">
                    <label for="myFileInput"
                        style=" color: black; padding: 12px 20px; text-align: center; display: inline-block; cursor: pointer;"><i
                            class='bx bxs-cloud-upload icon-bg'></i>Seleccionar archivo</label>
                    <button type="submit" class="btn btn-primary">Importar</button>
                </form>
            </div>
        </div>
    </div>
</div>