<x-app-layout>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        CCTV
                    </li>
                    <li class="breadcrumb-item active fw-bold">ORGANIGRAMA</li>
                </ol>
            </nav>
            <div class="card">

                <div class="mermaid">
                    graph TD;
                    %% Leyenda

                    subgraph Leyenda [🗂️ Leyenda de colores]
                    principal["🟩 SW Principal"]:::principal
                    secundario["🟦 SW Secundario"]:::secundario
                    idf["🟪 SW IDF"]:::idf
                    camara["🟨 Cámara CCTV"]:::camara
                    end

                    @include('cctv.partials.mermaid-tree', ['switch' => $principal])


                    %% Estilos minimalistas
                    classDef principal fill:#d0e6d5,stroke:#4CAF50,stroke-width:1px,color:#2E8B57,font-size:11px;
                    classDef secundario fill:#d6e4f0,stroke:#4682B4,stroke-width:1px,color:#1E4E8C,font-size:11px;
                    classDef idf fill:#e0d9f5,stroke:#6A5ACD,stroke-width:1px,color:#4B3C9E,font-size:11px;
                    classDef camara fill:#fff8dc,stroke:#FFD700,stroke-width:1px,color:#8B8000,font-size:10px;
                </div>

                <script type="module">
                    import mermaid from 'https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.esm.min.mjs';
                    mermaid.initialize({
                        startOnLoad: true
                    });
                </script>

            </div>
        </div>
    </div>
</x-app-layout>
