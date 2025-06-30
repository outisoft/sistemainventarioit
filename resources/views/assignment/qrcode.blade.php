<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://bsuite.grupo-pinero.com/bsuite/favicon.ico">
    <style>
        body {
            background-image: linear-gradient(45deg, #f7f6ef, #ece9d5);
            font-family: 'Muli', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        /* From Uiverse.io by Cobp */
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            background-color: #242824;
            padding: 10px;
            border-radius: 6px;
            gap: 0.5rem;
            height: max-content;
        }

        .card_form {
            position: relative;
            width: 18.75em;
            height: 18.75em;
            border-radius: 4px;
            background-color: #b5a160;
            transition: 0.2s ease-in-out;
            overflow: hidden;
        }

        .card_form span {
            font-size: 1.5em;
            position: absolute;
            inset: 0;
            padding: 5px 10px;
            color: #fff;
            background-image: linear-gradient(to top,
                    rgba(0, 0, 0, 0) 0%,
                    rgba(0, 0, 0, 0.7) 100%);
            opacity: 0;
            transition: all 0.2s ease-in-out;
        }

        .card:hover .card_form span,
        .card:hover .card_data span {
            opacity: 1;
        }

        .card_data {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card_data span {
            color: #b5a160;
            display: flex;
            align-items: center;
            font-size: 0.9em;
            transition: 0.2s ease-in-out;
            opacity: 0;
            cursor: pointer;
        }

        .card_data span:hover {
            text-decoration: underline;
        }

        .text {
            display: flex;
            justify-content: center;
            flex-direction: column;
            color: white;
        }

        .text_m {
            font-size: 0.9em;
        }

        .text_s {
            color: #b5a160;
            font-size: 0.6em;
        }

        .cube {
            width: max-content;
            height: 10px;
            transition: all 0.2s;
            transform-style: preserve-3d;
        }

        .card:hover .cube {
            transform: rotateX(90deg);
        }

        .side {
            width: max-content;
            height: 1em;
            display: flex;
            justify-content: center;
            align-items: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: bold;
        }

        .top {
            transform: rotateX(-90deg) translate3d(0, 0, 0em);
        }

        .front {
            transform: translate3d(0, 0, 1em);
        }
    </style>
    <script>
        function printQR() {
            window.print();
        }
    </script>
</head>

<body>
    <div class="card">
        <div class="card_form">
            <span>{{ $position->ad }}</span>
            <img src="data:image/png;base64,{{ base64_encode($qrcode) }}" alt="QR Code">
        </div>
        <div class="card_data">
            <div style="display: flex" class="data">
                <div class="text">
                    <label class="text_m">{{ $position->employee->name ?? 'N/A' }}</label>

                    <div class="cube text_s">
                        <label class="side front"> {{ $position->email }} </label>
                        <label class="side top">{{ $position->position }} </label>
                    </div>
                </div>
            </div>
            <span title="Descargar codigo QR">
                <a href="{{ route('downloadQRCode', $position->id) }}"
                    download="qrcode_employee_{{ $position->id }}.png">Descargar QR</a>
            </span>
        </div>
    </div>

</body>

</html>
