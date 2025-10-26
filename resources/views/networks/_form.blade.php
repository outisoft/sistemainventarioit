<div class="modal-body">
    @role('Administrator')
        <div class="mb-3">
            <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
            <select class="form-control" id="region_id" name="region_id" required>
                <option value="">Choose a region</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}"
                        {{ (string) old('region_id', $network->region_id ?? '') === (string) $region->id ? 'selected' : '' }}>
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
                        <option value="{{ $region->id }}"
                            {{ (string) old('region_id', $network->region_id ?? '') === (string) $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @else
            <!-- Si el usuario tiene solo una región, usa la del modelo si existe o la única disponible -->
            <input type="hidden" name="region_id" value="{{ old('region_id', $network->region_id ?? $userRegions->first()->id) }}">
        @endif
    @endrole


    <!-- Name -->
    <div class="mb-3">
        <x-input-label class="form-label" for="name" :value="__('Nombre de la red')" />
        <div class="input-group input-group-merge">
            <x-text-input id="name" class="form-control" type="text" name="name"
                placeholder="Datos, Clientes, CCTV..." :value="old('name', $network->name ?? '')" required
                autocomplete="name" />
        </div>
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- vlan_id -->
    <div class="mb-3">
        <x-input-label class="form-label" for="vlan_id" :value="__('VLAN ID')" />
        <div class="input-group input-group-merge">
            <x-text-input id="vlan_id" class="form-control" type="text" name="vlan_id"
                placeholder="9, 10, 11..." :value="old('vlan_id', $network->vlan_id ?? '')" required
                autocomplete="vlan_id" />
        </div>
        <x-input-error :messages="$errors->get('vlan_id')" class="mt-2" />
    </div>
</div>