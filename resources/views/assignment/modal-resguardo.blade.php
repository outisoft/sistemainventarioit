<!-- Modal -->
<div class="modal fade" id="equiposModal" tabindex="-1" aria-labelledby="equiposModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="equiposModalLabel">Selecciona los equipos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="equiposForm">
                    <h6>Equipos</h6>
                    @foreach ($empleado->equipos as $equipo)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $equipo->id }}"
                                id="equipo{{ $equipo->id }}" name="equipos[]">
                            <label class="form-check-label" for="equipo{{ $equipo->id }}">
                                {{ $equipo->name }} / {{ $equipo->marca }} / {{ $equipo->model }} /
                                {{ $equipo->serial }}
                            </label>
                        </div>
                    @endforeach
                    <h6>Complementos</h6>
                    @foreach ($complementosAsignados as $complemento)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $complemento->id }}"
                                id="complemento{{ $complemento->id }}" name="complementos[]">
                            <label class="form-check-label" for="complemento{{ $complemento->id }}">
                                {{ $complemento->brand }} / {{ $complemento->model }} / {{ $complemento->serial }}
                            </label>
                        </div>
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="generatePdf">Generar PDF</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('generatePdf').addEventListener('click', function() {
        const form = document.getElementById('equiposForm');
        const selectedEquipos = [];
        const selectedComplementos = [];

        form.querySelectorAll('input[name="equipos[]"]:checked').forEach(checkbox => {
            selectedEquipos.push(checkbox.value);
        });

        form.querySelectorAll('input[name="complementos[]"]:checked').forEach(checkbox => {
            selectedComplementos.push(checkbox.value);
        });

        if (selectedEquipos.length === 0 && selectedComplementos.length === 0) {
            alert('Por favor, selecciona al menos un equipo o complemento.');
            return;
        }

        const empleadoId = {{ $empleado->id }};
        const url =
            `{{ route('save-pdf-tcc', ['id' => $empleado->id]) }}?equipos=${selectedEquipos.join(',')}&complementos=${selectedComplementos.join(',')}`;
        window.open(url, '_blank');
    });
</script>
