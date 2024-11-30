<x-app-layout>
    @include('comunications.phone.create')

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Comunications /</span> Phones </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Phones List</h5>
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <a href="#" class="btn-ico" data-toggle="modal" data-target="#modalCreate" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<span>Add new phone</span>">
                                <i class='bx bx-add-to-queue icon-lg'></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="table-responsive text-nowrap" id="searchResults">
                                <table id="phones" class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Extension</th>
                                            <th>Service</th>
                                            <th>Model</th>
                                            <th>Serial number</th>
                                            <th>Status</th>
                                            <th>remarks</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeList">
                                        <!-- Aquí se mostrarán los empleados -->
                                        @foreach ($phones as $phone)
                                            <tr>
                                                <td>{{ $phone->extension }}</td>
                                                <td>{{ $phone->service }}</td>
                                                <td>{{ $phone->model }}</td>
                                                <td>{{ $phone->serial }}</td>
                                                <td></td>
                                                <td>{{ $phone->remarks }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $phone->id }}" class="dropdown-item"><i class="bx bx-edit me-1"></i>Editar</a>


                                                            <form action="{{ route('phones.destroy', $phone->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="dropdown-item btn-danger"
                                                                    onclick="return confirm('¿Estás seguro de eliminar este equipo?')"><i
                                                                        class="bx bx-trash me-1"></i>Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#hotel-select').change(function() {
        var hotelId = $(this).val();
        if (hotelId) {
            $.get('/hotel/' + hotelId + '/departments', function(data) {
                $('#department-select').prop('disabled', false);
                $('#department-select').empty();
                $('#department-select').append('<option value="">Selecciona un departamento</option>');
                $.each(data, function(index, department) {
                    $('#department-select').append('<option value="' + department.id + '">' + department.name + '</option>');
                });
            });
        } else {
            $('#department-select').prop('disabled', true);
            $('#department-select').empty();
            $('#department-select').append('<option value="">Selecciona un departamento</option>');
        }
    });
});
</script>