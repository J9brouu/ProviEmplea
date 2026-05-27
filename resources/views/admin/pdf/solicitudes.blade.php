<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        Reporte Solicitudes
    </title>

    <style>

        body{
            font-family: Arial;
        }

        h1{
            text-align:center;
            margin-bottom:30px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            border:1px solid #ccc;
            padding:10px;
            text-align:left;
        }

        th{
            background:#f3f4f6;
        }

    </style>

</head>

<body>

    <h1>
        Reporte de Solicitudes
    </h1>

    <table>

        <thead>

            <tr>

                <th>
                    Talento
                </th>

                <th>
                    Empresa
                </th>

                <th>
                    Estado
                </th>

                <th>
                    Fecha
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($solicitudes as $solicitud)

                <tr>

                    <td>
                        {{ $solicitud->talento->user->name }}
                    </td>

                    <td>
                        {{ $solicitud->datosEmpresa->user->name }}
                    </td>

                    <td>
                        {{ $solicitud->estado }}
                    </td>

                    <td>
                        {{ optional($solicitud->created_at)->format('d/m/Y') }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</body>

</html>