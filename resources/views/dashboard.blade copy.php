<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <div class="container">
                        <h1>Mi página</h1>
                
                        <button onclick="mostrarToastr()">Mostrar Toastr</button>
                    </div>
                
                    <script>
                        function mostrarToastr() {
                            toastr.success('Este es un mensaje de éxito.', 'Éxito');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
