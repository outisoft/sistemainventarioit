<!-- Name -->
<div class="mb-3">
    <x-input-label class="form-label" for="name" :value="__('Name')" />
    <div class="input-group input-group-merge">
        <x-text-input id="name" class="form-control" type="text" name="name" placeholder="Ingrese el nombre del rol" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
</div>

<h2 class="h3">Lista de Permisos</h2>

<label>Permisos:</label>
    @foreach($permissions as $permission)
        <div>
            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
            <label>{{ $permission->description }}</label>
        </div>
    @endforeach