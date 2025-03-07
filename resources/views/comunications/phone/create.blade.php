<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{ route('phones.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">New Phone</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    @role('Administrator')
                        <div class="mb-3">
                            <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                            <select class="form-control" id="region_id" name="region_id" required>
                                <option value="">Choose a region</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                        </div>
                    @else
                        @if ($userRegions->count() > 1)
                            <!-- Si el usuario tiene múltiples regiones, muestra un campo de selección -->
                            <div class="mb-3">

                                <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                <select name="region_id" id="region_id" class="form-control" required>
                                    @foreach ($userRegions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <!-- Si el usuario tiene solo una región, asigna automáticamente esa región -->
                            <input type="hidden" name="region_id" value="{{ $userRegions->first()->id }}">
                        @endif
                    @endrole

                    <!-- Extension -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="extension" :value="__('Extension')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="extension" class="form-control" type="text" name="extension"
                                placeholder="28028" :value="old('extension')" required autocomplete="extension" />
                        </div>
                        <x-input-error :messages="$errors->get('extension')" class="mt-2" />
                    </div>

                    <!-- Service -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="service" :value="__('Service')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="service" class="form-control" type="text" name="service"
                                placeholder="MITEL" :value="old('service')" required autocomplete="service" />
                        </div>
                        <x-input-error :messages="$errors->get('service')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="model" :value="__('Model')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="model" class="form-control" type="text" name="model"
                                placeholder="5312 IP Phone" :value="old('model')" required autocomplete="model" />
                        </div>
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Serial -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="serial" :value="__('Serial Number')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="serial" class="form-control" type="text" name="serial"
                                placeholder="R52BJ98SUY" :value="old('serial')" required autocomplete="serial" />
                        </div>
                        <x-input-error :messages="$errors->get('serial')" class="mt-2" />
                    </div>

                    <!-- Hotel -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="hotel_id" :value="__('Hotel')" />
                        <select class="form-control" id="hotel_id_create" name="hotel_id" required>
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Villa -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="villa_id" :value="__('Villa')" />
                        <select class="form-control" id="villa_id_create" name="villa_id" required>
                            <option value="">Seleccione una villa</option>
                        </select>
                    </div>

                    <!-- Room -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="room_id" :value="__('Rooms')" />
                        <select class="form-control" id="room_id_create" name="room_id" required>
                            <option value="">Seleccione una villa</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Cargar villas al cambiar el hotel en el modal de creación
        $('#hotel_id_create').change(function() {
            var hotelId = $(this).val();
            if (hotelId) {
                $.ajax({
                    url: "{{ route('getVillas') }}",
                    type: "GET",
                    data: {
                        hotel_id: hotelId
                    },
                    success: function(data) {
                        $('#villa_id_create').empty();
                        $('#villa_id_create').append(
                            '<option value="">Seleccione una villa</option>');
                        $.each(data, function(key, value) {
                            $('#villa_id_create').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al cargar villas:", error);
                    }
                });
            } else {
                $('#villa_id_create').empty();
                $('#room_id_create').empty();
            }
        });

        // Cargar habitaciones al cambiar la villa en el modal de creación
        $('#villa_id_create').change(function() {
            var villaId = $(this).val();
            if (villaId) {
                $.ajax({
                    url: "{{ route('getRooms') }}",
                    type: "GET",
                    data: {
                        villa_id: villaId
                    },
                    success: function(data) {
                        $('#room_id_create').empty();
                        $('#room_id_create').append(
                            '<option value="">Seleccione una habitación</option>');
                        $.each(data, function(key, value) {
                            $('#room_id_create').append('<option value="' + value
                                .id + '">' + value.number + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al cargar habitaciones:", error);
                    }
                });
            } else {
                $('#room_id_create').empty();
            }
        });
    });
</script>
