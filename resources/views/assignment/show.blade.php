<x-app-layout>
    @include('assignment.modal-resguardo')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('assignment.index') }}">ASSIGN</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">DETAILS</li>
                </ol>
            </nav>

            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">

                    <div
                        class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                        <div class="mb-2 mb-sm-0">
                            <h4 class="mb-1">Employee ID #{{ $empleado->no_empleado }}</h4>
                            <p class="mb-0">{{ $empleado->created_at }}</p>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <!-- Customer-detail Sidebar -->
                        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                            <!-- Customer-detail Card -->
                            <div class="card mb-6">
                                <div class="card-body pt-12">
                                    <div class="customer-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mb-4" src="{{ asset('images/gp-Logo.png') }}"
                                                height="120" width="120" alt="User avatar">
                                            <div class="customer-info text-center mb-6">
                                                <h5 class="mb-0">{{ $empleado->name }}</h5>
                                                <span>Employee ID #{{ $empleado->no_empleado }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="{{ route('generateQRCode', $empleado->id) }}" target="_blank"
                                                    class="btn-ico me-2" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                    data-bs-placement="top" data-bs-html="true" title=""
                                                    data-bs-original-title="<span>QR Code</span>">
                                                    <i class='bx bx-qr-scan icon-lg'></i>
                                                </a>
                                                <a href="#" class="btn-ico" data-bs-toggle="modal"
                                                    data-bs-target="#equiposModal" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    title=""
                                                    data-bs-original-title="<span>Responsive sheet</span>">
                                                    <i class='bx bxs-file-pdf icon-lg'></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="info-container">
                                        <h5 class="pb-4 border-bottom text-capitalize mt-6 mb-4">Details</h5>
                                        <ul class="list-unstyled mb-6">
                                            <li class="mb-2">
                                                <span class="h6 me-1">Username:</span>
                                                <span>{{ $empleado->ad }}</span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="h6 me-1">Email:</span>
                                                <span>{{ $empleado->email }}</span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="h6 me-1">Status:</span>
                                                @if ($empleado->equipos->isNotEmpty())
                                                    <span class="badge bg-label-success">Active</span>
                                                @else
                                                    <span class="badge bg-label-danger">Inactive</span>
                                                @endif
                                            </li>
                                            <li class="mb-2">
                                                <span class="h6 me-1">Department:</span>
                                                <span>{{ $empleado->departments->name }}</span>
                                            </li>

                                            <li class="mb-2">
                                                <span class="h6 me-1">Locations:</span>
                                                <span>{{ $empleado->hotel->name }}</span>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <a href="javascript:;" class="btn btn-primary w-100"
                                                data-bs-target="#editUser" data-bs-toggle="modal">Edit Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Customer-detail Card -->
                        </div>

                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                            <h6 class="text-body-secondary">Assignments</h6>
                            <div class="nav-align-top">
                                <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                                    <li class="nav-item mb-1 mb-sm-0" role="presentation">
                                        <button type="button" class="nav-link active" role="tab"
                                            data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home"
                                            aria-controls="navs-pills-justified-home" aria-selected="true">
                                            <span class="d-none d-sm-inline-flex align-items-center">
                                                <i class="icon-base bx bx-desktop icon-sm me-1_5"></i> Equipments
                                            </span>
                                            <i class="icon-base bx bx-desktop icon-sm d-sm-none"></i>
                                        </button>
                                    </li>
                                    <li class="nav-item mb-1 mb-sm-0" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-justified-messages"
                                            aria-controls="navs-pills-justified-messages" aria-selected="false"
                                            tabindex="-1">
                                            <span class="d-none d-sm-inline-flex align-items-center"><i
                                                    class="icon-base bx bxs-keyboard icon-sm me-1_5"></i>
                                                Complements</span>
                                            <i class="icon-base bx bxs-keyboard icon-sm d-sm-none"></i>
                                        </button>
                                    </li>
                                    <li class="nav-item mb-1 mb-sm-0" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-justified-profile"
                                            aria-controls="navs-pills-justified-profile" aria-selected="false"
                                            tabindex="-1">
                                            <span class="d-none d-sm-inline-flex align-items-center"><i
                                                    class="icon-base bx bxl-adobe icon-sm me-1_5"></i> Licenses</span>
                                            <i class="icon-base bx bxl-adobe icon-sm d-sm-none"></i>
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Equipments -->
                                    <div class="tab-pane fade active show" id="navs-pills-justified-home"
                                        role="tabpanel">
                                        <div id="accordionPayment" class="accordion">
                                            @if ($empleado->equipos->isNotEmpty())
                                                @foreach ($empleado->equipos as $index => $equipo)
                                                    <div class="card accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" aria-expanded="false"
                                                                data-bs-target="#accordionPayment-{{ $index }}"
                                                                aria-controls="accordionPayment-{{ $index }}">
                                                                {{ $equipo->tipo->name }}
                                                                @if (!empty($equipo->name))
                                                                    <span> - {{ $equipo->name }} </span>
                                                                @endif
                                                            </button>
                                                        </h2>

                                                        <div id="accordionPayment-{{ $index }}"
                                                            class="accordion-collapse collapse">
                                                            <div class="accordion-body">
                                                                <span class="h6 me-1"> BRAND </span>:
                                                                {{ $equipo->marca }} <br>
                                                                <span class="h6 me-1"> MODEL </span>:
                                                                {{ $equipo->model }} <br>
                                                                <span class="h6 me-1"> SERIAL NUMBER </span>:
                                                                {{ $equipo->serial }}
                                                                <br>
                                                                @if (!empty($equipo->ip))
                                                                    <span class="h6 me-1"> IP </span>:
                                                                    {{ $equipo->ip }}
                                                                    <br>
                                                                @endif

                                                                @if (!empty($equipo->so))
                                                                    <span class="h6 me-1"> SO </span>:
                                                                    {{ $equipo->so }}
                                                                    <br>
                                                                @endif


                                                                <a href="{{ route('desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}"
                                                                    data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                                    data-bs-placement="top" data-bs-html="true"
                                                                    title=""
                                                                    data-bs-original-title="<span>Unlink employee equipment</span>"
                                                                    class="btn btn-danger btn-sm"><i
                                                                        class='bx bx-trash'></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>No equipment(s) assigned.<a href="{{ route('equipo.index') }}"> Add
                                                        equipment(s) -></a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Complements -->
                                    <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                                        <div id="accordionComplementos" class="accordion">
                                            @if ($empleado->equipos->isNotEmpty())

                                                @if ($equipo->complements->isNotEmpty())
                                                    @foreach ($empleado->equipos as $index => $equipo)
                                                        <div class="card accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    data-bs-target="#accordionComplementos-{{ $index }}"
                                                                    aria-controls="accordionComplementos-{{ $index }}">
                                                                    {{ $equipo->tipo->name }}
                                                                    @if (!empty($equipo->name))
                                                                        <span> - {{ $equipo->name }} </span>
                                                                    @endif
                                                                </button>
                                                            </h2>

                                                            <div id="accordionComplementos-{{ $index }}"
                                                                class="accordion-collapse collapse">
                                                                <div class="accordion-body">
                                                                    @foreach ($equipo->complements as $complemento)
                                                                        <span class="h6 me-1"> TYPE </span>:
                                                                        {{ $complemento->type->name }} <br>
                                                                        <span class="h6 me-1"> BRAND </span>:
                                                                        {{ $complemento->brand }} <br>
                                                                        <span class="h6 me-1"> MODEL </span>:
                                                                        {{ $complemento->model }} <br>
                                                                        <span class="h6 me-1"> SERIAL NUMBER </span>:
                                                                        {{ $complemento->serial }} <br>
                                                                        <hr>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No equipment(s) with complements assigned.</p>
                                                @endif
                                            @else
                                                <p>No equipment(s) assigned.<a href="{{ route('equipo.index') }}"> Add
                                                        equipment(s) -></a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Licenses -->
                                    <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                                        <div id="accordionLicenses" class="accordion">
                                            @if ($empleado->equipos->isNotEmpty())

                                                @if ($equipo->license->isNotEmpty())
                                                    @foreach ($empleado->equipos as $index => $equipo)
                                                        <div class="card accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    data-bs-target="#accordionLicenses-{{ $index }}"
                                                                    aria-controls="accordionLicenses-{{ $index }}">
                                                                    {{ $equipo->tipo->name }}
                                                                    @if (!empty($equipo->name))
                                                                        <span> - {{ $equipo->name }} </span>
                                                                    @endif
                                                                </button>
                                                            </h2>

                                                            <div id="accordionLicenses-{{ $index }}"
                                                                class="accordion-collapse collapse">
                                                                <div class="accordion-body">
                                                                    @foreach ($equipo->license as $licencia)
                                                                        @php
                                                                            $statusClass = [
                                                                                'Active' => 'badge bg-label-success',
                                                                                'Near expiration' =>
                                                                                    'badge bg-label-warning',
                                                                                'Expired' => 'badge bg-label-danger',
                                                                            ][$licencia->getStatus()];
                                                                        @endphp
                                                                        <div class="mb-3">
                                                                            <strong>APPLICATION:</strong>
                                                                            {{ $licencia->type }} <br>
                                                                            <strong>EMAIL/KEY:</strong>
                                                                            {{ $licencia->key }} <br>
                                                                            <strong>END DATE:</strong>
                                                                            {{ $licencia->end_date ?? 'N/A' }} <br>
                                                                            <span class="{{ $statusClass }}">
                                                                                {{ $licencia->getStatus() }}
                                                                            </span>
                                                                        </div>
                                                                        <hr>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No licenses assigned.</p>
                                                @endif
                                            @else
                                                <p>No equipment(s) assigned.<a href="{{ route('equipo.index') }}"> Add
                                                        equipment(s) -></a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->

                <div class="content-backdrop fade"></div>
            </div>

            <a href="{{ route('assignment.index') }}" class="btn btn-secondary"><i
                    class='bx bx-arrow-back'></i>RETURN</a>
            <hr class="my-5" />
        </div>
    </div>
</x-app-layout>
