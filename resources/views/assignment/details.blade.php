<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Empleado</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://bsuite.grupo-pinero.com/bsuite/favicon.ico">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Muli&display=swap');

        * {
            box-sizing: border-box;
        }


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

        .courses-container {
            
        }

        .course {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            max-width: 100%;
            margin: 20px;
            overflow: hidden;
            width: 700px;
        }

        .course h6 {
            opacity: 0.6;
            margin: 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .course h2 {
            letter-spacing: 1px;
            margin: 10px 0;
        }

        .course-preview {
            background-color: #a48c4e;
            color: #fff;
            padding: 30px;
            max-width: 250px;
        }

        .course-preview a {
            color: #fff;
            display: inline-block;
            font-size: 12px;
            opacity: 0.6;
            margin-top: 30px;
            text-decoration: none;
        }

        .course-info {
            padding: 30px;
            position: relative;
            width: 100%;
        }

        .progress-container {
            position: absolute;
            top: 30px;
            right: 30px;
            text-align: right;
            width: 150px;
        }

        .progress {
            background-color: #ddd;
            border-radius: 3px;
            height: 5px;
            width: 100%;
        }

        .progress::after {
            border-radius: 3px;
            background-color: #2A265F;
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 5px;
            width: 66%;
        }

        .progress-text {
            font-size: 10px;
            opacity: 0.6;
            letter-spacing: 1px;
        }

        .btn {
            border: 0;
            color: #fff;
            font-size: 16px;
            padding: 12px 25px;
            position: absolute;
            bottom: 30px;
            right: 30px;
            letter-spacing: 1px;
        }

        /* SOCIAL PANEL CSS */
        .social-panel-container {
            position: fixed;
            right: 0;
            bottom: 80px;
            transform: translateX(100%);
            transition: transform 0.4s ease-in-out;
        }

        .social-panel-container.visible {
            transform: translateX(-10px);
        }

        .social-panel {	
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 16px 31px -17px rgba(0,31,97,0.6);
            border: 5px solid #001F61;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Muli';
            position: relative;
            height: 169px;	
            width: 370px;
            max-width: calc(100% - 10px);
        }

        .social-panel button.close-btn {
            border: 0;
            color: #97A5CE;
            cursor: pointer;
            font-size: 20px;
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .social-panel button.close-btn:focus {
            outline: none;
        }

        .social-panel p {
            background-color: #001F61;
            border-radius: 0 0 10px 10px;
            color: #fff;
            font-size: 14px;
            line-height: 18px;
            padding: 2px 17px 6px;
            position: absolute;
            top: 0;
            left: 50%;
            margin: 0;
            transform: translateX(-50%);
            text-align: center;
            width: 235px;
        }

        .social-panel p i {
            margin: 0 5px;
        }

        .social-panel p a {
            color: #FF7500;
            text-decoration: none;
        }

        .social-panel h4 {
            margin: 20px 0;
            color: #97A5CE;	
            font-family: 'Muli';	
            font-size: 14px;	
            line-height: 18px;
            text-transform: uppercase;
        }

        .social-panel ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .social-panel ul li {
            margin: 0 10px;
        }

        .social-panel ul li a {
            border: 1px solid #DCE1F2;
            border-radius: 50%;
            color: #001F61;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
            width: 50px;
            text-decoration: none;
        }

        .social-panel ul li a:hover {
            border-color: #FF6A00;
            box-shadow: 0 9px 12px -9px #FF6A00;
        }

        .floating-btn {
            border-radius: 26.5px;
            background-color: #001F61;
            border: 1px solid #001F61;
            box-shadow: 0 16px 22px -17px #03153B;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            line-height: 20px;
            padding: 12px 20px;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
        }

        .floating-btn:hover {
            background-color: #ffffff;
            color: #001F61;
        }

        .floating-btn:focus {
            outline: none;
        }

        .floating-text {
            background-color: #001F61;
            border-radius: 10px 10px 0 0;
            color: #fff;
            font-family: 'Muli';
            padding: 7px 15px;
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            z-index: 998;
        }

        .floating-text a {
            color: #FF7500;
            text-decoration: none;
        }

        @media screen and (max-width: 480px) {

            .social-panel-container.visible {
                transform: translateX(0px);
            }
            
            .floating-btn {
                right: 10px;
            }
        }
        /*----------------- CARDS-------------------*/
        /* From Uiverse.io by anniekoop */ 
    .card {
        width: fit-content;
        background-color: #f2f3f7;
        border-radius: 0.75em;
        cursor: pointer;
        transition: ease 0.2s;
        box-shadow: 1em 1em 1em #d8dae0b1, -0.75em -0.75em 1em #ffffff;
        border: 1.5px solid #f2f3f7;
    }

    .card:hover {
        background-color: #d3ddf1;
        border: 1.5px solid #1677ff;
    }

    .container {
        margin-top: 1.25em;
        margin-bottom: 1.375em;
        margin-left: 1.375em;
        margin-right: 2em;
        display: flex;
        flex-direction: row;
        gap: 0.75em;
    }

    .status-ind {
        width: 0.625em;
        height: 0.625em;
        background-color: #ff0000;
        margin: 0.375em 0;
        border-radius: 0.5em;
    }

    .text-wrap {
        display: flex;
        flex-direction: column;
        gap: 0.25em;
        color: #333;
    }

    .time {
        font-size: 0.875em;
        color: #777;
    }

    .text-link {
        font-weight: 500;
        text-decoration: none;
        color: black;
    }

    .button-wrap {
        display: flex;
        flex-direction: row;
        gap: 1em;
        align-items: center;
    }

    .secondary-cta {
        background-color: transparent;
        border: none;
        font-size: 15px;
        font-weight: 400;
        color: #666;
        cursor: pointer;
    }

    .primary-cta {
        font-size: 15px;
        background-color: transparent;
        font-weight: 600;
        color: #1677ff;
        border: none;
        border-radius: 1.5em;
        cursor: pointer;
    }

    button:hover {
        text-decoration: underline; 
    }

    .right {
        display: flex;
        flex-direction: column;
        gap: 0.875em;
    }

    </style>
</head>
<body>
<div class="courses-container">
	<div class="course">
		<div class="course-preview">
			<h6> {{ $employee->puesto }} </h6>
			<h2>{{ $employee->name }}</h2>
			<a href="#"> {{ $employee->email }} <i class="fas fa-chevron-right"></i></a>
		</div>
		<div class="course-info">
			<div class="progress-container">
                #{{ $employee->no_empleado}}
			</div>
			<h6> {{ $employee->ad}} </h6>
			<h2>{{ $employee->departments->name }} / {{ $employee->hotel->name}} </h2>

            <a class="btn" href="#">
                <img src="{{ asset('images/gp-Logo.png') }}" alt="Imagen de ejemplo" width="36"
                    height="36" />
            </a>
		</div>
	</div>
</div>
@foreach ($employee->equipos as $equipo)
<div class="card">
    <div class="container">
        <div class="left">
            <div class="status-ind"></div>
        </div>
        <div class="right">
            <div class="text-wrap">
                <p class="text-content">
                <a class="text-link" href="#">{{ $equipo->tipo->name }}</a> CON NOMBRE {{ $equipo->name }} CON LA IP 
                <a class="text-link" href="#">{{ $equipo->ip }}</a> .
                </p>
                <p class="time">DE LA MARCA {{ $equipo->marca }}, MODELO {{ $equipo->model }} Y NUMERO DE SERIE {{ $equipo->serial }}</p>
            </div>
        </div>
    </div>
</div>
<br>
@endforeach
</body>
</html>

