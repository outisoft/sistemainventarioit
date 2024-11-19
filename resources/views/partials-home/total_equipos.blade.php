<!-- Total Equipo por tipo  -->
<div class="col-xl-6 col-12 mb-4">
    <div class="card">
        <div class="card-header header-elements">
            <h5 class="card-title mb-0">Total equipments {{ now()->format('Y') }}</h5>
        </div>
        <div class="card-body">
            <div id="chart"></div>
        </div>
    </div>
</div>

<!-- Total Equipo por tipo Laptop -->
<div class="col-xl-6 col-12 mb-4">
    <div class="card">
        <div class="card-header header-elements">
            <h5 class="card-title mb-0">Total laptops in hotels {{ now()->format('Y') }}</h5>
        </div>
        <div class="card-body">
            <div id="laptopsChart"></div>
        </div>
    </div>
</div>

<!-- Total Equipo por tipo DESKTOP -->
<div class="col-xl-6 col-12 mb-4">
    <div class="card">
        <div class="card-header header-elements">
            <h5 class="card-title mb-0">Total desktops in hotels {{ now()->format('Y') }}</h5>
        </div>
        <div class="card-body">
            <div id="desktopsChart"></div>
        </div>
    </div>
</div>