<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('phones.index') }}">PHONES</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DETAILS</li>
                </ol>
            </nav>

            <!-- info de licensia -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">DETAILS</h5>
                </div>

                <div class="content-wrapper">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-body">
                                <h7><strong>Extension:</strong> {{ $phone->extension }}</h7> <br>
                                <h7><strong>Service:</strong> {{ $phone->service }}</h7> <br>
                                <h7><strong>Model:</strong> {{ $phone->model }}</h7> <br>
                                <h7><strong>Serial:</strong> {{ $phone->serial }}</h7> <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <a href="{{ route('phones.index') }}" class="btn btn-secondary"><i class='bx bx-arrow-back'></i>Volver</a>

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
