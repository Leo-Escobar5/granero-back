<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorio de Tareas Pendientes</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }

        /* Contenedor principal centrado */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Título principal */
        h1 {
            color: #4A90E2;
            text-align: center;
            font-size: 26px;
            margin-bottom: 20px;
        }

        /* Parrafo inicial */
        p {
            font-size: 16px;
            text-align: center;
        }

        /* Estilo de la lista */
        ul {
            list-style-type: none;
            padding: 0;
        }

        /* Estilo de cada tarea */
        li {
            background-color: #f9f9fb;
            border-left: 4px solid #4A90E2;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Estilo de los textos dentro de cada tarea */
        li strong {
            display: inline-block;
            width: 120px;
            color: #333;
            font-weight: bold;
        }

        /* Espaciado entre las tareas */
        li br + br {
            margin-bottom: 10px;
        }

        /* Footer del email */
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Hola, {{ $nombre }}</h1>
        <p>Tienes las siguientes tareas pendientes:</p>

        <ul>
        @foreach($tareas as $tarea)
            <li>
                <strong>Tarea:</strong> {{ $tarea->Tarea }}<br>
                <strong>Descripción:</strong> {{ $tarea->Descripcion }}<br>
                <strong>Seguimiento:</strong> {{ $tarea->Seguimiento }}<br>
                <strong>Fecha Límite:</strong> {{ \Carbon\Carbon::parse($tarea->Limite)->format('d/m/Y') }}<br>
            </li>
        @endforeach
        </ul>

        <p>Por favor, asegúrate de completar tus tareas antes de la fecha límite.</p>
        <div class="footer">
            <p>Este es un recordatorio automático, no es necesario que respondas.</p>
        </div>
    </div>
</body>
</html>
