<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ route('roles.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                    title="Regresar">
                    <span>
                        <i class='bx bx-arrow-back'></i>
                    </span>
                </a>
                / Roles /</span> Editar 
            </h4>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Editar Registro</h5>
                </div>
                <div class="table-responsive text-nowrap">
                    <div class="card-body">

                        <form method="post" action="{{ route('roles.update', $role->id) }}">
                            @csrf
                            @method('patch')

                            <!-- Name -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="name" :value="__('Name')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input id="name" class="form-control" type="text" name="name"
                                        value="{{ $role->name }}" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <h2 class="h3">Lista de Permisos</h2>

                            @foreach ($permissions as $permission)
                                <div>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                        {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                    <label>{{ $permission->description }}</label>
                                </div>
                            @endforeach

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
