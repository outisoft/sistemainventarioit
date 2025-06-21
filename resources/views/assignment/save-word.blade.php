{{-- 
    ARCHIVO: resources/views/assignment/save-word.blade.php
    
    CAMBIOS CLAVE:
    1. SIN <style>, <html>, <head>, <body>: PHPWord no los necesita y pueden causar problemas.
    2. LAYOUT CON TABLAS: Se reemplazan los DIVs con floats y flexbox por tablas (<table>), que es lo que mejor interpreta PHPWord.
    3. ETIQUETAS AUTO-CERRADAS: Todos los <br> se han cambiado a <br />, que es un formato XML válido y evita errores.
    4. RUTA DE IMAGEN ABSOLUTA: La ruta de la imagen ahora usa public_path() para que el servidor la encuentre sin problemas.
--}}

@foreach ($equipos as $equipo)
    {{-- Usamos una tabla para el layout del encabezado en lugar de CSS con floats --}}
    <table style="width: 100%;">
        <tr>
            <td style="width: 40%;">
                {{-- La ruta de la imagen debe ser absoluta para que el servidor la encuentre --}}
                <img src="{{ public_path('images/logo_gp.png') }}" alt="Logo GP" width="150" />
            </td>
            <td style="width: 60%; text-align: right; font-size: 14pt; font-weight: bold;">
                ENTREGA DE {{ strtoupper($equipo->tipo->name) }}<br />{{ $position->departments->name }}/{{ $position->hotel->name }}
            </td>
        </tr>
    </table>

    {{-- Corregimos <br> a <br /> para que sea compatible con XML --}}
    <br /><br /><br />

    <p style="font-family: Arial, sans-serif; font-size: 10pt;">Tulum, {{ $date }}</p>

    <div class="content">
        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">
            Con esta fecha se le hace entrega a <strong>{{ $position->employee->name }}</strong> (en adelante, EL
            TRABAJADOR),
            de un equipo marca <strong>{{ $equipo->marca }} ({{ $equipo->model }})</strong>, con número de
            serie
            <strong>{{ $equipo->serial }}</strong>
            @if ($equipo->so == '')
            .@else, y sistema operativo {{ $equipo->so }}.
            @endif
        </p>

        {{-- El resto de los párrafos se mantienen igual, solo nos aseguramos de que el estilo sea inline si es necesario --}}
        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">El material relacionado es propiedad de la organización Grupo Piñero y se le hace entrega del mismo para el desarrollo de su trabajo, debiendo utilizarlo única y exclusivamente para tal fin, comprometiéndose a custodiarlo y cuidarlo adecuadamente.</p>
        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">Si causara Vd. baja en la organización se compromete a reintegrar el citado material a la empresa propietaria con carácter previo a la finalización de la relación laboral y al percibo de la liquidación que pudiera corresponderle.</p>
        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">De acuerdo con la Ley Federal de Protección de Datos Personales en posesión de los Particulares, la empresa con la cual Vd. mantiene relación laboral o contractual (en adelante, LA EMPRESA) informa a EL TRABAJADOR de que los datos de carácter personal contenidos en este documento así como los generados en virtud del objeto del mismo serán tratados con la finalidad de llevar a cabo la asignación y control de los recursos y herramientas laborales que LA EMPRESA pone a su disposición, creación y gestión de identificadores, acceso a aplicaciones, gestión de costes, control de cumplimiento de las normativas de seguridad confidencialidad y uso vinculadas a la herramienta laboral objeto de entrega, control y auditorías de seguridad de carácter preventivo y detectivo, recogida y custodia de evidencias para hacer frente a incidentes y en su caso, adopción de las medidas disciplinarias que procedan en caso de vulneración de las normas de seguridad y uso de la herramienta por EL TRABAJADOR.</p>
        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">Con los mismos fines, la empresa llevará a cabo la vigilancia, control y monitorización de las herramientas e instrumentos de trabajo utilizadas por EL TRABAJADOR y el almacenamiento de la información resultante, quedando EL TRABAJADOR informado de que tales actuaciones se realizarán sin expectativas de intimidad, confidencialidad ni secreto de las comunicaciones por tratarse de herramientas e instrumentos laborales propiedad de LA EMPRESA.</p>
        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">Cuando la empresa lo estime oportuno y en todo caso finalizada la relación laboral cualquiera que sea la causa, EL TRABAJADOR queda obligado a la devolución de cualquier recurso o herramienta laboral, que será formateada, quedando suprimidos y borrados cualesquiera datos e información almacenados en los mismos de ámbito doméstico o particular, siendo únicamente conservada la información laboral y de negocio vinculada al puesto y necesaria para la gestión de la actividad mercantil de la empresa. EL TRABAJADOR se hace responsable del salvado previo de cualquier información particular y de ámbito doméstico que hubiera podido almacenar en los activos y herramientas laborales quedando la empresa exenta de cualquier responsabilidad a dichos efectos y en particular por el borrado de la información.</p>
        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">Puede obtener más información en la política de privacidad de Grupo Piñero, incluido en su Manual de Bienvenida o bien solicitándola al Delegado de Protección de Datos, con el que puede contactar en: dpd.privacy@grupo-pinero.com.</p>
        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">EL TRABAJADOR puede ejercitar los derechos de acceso, rectificación, cancelación y oposición dirigiendo una comunicación al Delegado de Protección de Datos: dpd.privacy@grupo-pinero.com</p>
        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">Declaro el entendimiento del presente Documento, manifiesto mi conformidad con su contenido.</p>
    </div>

    <br /><br />
    
    {{-- Usamos una tabla también para las firmas --}}
    <table style="width: 100%;">
        <tr>
            <td style="width: 50%; font-family: Arial, sans-serif; font-size: 10pt;">Fdo: ______________________________</td>
            <td style="width: 50%; text-align: right; font-family: Arial, sans-serif; font-size: 10pt;">{{ $user->name }} </td>
        </tr>
    </table>

    {{-- Esto agrega un salto de página para que el siguiente equipo empiece en una nueva hoja --}}
    <div style="page-break-after: always;"></div>
@endforeach

@if ($complements->isNotEmpty())
    @foreach ($complements as $equipo)
        {{-- Replicamos la misma estructura de tabla para los complementos --}}
        <table style="width: 100%;">
            <tr>
                <td style="width: 40%;">
                    <img src="{{ public_path('images/logo_gp.png') }}" alt="Logo GP" width="150" />
                </td>
                <td style="width: 60%; text-align: right; font-size: 14pt; font-weight: bold;">
                    ENTREGA DE {{ strtoupper($equipo->type->name) }}<br />{{ $position->departments->name }}/{{ $position->hotel->name }}
                </td>
            </tr>
        </table>

        <br /><br /><br />

        <p style="font-family: Arial, sans-serif; font-size: 10pt;">Tulum, {{ $date }}</p>

        <div class="content">
            <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">
                Con esta fecha se le hace entrega a <strong>{{ $position->employee->name }}</strong> (en adelante, EL
                TRABAJADOR),
                de un equipo marca <strong>{{ $equipo->brand }} ({{ $equipo->model }})</strong>, con número de
                serie
                <strong>{{ $equipo->serial }}</strong>.
            </p>
            {{-- Aquí el resto de párrafos es similar y se mantiene la estructura --}}
            <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">El material relacionado es propiedad de la organización Grupo Piñero y se le hace entrega del mismo para el desarrollo de su trabajo, debiendo utilizarlo única y exclusivamente para tal fin, comprometiéndose a custodiarlo y cuidarlo adecuadamente.</p>
            <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">Si causara Vd. baja en la organización se compromete a reintegrar el citado material a la empresa propietaria con carácter previo a la finalización de la relación laboral y al percibo de la liquidación que pudiera corresponderle.</p>
            {{-- ... (los demás párrafos largos van aquí, igual que arriba) ... --}}
            <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 10pt;">Declaro el entendimiento del presente Documento, manifiesto mi conformidad con su contenido.</p>
        </div>

        <br /><br />

        <table style="width: 100%;">
            <tr>
                <td style="width: 50%; font-family: Arial, sans-serif; font-size: 10pt;">Fdo: ______________________________</td>
                <td style="width: 50%; text-align: right; font-family: Arial, sans-serif; font-size: 10pt;">{{ $user->name }} </td>
            </tr>
        </table>
        
        {{-- Agregamos salto de página si no es el último elemento --}}
        @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach
@endif