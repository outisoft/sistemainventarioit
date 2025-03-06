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

            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-6">
                        <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">
                            <div class="flex-grow-1 mt-3 mt-lg-5">
                                <div
                                    class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4 class="mb-2 mt-lg-7">{{ $empleado->name }}</h4> <span> ( {{ $empleado->ad }}
                                            )
                                        </span>
                                        <ul
                                            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                            <li class="list-inline-item">
                                                <i class='icon-base bx bx-hash me-2 align-top'></i><span
                                                    class="fw-medium">{{ $empleado->no_empleado }}</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class='icon-base bx bx-mail-send me-2 align-top'></i>
                                                <span class="fw-medium"> {{ $empleado->email }} </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="icon-base bx bx-buildings me-2 align-top"></i>
                                                <span class="fw-medium"> {{ $empleado->hotel->name }} /
                                                    {{ $empleado->departments->name }}
                                                    / {{ $empleado->puesto }} </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="nav-item d-flex align-items-center">
                                        <a href="{{ route('generateQRCode', $empleado->id) }}" target="_blank"
                                            class="btn-ico" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="top" data-bs-html="true" title=""
                                            data-bs-original-title="<span>QR Code</span>">
                                            <i class='bx bx-qr-scan icon-lg'></i>
                                        </a>
                                        <a href="#" class="btn-ico" data-bs-toggle="modal"
                                            data-bs-target="#equiposModal" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="top" data-bs-html="true" title=""
                                            data-bs-original-title="<span>Responsive sheet</span>">
                                            <i class='bx bxs-file-pdf icon-lg'></i>
                                        </a>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Header -->
            <br>
            <br>

            <div class="row mt-6">
                <!-- Navigation -->
                <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-4">
                    <div class="d-flex justify-content-between flex-column nav-align-left mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#payment"
                                    aria-selected="true" role="tab">
                                    <i class="icon-base bx bx-desktop faq-nav-icon me-1_5"></i>
                                    <span class="align-middle">Equipments</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#delivery"
                                    aria-selected="false" role="tab" tabindex="-1">
                                    <i class="icon-base bx bxs-keyboard faq-nav-icon me-1_5"></i>
                                    <span class="align-middle">Complements</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cancellation"
                                    aria-selected="false" role="tab" tabindex="-1">
                                    <i class="icon-base bx bxl-adobe faq-nav-icon me-1_5"></i>
                                    <span class="align-middle">Licenses</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Navigation -->

                <!-- FAQ's -->
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="tab-content p-0">

                        <!-- Equipments -->
                        <div class="tab-pane fade active show" id="payment" role="tabpanel">
                            <div class="d-flex mb-4 gap-4 align-items-center">
                                <div>
                                    <span class="badge bg-label-primary rounded w-px-50 py-2">
                                        <i class="icon-base bx bx-desktop icon-26px mt-50"></i>
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-0">
                                        <span class="align-middle">Equipments</span>
                                    </h5>
                                    <span>Get information about the equipment</span>
                                </div>
                            </div>
                            <div id="accordionPayment" class="accordion">
                                @if ($empleado->equipos->isNotEmpty())
                                    @foreach ($empleado->equipos as $equipo)
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" aria-expanded="true"
                                                    data-bs-target="#accordionPayment-1"
                                                    aria-controls="accordionPayment-1">
                                                    {{ $equipo->tipo->name }}
                                                    <span> - {{ $equipo->name }} </span>
                                                </button>
                                            </h2>

                                            <div id="accordionPayment-1" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    BRAND: {{ $equipo->marca }} <br>
                                                    MODEL: {{ $equipo->model }} <br>
                                                    SERIAL NUMBER: {{ $equipo->serial }} <br>
                                                    IP: {{ $equipo->ip }} <br>
                                                    SO: {{ $equipo->so }} <br>

                                                    <a href="{{ route('desvincular', ['empleado_id' => $empleado->id, 'equipo_id' => $equipo->id]) }}"
                                                        data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                        data-bs-placement="top" data-bs-html="true" title=""
                                                        data-bs-original-title="<span>Unlink employee equipment</span>"
                                                        class="btn btn-danger btn-sm"><i class='bx bx-trash'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Complements -->
                        <div class="tab-pane fade" id="delivery" role="tabpanel">
                            <div class="d-flex mb-4 gap-4">
                                <div>
                                    <span class="badge bg-label-primary rounded w-px-50 py-2">
                                        <i class="icon-base bx bxs-keyboard icon-26px mt-50"></i>
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-0">
                                        <span class="align-middle">Complements</span>
                                    </h5>
                                    <span>Get information about plugins</span>
                                </div>
                            </div>
                            <div id="accordionDelivery" class="accordion">
                                @if ($equipo->complements->isNotEmpty())
                                    @foreach ($equipo->complements as $complemento)
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" aria-expanded="true"
                                                    data-bs-target="#accordionDelivery-1"
                                                    aria-controls="accordionDelivery-1">
                                                    {{ $complemento->type->name }} -
                                                    {{ $complemento->serial }}
                                                </button>
                                            </h2>

                                            <div id="accordionDelivery-1" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    BRAND: {{ $complemento->brand }}<br>

                                                    MODEL: {{ $complemento->model }} <br>

                                                    SERIAL: {{ $complemento->serial }}

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No complement(s) assigned.<a href="{{ route('complements.index') }}"> Add
                                            complement(s) -></a>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Licenses -->
                        <div class="tab-pane fade" id="cancellation" role="tabpanel">
                            <div class="d-flex mb-4 gap-4">
                                <div>
                                    <span class="badge bg-label-primary rounded w-px-50 py-2">
                                        <i class="icon-base bx bxl-adobe icon-26px mt-50"></i>
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-0"><span class="align-middle">Licenses</span>
                                    </h5>
                                    <span>Get information about licenses</span>
                                </div>
                            </div>
                            <div id="accordionCancellation" class="accordion">
                                @if ($equipo->license->isEmpty())
                                    <p class="card-body">No licenses assigned.</p>
                                @else
                                    @foreach ($equipo->license as $licencia)
                                        @php
                                            $statusClass = [
                                                'Active' => 'badge bg-label-success',
                                                'Near expiration' => 'badge bg-label-warning',
                                                'Expired' => 'badge bg-label-danger',
                                            ][$licencia->getStatus()];
                                        @endphp
                                        <div class="card accordion-item active">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" aria-expanded="true"
                                                    data-bs-target="#accordionCancellation-1"
                                                    aria-controls="accordionCancellation-1">
                                                    {{ $licencia->type }}
                                                    <span class="{{ $statusClass }}"> {{ $licencia->getStatus() }}
                                                    </span>
                                                </button>
                                            </h2>

                                            <div id="accordionCancellation-1" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    <p>
                                                        <strong>APLICATION:</strong> {{ $licencia->type }} <br>
                                                        <strong>EMAIL/KEY:</strong> {{ $licencia->key }} <br>
                                                        <strong>END DATE:</strong> {{ $licencia->end_date ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /FAQ's -->
            </div>
            <br>

            <a href="{{ route('assignment.index') }}" class="btn btn-secondary"><i
                    class='bx bx-arrow-back'></i>RETURN</a>
            <hr class="my-5" />
        </div>
    </div>
</x-app-layout>
