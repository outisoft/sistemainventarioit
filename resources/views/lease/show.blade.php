<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('lease.index') }}">LEASES</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DETAILS</li>
                </ol>
            </nav>

            <!-- info de licensia -->
            <div class="card">
                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <br>
                                <P class="card-title"><strong>LEASE:</strong> {{ $lease->lease }}</P>
                                <P class="card-title"><strong>END DATE:</strong> {{ $lease->end_date }}</P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <!--info de asignados -->
            <br>
            <a href="{{ route('sketchup.index') }}" class="btn btn-secondary"><i class='bx bx-arrow-back'></i>Volver</a>

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
