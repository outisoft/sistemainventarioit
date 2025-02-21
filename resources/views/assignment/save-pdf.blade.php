@if ($empleado->hotel->name == 'TULUM COUNTRY CLUB')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formato de Resguardo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .logo {
            width: 150px;
            height: auto;
            float: left;
            width: 40%;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        h3 {
            font-size: 18px;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 0; /* Cambiado a 0 para eliminar el margen inferior */
        }

        .folio {
            text-align: right;
            margin-bottom: 20px;
        }

        .employee-info {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        table td {
            background-color: #fff;
        }

        .signature {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .signature-item {
            width: 40%;
            text-align: center;
        }

        .signature-line {
            border-bottom: 1px solid #000; /* Línea para firmar */
            padding-bottom: 15px; /* Espacio para la firma */
            margin-top: 2px;
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
    </style>
</head>
<body>
    <div class="container">
        <img src="../public/images/Logo_TCC.png" alt="Tulum Country Club Logo" class="logo" />
        <div class="folio">
            <p><strong>Folio:</strong> 04-21 <br>
            <strong>{{ $empleado->hotel->name }}</strong>/ {{ $empleado->departments->name }} <br>
            <strong>FECHA:</strong> {{ $date }} </p>
        </div>
        <br>
        <h1>CONDICIONES DEL RESGUARDO</h1>
        <p>
            A través de esta carta responsiva yo <strong>{{ $empleado->name }}</strong> declaro ser el único responsable
            y agrego tener bajo mi resguardo el equipo que me ha sido asignado por la empresa
            <strong>Grupo Piñero</strong>, exclusivamente para la utilidad que a la empresa convenga. Del
            mismo modo acepto la responsabilidad de mantener en condiciones óptimas para su
            buen desempeño y notificar inmediatamente a la empresa de cualquier desperfecto
            o cualquier siniestro que sufra el equipo.
        </p>
        <p>
            Asimismo, me hago conocedor de las políticas de privacidad y seguridad que
            contempla la empresa para el uso debido de los equipos asignados.
        </p>

        <h3>Recibí Equipo(s):</h3>
        <table>
            <thead>
                <tr>
                    <th>Tipo de equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Número de serie</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <p>
            En caso contrario me comprometo a aceptar las sanciones y/o el pago por daños al
            equipo que el reglamento interno de la empresa establece.
        </p>

        <div class="employee-info">
            <p><strong>N° EMPLEADO: </strong>{{ $empleado->no_empleado }} <br>
            <strong>NOMBRE: </strong>{{ $empleado->name }} <br>
            <strong>PUESTO: </strong>{{ $empleado->puesto }} <br>
            <strong>DEPARTAMENTO: </strong> {{ $empleado->departments->name }}</p>
        </div>

        <div class="signature">
            <div class="signature-item">
                <p><strong>Recibió:</strong></p>
                <p class="signature-line">{{ $empleado->name}}</p>
            
                <p><strong>Entregó:</strong></p>
                <p class="signature-line">Nombre de quien entrega</p>
            </div>
        </div>
    </div>
</body>
</html>
@else
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
                        <p class="izq">Fdo: ______________________________</p>
                        <p class="der">{{ $user->name }} </p>
                    </div>
                @endforeach
            @else
            @endif

        </body>

    </html>
@endif