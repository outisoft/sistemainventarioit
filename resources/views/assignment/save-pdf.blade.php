<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoja de resguardo</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://bsuite.grupo-pinero.com/bsuite/favicon.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 150px;
            height: auto;
            float: left;
            width: 40%;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            float: left;
            width: 60%;
        }

        .date {
            margin-bottom: 20px;
        }

        .content {
            text-align: justify;
        }

        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .signature-line {
            border-top: 1px solid black;
            width: 200px;
            margin-top: 40px;
        }

        p {
            text-align: justify;
            font-family: "Calibri", sans-serif;
            font-size: 10pt;
            margin-right: 10px;
        }

        .izq {
            width: 150px;
            height: auto;
            float: left;
            width: 40%;
        }

        .der {
            font-size: 14px;
            text-align: right;
            float: left;
            width: 55%;
        }

        .firma {
            width: 45%;
        }

        .linea-firma {
            border-bottom: 1px solid #000;
            height: 40px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    @foreach ($empleado->equipos as $equipo)
        <div class="header">
            @if ($empleado->hotel->name == 'TULUM COUNTRY CLUB')
                <img src="../public/images/Logo_TCC.png" alt="Tulum Country Club Logo" class="logo" />
            @else
                <img src="../public/images/logo_gp.png" alt="Logo GP" class="logo" />
            @endif
            <div class="title">ENTREGA DE
                {{ $equipo->tipo->name }}<br>{{ $empleado->departments->name }}/{{ $empleado->hotel->name }}</div>
        </div>
        <br><br>
        <br>
        <br>
        <br>

        <p class="date">Tulum, {{ $date }}</p>

        <div class="content">
            <p>Con esta fecha se le hace entrega a <strong>{{ $empleado->name }}</strong> (en adelante, EL TRABAJADOR),
                de un equipo marca <strong>{{ $equipo->marca }} ({{ $equipo->model }})</strong>, con número de serie
                <strong>{{ $equipo->serial }}</strong>
                @if ($equipo->so == '')
                .@else, y sistema operativo {{ $equipo->so }}.
                @endif
            </p>

            <p>El material relacionado es propiedad de la organización Grupo Piñero y se le hace entrega del mismo para
                el desarrollo de su trabajo, debiendo utilizarlo única y exclusivamente para tal fin, comprometiéndose a
                custodiarlo y cuidarlo adecuadamente.</p>
            <p>Si causara Vd. baja en la organización se compromete a reintegrar el citado material a la empresa
                propietaria con carácter previo a la finalización de la relación laboral y al percibo de la liquidación
                que pudiera corresponderle.</p>
            <p>De acuerdo con la Ley Federal de Protección de Datos Personales en posesión de los Particulares, la
                empresa con la cual Vd. mantiene relación laboral o contractual (en adelante, LA EMPRESA) informa a EL
                TRABAJADOR de que los datos de carácter personal contenidos en este documento así como los generados en
                virtud del objeto del mismo serán tratados con la finalidad de llevar a cabo la asignación y control de
                los recursos y herramientas laborales que LA EMPRESA pone a su disposición, creación y gestión de
                identificadores, acceso a aplicaciones, gestión de costes, control de cumplimiento de las normativas de
                seguridad confidencialidad y uso vinculadas a la herramienta laboral objeto de entrega, control y
                auditorías de seguridad de carácter preventivo y detectivo, recogida y custodia de evidencias para hacer
                frente a incidentes y en su caso, adopción de las medidas disciplinarias que procedan en caso de
                vulneración de las normas de seguridad y uso de la herramienta por EL TRABAJADOR.</p>
            <p>Con los mismos fines, la empresa llevará a cabo la vigilancia, control y monitorización de las
                herramientas e instrumentos de trabajo utilizadas por EL TRABAJADOR y el almacenamiento de la
                información resultante, quedando EL TRABAJADOR informado de que tales actuaciones se realizarán sin
                expectativas de intimidad, confidencialidad ni secreto de las comunicaciones por tratarse de
                herramientas e instrumentos laborales propiedad de LA EMPRESA.</p>
            <p>Cuando la empresa lo estime oportuno y en todo caso finalizada la relación laboral cualquiera que sea la
                causa, EL TRABAJADOR queda obligado a la devolución de cualquier recurso o herramienta laboral, que será
                formateada, quedando suprimidos y borrados cualesquiera datos e información almacenados en los mismos de
                ámbito doméstico o particular, siendo únicamente conservada la información laboral y de negocio
                vinculada al puesto y necesaria para la gestión de la actividad mercantil de la empresa. EL TRABAJADOR
                se hace responsable del salvado previo de cualquier información particular y de ámbito doméstico que
                hubiera podido almacenar en los activos y herramientas laborales quedando la empresa exenta de cualquier
                responsabilidad a dichos efectos y en particular por el borrado de la información.</p>
            <p>Puede obtener más información en la política de privacidad de Grupo Piñero, incluido en su Manual de
                Bienvenida o bien solicitándola al Delegado de Protección de Datos, con el que puede contactar en:
                dpd.privacy@grupo-pinero.com.</p>
            <p>EL TRABAJADOR puede ejercitar los derechos de acceso, rectificación, cancelación y oposición dirigiendo
                una comunicación al Delegado de Protección de Datos: dpd.privacy@grupo-pinero.com</p>
            <p>Declaro el entendimiento del presente Documento, manifiesto mi conformidad con su contenido.</p>
        </div>

        <div class="signature">
            <p class="izq">Fdo: ______________________________</p>
            <p class="der">{{ $user->name }} </p>
        </div>
    @endforeach

    @if ($complements->isNotEmpty())
        @foreach ($complements as $equipo)
            <div class="header">
                @if ($empleado->hotel->name == 'TULUM COUNTRY CLUB')
                    <img src="../public/images/Logo_TCC.png" alt="Tulum Country Club Logo" class="logo" />
                @else
                    <img src="../public/images/logo_gp.png" alt="Logo GP" class="logo" />
                @endif
                <div class="title">ENTREGA DE
                    {{ $equipo->type->name }}<br>{{ $empleado->departments->name }}/{{ $empleado->hotel->name }}
                </div>
            </div>
            <br><br>
            <br>
            <br>
            <br>

            <p class="date">Tulum, {{ $date }}</p>

            <div class="content">
                <p>Con esta fecha se le hace entrega a <strong>{{ $empleado->name }}</strong> (en adelante, EL
                    TRABAJADOR),
                    de un equipo marca <strong>{{ $equipo->brand }} ({{ $equipo->model }})</strong>, con número de
                    serie
                    <strong>{{ $equipo->serial }}</strong>
                    @if ($equipo->so == '')
                    .@else, y sistema operativo {{ $equipo->so }}.
                    @endif
                </p>

                <p>El material relacionado es propiedad de la organización Grupo Piñero y se le hace entrega del mismo
                    para
                    el desarrollo de su trabajo, debiendo utilizarlo única y exclusivamente para tal fin,
                    comprometiéndose a
                    custodiarlo y cuidarlo adecuadamente.</p>
                <p>Si causara Vd. baja en la organización se compromete a reintegrar el citado material a la empresa
                    propietaria con carácter previo a la finalización de la relación laboral y al percibo de la
                    liquidación
                    que pudiera corresponderle.</p>
                <p>De acuerdo con la Ley Federal de Protección de Datos Personales en posesión de los Particulares, la
                    empresa con la cual Vd. mantiene relación laboral o contractual (en adelante, LA EMPRESA) informa a
                    EL
                    TRABAJADOR de que los datos de carácter personal contenidos en este documento así como los generados
                    en
                    virtud del objeto del mismo serán tratados con la finalidad de llevar a cabo la asignación y control
                    de
                    los recursos y herramientas laborales que LA EMPRESA pone a su disposición, creación y gestión de
                    identificadores, acceso a aplicaciones, gestión de costes, control de cumplimiento de las normativas
                    de
                    seguridad confidencialidad y uso vinculadas a la herramienta laboral objeto de entrega, control y
                    auditorías de seguridad de carácter preventivo y detectivo, recogida y custodia de evidencias para
                    hacer
                    frente a incidentes y en su caso, adopción de las medidas disciplinarias que procedan en caso de
                    vulneración de las normas de seguridad y uso de la herramienta por EL TRABAJADOR.</p>
                <p>Con los mismos fines, la empresa llevará a cabo la vigilancia, control y monitorización de las
                    herramientas e instrumentos de trabajo utilizadas por EL TRABAJADOR y el almacenamiento de la
                    información resultante, quedando EL TRABAJADOR informado de que tales actuaciones se realizarán sin
                    expectativas de intimidad, confidencialidad ni secreto de las comunicaciones por tratarse de
                    herramientas e instrumentos laborales propiedad de LA EMPRESA.</p>
                <p>Cuando la empresa lo estime oportuno y en todo caso finalizada la relación laboral cualquiera que sea
                    la
                    causa, EL TRABAJADOR queda obligado a la devolución de cualquier recurso o herramienta laboral, que
                    será
                    formateada, quedando suprimidos y borrados cualesquiera datos e información almacenados en los
                    mismos de
                    ámbito doméstico o particular, siendo únicamente conservada la información laboral y de negocio
                    vinculada al puesto y necesaria para la gestión de la actividad mercantil de la empresa. EL
                    TRABAJADOR
                    se hace responsable del salvado previo de cualquier información particular y de ámbito doméstico que
                    hubiera podido almacenar en los activos y herramientas laborales quedando la empresa exenta de
                    cualquier
                    responsabilidad a dichos efectos y en particular por el borrado de la información.</p>
                <p>Puede obtener más información en la política de privacidad de Grupo Piñero, incluido en su Manual de
                    Bienvenida o bien solicitándola al Delegado de Protección de Datos, con el que puede contactar en:
                    dpd.privacy@grupo-pinero.com.</p>
                <p>EL TRABAJADOR puede ejercitar los derechos de acceso, rectificación, cancelación y oposición
                    dirigiendo
                    una comunicación al Delegado de Protección de Datos: dpd.privacy@grupo-pinero.com</p>
                <p>Declaro el entendimiento del presente Documento, manifiesto mi conformidad con su contenido.</p>
            </div>

            <div class="signature">
                <p>Fdo: ______________________________</p>
            </div>
        @endforeach
    @else
    @endif

</body>

</html>
