<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoja de resguardo</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://bsuite.grupo-pinero.com/bsuite/favicon.ico">
    <style>
        body{
            margin: 10px;
        }
        p{
            text-align: justify;
            font-family: "Calibri", sans-serif;
            font-size: 10pt;
            margin-right: 10px;
        }
        h2{
            text-align: center;
            font-family: "Arial", sans-serif;
            font-size: 14pt;
        }
        .izquierda {
            float: left;
            width: 40%;
            /* Otros estilos según tus necesidades */
        }

        .derecha {
            float: left;
            width: 60%;
            /* Otros estilos según tus necesidades */
        }
    </style>
</head>
<body>
@foreach ($empleado->equipos as $equipo)

    @if ( $empleado->hotel->name == 'TULUM COUNTRY CLUB')
        <div class="izquierda">
            <!-- Aquí coloca tu imagen o logo -->
            <img src="../public/images/Logo_TCC.png" alt="Logo GP" width="206.7" height="87.3" />
        </div>
    @else
        <div class="izquierda">
            <!-- Aquí coloca tu imagen o logo -->
            <img src="../public/images/logo_gp.png" alt="Logo GP" width="206.7" height="81.3" />
        </div>
    @endif

    <div class="derecha">
        <!-- Aquí coloca tu texto en negritas -->
        <h2><strong>ENTREGA DE {{ $equipo->tipo->name }}</strong></h2>
        <h2>{{ $empleado->departamento->name }}-{{ $empleado->hotel->name}} </h2>
    </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>Tulum, {{ $date }}</p>

        <br>
        
        <p>Con esta fecha se le hace entrega a <strong>{{ $empleado->name }}</strong> (en adelante, EL TRABAJADOR), de un ordenador portatil marca <strong>{{ $equipo->marca }} - {{ $equipo->model }}</strong>, con número de serie 
            <strong>{{ $equipo->serial}}</strong>@if ($equipo->so == '').@else, sistema operativo {{ $equipo->so }}.@endif
        </p>
    
    <p>El material relacionado es propiedad de la organización Grupo Piñero y se le hace entrega del mismo para el desarrollo de su trabajo, debiendo utilizarlo única y exclusivamente para tal fin, comprometiéndose a custodiarlo y cuidarlo adecuadamente.</p>
    <p>Si causara Vd. baja en la organización se compromete a reintegrar el citado material a la empresa propietaria con carácter previo a la finalización de la relación laboral y al percibo de la liquidación que pudiera corresponderle.</p>
    <p>De acuerdo con la Ley Federal de Protección de Datos Personales en posesión de los Particulares, la empresa con la cual Vd. mantiene relación laboral o contractual (en adelante, LA EMPRESA) informa a EL TRABAJADOR de que los datos de carácter personal contenidos en este documento así como los generados en virtud del objeto del mismo serán tratados con la finalidad de llevar a cabo la asignación y control de los recursos y herramientas laborales que LA EMPRESA pone a su disposición, creación y gestión de identificadores, acceso a aplicaciones, gestión de costes, control de cumplimiento de las normativas de seguridad confidencialidad y uso vinculadas a la herramienta laboral objeto de entrega, control y auditorías de seguridad de carácter preventivo y detectivo, recogida y custodia de evidencias para hacer frente a incidentes y en su caso, adopción de las medidas disciplinarias que procedan en caso de vulneración de las normas de seguridad y uso de la herramienta por EL TRABAJADOR.</p>
    <p>Con los mismos fines, la empresa llevará a cabo la vigilancia, control y monitorización de las herramientas e instrumentos de trabajo utilizadas por EL TRABAJADOR y el almacenamiento de la información resultante, quedando EL TRABAJADOR informado de que tales actuaciones se realizarán sin expectativas de intimidad, confidencialidad ni secreto de las comunicaciones por tratarse de herramientas e instrumentos laborales propiedad de LA EMPRESA.</p>
    <p>Cuando la empresa lo estime oportuno y en todo caso finalizada la relación laboral cualquiera que sea la causa, EL TRABAJADOR queda obligado a la devolución de cualquier recurso o herramienta laboral, que será formateada, quedando suprimidos y borrados cualesquiera datos e información almacenados en los mismos de ámbito doméstico o particular, siendo únicamente conservada la información laboral y de negocio vinculada al puesto y necesaria para la gestión de la actividad mercantil de la empresa. EL TRABAJADOR se hace responsable del salvado previo de cualquier información particular y de ámbito doméstico que hubiera podido almacenar en los activos y herramientas laborales quedando la empresa exenta de cualquier responsabilidad a dichos efectos y en particular por el borrado de la información.</p>
    <p>Puede obtener más información en la política de privacidad de Grupo Piñero, incluido en su Manual de Bienvenida o bien solicitándola al Delegado de Protección de Datos, con el que puede contactar en: dpd.privacy@grupo-pinero.com.</p>
    <p>EL TRABAJADOR puede ejercitar los derechos de acceso, rectificación, cancelación y oposición dirigiendo una comunicación al Delegado de Protección de Datos: dpd.privacy@grupo-pinero.com</p>
    <p>Declaro el entendimiento del presente Documento, manifiesto mi conformidad con su contenido.</p>
    <br>
    <p><strong> Fdo.: __________________________________________</strong></p>
    <br>
    <br>
    @endforeach
</body>

</html>

