<!DOCTYPE html>
<html>
<head>
    <title>codigo barras {{$producto->nombre_producto}}</title>
    <style>
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .styled-table td {
            padding: 12px 15px;
        }
    </style>
</head>
<body>
    <h2>{{$producto->nombre_producto}}</h2>
    <div class="table-responsive">
        <table class="styled-table">
        <tbody>
        <?php $cont=0;?>
        @for ($i =1; $i <= $cantidad; $i++)
            @if($cont == 0)
                <tr>
            @endif
            @if($cont <= 2)
                <td>
                    {!! DNS1D::getBarcodeHTML($producto->barCodigo, 'PHARMA') !!} <br>
                    <div style="text-align-center">{{$producto->barCodigo}}</div>
                </td>
            @endif
            <?php $cont++;?>
            @if($cont == 3)
                </tr>
                <?php $cont=0; ?>
            @endif
        @endfor
        </tr>
        </tbody>
        </table>
    </div>
</body>
</html>