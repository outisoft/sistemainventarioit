<x-app-layout>
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Cuenta /</span> Configuracion </h4>

        <!-- Basic Cards -->       

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
        
                <br>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <br>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>    
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

        <hr class="my-5" />

      </div>
      <!-- / Content -->
</x-app-layout>
