<!-- Total Equipo por tipo  -->
<div class="col-xl-6 col-12 mb-4">
    <div class="card">
        <div class="card-header header-elements">
            <h5 class="card-title mb-0">Laptop's {{ now()->format('Y') }}</h5>
            <div class="card-action-element ms-auto py-0">
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false"><i class='bx bxs-file-doc'></i></button>
                    <ul class="dropdown-menu dropdown-menu-end" style="">
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Excel</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">PDF</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="laptopChart"></div>
        </div>
    </div>
</div>
