<x-app-layout>
    <div class="container-xxl navbar-expand-xl align-items-center">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
    </div>

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                    <a href="{{ route('users.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    .. / Usuarios /</span> Graficas </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="card-header flex-column flex-md-row pb-0">
                            <div class="head-label text-center">
                                <h5 class="card-title mb-0">DataTable with Buttons</h5>
                            </div>
                            <div class="dt-action-buttons text-end pt-6 pt-md-0">
                                <div class="dt-buttons btn-group flex-wrap"> 
                                    <div class="btn-group">
                                        <button class="btn buttons-collection dropdown-toggle btn-label-primary me-4" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false" control-id="ControlID-1">
                                            <span>
                                                <i class="bx bx-export bx-sm me-sm-2"></i> 
                                                <span class="d-none d-sm-inline-block">Export</span>
                                            </span>
                                        </button>
                                    </div> 
                                    <button class="btn btn-secondary create-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" control-id="ControlID-2">
                                        <span><i class="bx bx-plus bx-sm me-sm-2"></i> 
                                        <span class="d-none d-sm-inline-block">Add New Record</span>
                                    </span>
                                </button> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0">
                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label>Search:<input type="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0" control-id="ControlID-4">
                                </label>
                            </div>
                        </div>
                    </div>
                    <table class="datatables-basic table border-top dataTable no-footer dtr-column collapsed" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1391px;">
                        <thead>
                            <tr>
                                <th class="control sorting_disabled" rowspan="1" colspan="1" style="width: 0px;" aria-label=""></th>
                                <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1" style="width: 18px;" data-col="1" aria-label="">
                                    <input type="checkbox" class="form-check-input" control-id="ControlID-5">
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 316px;" aria-label="Name: activate to sort column ascending">
                                    Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 300px;" aria-label="Email: activate to sort column ascending">
                                    Email
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 106px;" aria-label="Date: activate to sort column ascending">
                                    Date
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 104px;" aria-label="Salary: activate to sort column ascending">
                                    Salary
                                </th>
                                <th class="sorting dtr-hidden" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 125px; display: none;" aria-label="Status: activate to sort column ascending">
                                    Status
                                </th>
                                <th class="sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 116px; display: none;" aria-label="Actions">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd">
                                <td class="control" tabindex="0" style=""></td>
                                <td class="  dt-checkboxes-cell">
                                    <input type="checkbox" class="dt-checkboxes form-check-input" control-id="ControlID-14">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar me-2">
                                                <span class="avatar-initial rounded-circle bg-label-success">
                                                    GG
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="emp_name text-truncate">
                                                Glyn Giacoppo
                                            </span>
                                            <small class="emp_post text-truncate text-muted">
                                                Software Test Engineer
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>ggiacoppo2r@apache.org</td>
                                <td>04/15/2021</td>
                                <td>$24973.48</td>
                                <td class="dtr-hidden" style="display: none;">
                                    <span class="badge  bg-label-success">Professional</span>
                                </td>
                                <td class="dtr-hidden" style="display: none;">
                                    <div class="d-inline-block">
                                        <a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded bx-md"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end m-0" style="">
                                            <li>
                                                <a href="javascript:;" class="dropdown-item">Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="dropdown-item">Archive</a>
                                            </li>
                                            <div class="dropdown-divider"></div>
                                            <li>
                                                <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:;" class="btn btn-icon item-edit">
                                        <i class="bx bx-edit bx-md"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr class="even">
                                <td class="control" tabindex="0" style=""></td>
                                <td class="  dt-checkboxes-cell">
                                    <input type="checkbox" class="dt-checkboxes form-check-input" control-id="ControlID-15">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar me-2">
                                                <img src="../../assets/img/avatars/10.png" alt="Avatar" class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="emp_name text-truncate">Evangelina Carnock</span>
                                            <small class="emp_post text-truncate text-muted">Cost Accountant</small>
                                        </div>
                                    </div>
                                </td>
                                <td>ecarnock2q@washington.edu</td>
                                <td>01/26/2021</td>
                                <td>$23704.82</td>
                                <td class="dtr-hidden" style="display: none;">
                                    <span class="badge  bg-label-warning">Resigned</span>
                                </td>
                                <td class="dtr-hidden" style="display: none;">
                                    <div class="d-inline-block">
                                        <a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded bx-md"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end m-0">
                                            <li>
                                                <a href="javascript:;" class="dropdown-item">Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="dropdown-item">Archive</a>
                                            </li>
                                            <div class="dropdown-divider"></div>
                                            <li>
                                                <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:;" class="btn btn-icon item-edit">
                                        <i class="bx bx-edit bx-md"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr class="odd">
                                <td class="control" tabindex="0" style=""></td>
                                <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input" control-id="ControlID-16"></td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar me-2">
                                                <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="emp_name text-truncate">Olivette Gudgin</span>
                                            <small class="emp_post text-truncate text-muted">Paralegal</small>
                                        </div>
                                    </div>
                                </td>
                                <td>ogudgin2p@gizmodo.com</td>
                                <td>04/09/2021</td>
                                <td>$15211.60</td>
                                <td class="dtr-hidden" style="display: none;">
                                    <span class="badge  bg-label-success">Professional</span>
                                </td>
                                <td class="dtr-hidden" style="display: none;">
                                    <div class="d-inline-block">
                                        <a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded bx-md"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end m-0">
                                            <li>
                                                <a href="javascript:;" class="dropdown-item">Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="dropdown-item">Archive</a>
                                            </li>
                                            <div class="dropdown-divider"></div>
                                            <li>
                                                <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:;" class="btn btn-icon item-edit">
                                        <i class="bx bx-edit bx-md"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr class="even"><td class="control" tabindex="0" style=""></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input" control-id="ControlID-17"></td><td><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-primary">RP</span></div></div><div class="d-flex flex-column"><span class="emp_name text-truncate">Reina Peckett</span><small class="emp_post text-truncate text-muted">Quality Control Specialist</small></div></div></td><td>rpeckett2o@timesonline.co.uk</td><td>05/20/2021</td><td>$16619.40</td><td class="dtr-hidden" style="display: none;"><span class="badge  bg-label-warning">Resigned</span></td><td class="dtr-hidden" style="display: none;"><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><ul class="dropdown-menu dropdown-menu-end m-0"><li><a href="javascript:;" class="dropdown-item">Details</a></li><li><a href="javascript:;" class="dropdown-item">Archive</a></li><div class="dropdown-divider"></div><li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li></ul></div><a href="javascript:;" class="btn btn-icon item-edit"><i class="bx bx-edit bx-md"></i></a></td></tr><tr class="odd"><td class="control" tabindex="0" style=""></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input" control-id="ControlID-18"></td><td><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">AB</span></div></div><div class="d-flex flex-column"><span class="emp_name text-truncate">Alaric Beslier</span><small class="emp_post text-truncate text-muted">Tax Accountant</small></div></div></td><td>abeslier2n@zimbio.com</td><td>04/16/2021</td><td>$19366.53</td><td class="dtr-hidden" style="display: none;"><span class="badge  bg-label-warning">Resigned</span></td><td class="dtr-hidden" style="display: none;"><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><ul class="dropdown-menu dropdown-menu-end m-0"><li><a href="javascript:;" class="dropdown-item">Details</a></li><li><a href="javascript:;" class="dropdown-item">Archive</a></li><div class="dropdown-divider"></div><li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li></ul></div><a href="javascript:;" class="btn btn-icon item-edit"><i class="bx bx-edit bx-md"></i></a></td></tr><tr class="even"><td class="control" tabindex="0" style=""></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input" control-id="ControlID-19"></td><td><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar me-2"><img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><span class="emp_name text-truncate">Edwina Ebsworth</span><small class="emp_post text-truncate text-muted">Human Resources Assistant</small></div></div></td><td>eebsworth2m@sbwire.com</td><td>09/27/2021</td><td>$19586.23</td><td class="dtr-hidden" style="display: none;"><span class="badge bg-label-primary">Current</span></td><td class="dtr-hidden" style="display: none;"><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><ul class="dropdown-menu dropdown-menu-end m-0"><li><a href="javascript:;" class="dropdown-item">Details</a></li><li><a href="javascript:;" class="dropdown-item">Archive</a></li><div class="dropdown-divider"></div><li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li></ul></div><a href="javascript:;" class="btn btn-icon item-edit"><i class="bx bx-edit bx-md"></i></a></td></tr><tr class="odd"><td class="control" tabindex="0" style=""></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input" control-id="ControlID-20"></td><td><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">RH</span></div></div><div class="d-flex flex-column"><span class="emp_name text-truncate">Ronica Hasted</span><small class="emp_post text-truncate text-muted">Software Consultant</small></div></div></td><td>rhasted2l@hexun.com</td><td>07/04/2021</td><td>$24866.66</td><td class="dtr-hidden" style="display: none;"><span class="badge  bg-label-warning">Resigned</span></td><td class="dtr-hidden" style="display: none;"><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><ul class="dropdown-menu dropdown-menu-end m-0"><li><a href="javascript:;" class="dropdown-item">Details</a></li><li><a href="javascript:;" class="dropdown-item">Archive</a></li><div class="dropdown-divider"></div><li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li></ul></div><a href="javascript:;" class="btn btn-icon item-edit"><i class="bx bx-edit bx-md"></i></a></td></tr></tbody>
                    </table><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 7 of 100 entries</div></div><div class="col-sm-12 col-md-6"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link"><i class="bx bx-chevron-left bx-18px"></i></a></li><li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="14" tabindex="0" class="page-link">15</a></li><li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="next" tabindex="0" class="page-link"><i class="bx bx-chevron-right bx-18px"></i></a></li></ul></div></div></div><div style="width: 1%;"></div></div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>

    <script>
        // Función común para crear gráficos
function crearGrafico(canvasId, datos, etiquetas, titulo) {
    const ctx = document.getElementById(canvasId).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: etiquetas,
            datasets: [{
                label: titulo,
                backgroundColor: customColors,
                borderColor: customColors,
                borderWidth: 1,
                data: datos
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Colores personalizados
const customColors = ['#2f2119', '#54402f', '#604933', '#715737', '#8d7141', '#a48c4e', '#b5a160', '#c5b87f', '#dad3ae', '#ece9d5'];

// Crear todas las gráficas
document.addEventListener('DOMContentLoaded', function() {
    // Gráfico 1: Empleados por Hotel
    const empleadosPorHotel = @json($empleadosPorHotel);
    const labelsEPH = empleadosPorHotel.map(data => data.hotel);
    const dataEPH = empleadosPorHotel.map(data => data.cantidad_empleados);
    crearGrafico('grafico1', dataEPH, labelsEPH, 'Empleados por Hotel');

    // Gráfico 2: Empleados por Departamento
    const empleadosPorDepartamento = @json($empleadosPorDepartamento);
    const labelsEPD = empleadosPorDepartamento.map(data => data.departamento);
    const dataEPD = empleadosPorDepartamento.map(data => data.cantidad_empleados);
    crearGrafico('grafico2', dataEPD, labelsEPD, 'Empleados por Departamento');

    // Gráfico 3: Equipos por Tipo
    const equiposPorTipo = @json($equiposPorTipo);
    const labelsEPT = equiposPorTipo.map(data => data.tipo);
    const dataEPT = equiposPorTipo.map(data => data.cantidad_equipos);
    crearGrafico('grafico3', dataEPT, labelsEPT, 'Equipos por Tipo');

    // Gráfico 4: Total de Laptops por Hotel
    const datosLap = @json($datosLap);
    const hotelesLap = datosLap.map(item => item.hotel);
    const equiposLaptop = datosLap.filter(item => item.tipo_equipo === 'LAPTOP').map(item => item.cantidad_equipos);
    crearGrafico('grafico4', equiposLaptop, hotelesLap, 'Total de Laptops por Hotel');

    // Gráfico 5: Total de CPUs por Hotel
    const datosCPU = @json($datosCPU);
    const hotelesCPU = datosCPU.map(item => item.hotel);
    const cantidadCPU = datosCPU.filter(item => item.tipo_equipo === 'CPU').map(item => item.cantidad_equipos);
    crearGrafico('grafico5', cantidadCPU, hotelesCPU, 'Total de CPUs por Hotel');
});
    </script>
</x-app-layout>
<script>
    document.querySelector("body > div.layout-wrapper.layout-content-navbar > div.layout-container > div > div > div.container-xxl.flex-grow-1.container-p-y")
</script>