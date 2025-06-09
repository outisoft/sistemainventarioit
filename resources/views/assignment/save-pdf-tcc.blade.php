<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formato de Resguardo</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://bsuite.grupo-pinero.com/bsuite/favicon.ico">
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
            text-align: center;
            font-size: 16px;
            margin-top: 5px;
            margin-bottom: 0px;
        }

        p {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 0;
            margin-top: 5%;
            /* Cambiado a 0 para eliminar el margen inferior */
        }

        .text-justify {
            text-align: justify;
        }

        .folio {
            text-align: right;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .signature-item {
            width: 45%;
        }

        .signature-item.left {
            text-align: center;
            height: auto;
            float: left;
            width: 50%;
        }

        .signature-item.right {
            font-size: 18px;
            text-align: center;
            float: left;
            width: 50%;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 40px;
            padding-top: 5px;
            width: 80%;
            /* Ajusta este valor según sea necesario */
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="../public/images/Logo_TCC.png" alt="Tulum Country Club Logo" class="logo" />
        <div class="folio">
            <p>
                <strong>{{ $position->hotel->name }}</strong> / {{ $position->departments->name }} <br>
                <strong>FECHA:</strong> {{ $date }}
            </p>
        </div>
        <br>
        <h3>CONDICIONES DEL RESGUARDO</h3>
        <p class="text-justify">
            A través de esta carta responsiva yo <strong>{{ $position->employee->name }}</strong> declaro ser el único
            responsable
            y agrego tener bajo mi resguardo el equipo que me ha sido asignado por la empresa
            <strong>Grupo Piñero</strong>, exclusivamente para la utilidad que a la empresa convenga. Del
            mismo modo acepto la responsabilidad de mantener en condiciones óptimas para su
            buen desempeño y notificar inmediatamente a la empresa de cualquier desperfecto
            o cualquier siniestro que sufra el equipo.
        </p>
        <p class="text-justify">
            Asimismo, me hago conocedor de las políticas de privacidad y seguridad que contempla la empresa para el
            uso debido de los equipos asignados. Puede obtener más información de las políticas solicitándola al
            Delegado de Protección de Datos, con el que puede contactar en: <a
                href="dpd.privacy@grupo-pinero.com.">dpd.privacy@grupo-pinero.com.</a>
        </p>
        <br>
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
                @foreach ($equipos as $equipo)
                    <tr>
                        <td>{{ $equipo->tipo->name }}</td>
                        <td>{{ $equipo->marca }}</td>
                        <td>{{ $equipo->model }}</td>
                        <td>{{ $equipo->serial }}</td>
                        <td>{{ $equipo->observaciones }}</td>
                    </tr>
                @endforeach
                @foreach ($complementos as $complemento)
                    <tr>
                        <td>{{ $complemento->type->name }}</td>
                        <td>{{ $complemento->brand }}</td>
                        <td>{{ $complemento->model }}</td>
                        <td>{{ $complemento->serial }}</td>
                        <td>{{ $complemento->observaciones }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>
            En caso contrario me comprometo a aceptar las sanciones y/o el pago por daños al
            equipo que el reglamento interno de la empresa establece.
        </p>

        <div class="employee-info">
            <p><strong>N° EMPLEADO: </strong>{{ $position->employee->no_employee }} <br>
                <strong>NOMBRE: </strong>{{ $position->employee->name }} <br>
                <strong>PUESTO: </strong>{{ $position->position }} <br>
                <strong>DEPARTAMENTO: </strong> {{ $position->departments->name }}
            </p>
        </div>
        <br>

        <div class="signature">
            <div class="signature-item left">
                <p><strong>Recibió:</strong></p>
                <p class="signature-line">{{ $position->employee->name }}</p>
            </div>
            <div class="signature-item right">
                <p><strong>Entregó:</strong></p>
                <p class="signature-line">{{ $user->name }} </p>
            </div>
        </div>
    </div>
</body>

</html>
