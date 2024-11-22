<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nuevo Hotel</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"></span></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('hotels.store') }}">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Nombre de Hotel o empresa')" />
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-building-house'></i>
                            </span>
                            <x-text-input id="name" class="form-control" type="text"
                                name="name" placeholder="Akumal, Coba, Sian Ka'an, Tulum..." :value="old('name')" required
                                autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Tipo -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="type" :value="__('Tipo de hotel o empresa')" />
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-building-house'></i>
                            </span>
                            <x-text-input id="type" class="form-control" type="text"
                                name="type" placeholder="Luxury, Grand, sister company..." :value="old('type')" required
                                autocomplete="type" />
                        </div>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <!-- Region -->
                    <div class="mt-4">
                        <x-input-label class="form-label" for="region_id" :value="__('Region')" />

                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-map-pin'></i>
                            </span>
                            <select name="region_id" class="form-control" id="region_id"
                                aria-label="Default select example">
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
