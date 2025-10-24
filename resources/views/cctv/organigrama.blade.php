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
            <div class="card" id="myDiagramContainer" style="width:100%; min-height:670px; overflow:auto;">
                @php
                    $hasRecords = !empty($equipos) && count((array) $equipos) > 0;
                @endphp

                @if($hasRecords)
                    <div style="margin-bottom: 1rem;">
                        <button class="btn btn-primary" onclick="downloadDiagram()">📥 Imagen</button>
                        <button class="btn btn-secondary" onclick="downloadPDF()">📄 PDF</button>
                    </div>

                    <div id="infoCard"
                        style="display:none; position:absolute; top:20px; right:20px; background:#fff; border:1px solid #ccc; padding:10px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); z-index:1000;">
                        <strong id="cardTitle">Equipo</strong>
                        <p id="cardDetails">Detalles aquí...</p>
                        <button onclick="document.getElementById('infoCard').style.display='none'">Cerrar</button>
                    </div>

                    <div class="mermaid" id="mermaid-diagram">
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

                    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

                    <script type="module">
                        import mermaid from 'https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.esm.min.mjs';
                        mermaid.initialize({
                            startOnLoad: true
                        });

                        const equipos = @json($equipos);

                        setTimeout(() => {
                            document.querySelectorAll('.node').forEach(node => {
                                node.addEventListener('click', () => {
                                    const id = node.id;
                                    const equipo = equipos[id];

                                    if (equipo) {
                                        document.getElementById('cardTitle').textContent = equipo.nombre;
                                        document.getElementById('cardDetails').innerHTML = `
                                            <strong>Tipo:</strong> ${equipo.tipo}<br>
                                            <strong>IP:</strong> ${equipo.ip}<br>
                                            <strong>Marca:</strong> ${equipo.marca}<br>
                                            <strong>Modelo:</strong> ${equipo.modelo}<br>
                                            ${equipo.puertos ? `<strong>Puertos:</strong> ${equipo.puertos}<br>` : ''}
                                            ${equipo.puerto ? `<strong>Puerto conectado:</strong> ${equipo.puerto}<br>` : ''}
                                        `;
                                        document.getElementById('infoCard').style.display = 'block';
                                    }
                                });
                            });
                        }, 1000);

                        window.downloadDiagram = function() {
                            html2canvas(document.querySelector('.mermaid')).then(canvas => {
                                const link = document.createElement('a');
                                link.download = 'organigrama_cctv.png';
                                link.href = canvas.toDataURL();
                                link.click();
                            });
                        }

                        window.downloadPDF = async function() {
                            const { jsPDF } = window.jspdf;
                            const canvas = await html2canvas(document.querySelector('.mermaid'));
                            const imgData = canvas.toDataURL('image/png');
                            const pdf = new jsPDF({ orientation: 'landscape', unit: 'px', format: [canvas.width, canvas.height] });
                            pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
                            pdf.save('organigrama_cctv.pdf');
                        }
                    </script>
                @else
                    <div class="p-5 text-center">
                        <i class="bx bx-info-circle mb-2" style="font-size:3rem; opacity:.35;"></i>
                        <h5 class="fw-light mb-1">No existe ningún registro</h5>
                        <p class="text-muted small mb-0">Aún no hay equipos para mostrar en el organigrama.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
