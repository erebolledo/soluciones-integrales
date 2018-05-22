@extends('layouts.email')
@section('content')
<style>
    th {
        text-align: center;
    }
</style>
    <tr>
        <td colspan="2">
            <br>
            <table style="border: 1px solid #b6bcc2; background-color: #f1f7fb; padding: 10px">
                <tr>
                    <td style="padding: 15px">
                        <p>Su paquete identificado con el número de orden {{$order->id}} fue recibido en nuestros almacenes en Miami.</p>
                        <p>Las características son:</p>
                        <table style="background-color: white; border: 1px solid #b6bcc2;" cellspacing="0">
                            <tr align="center" style="background-color: #b6bcc2;">
                                <th width="30%">Total Piezas</th><th width="30%">Total Peso</th><th width="30%">Total Peso-Volúmen</th>
                            </tr>
                            <tr align="center">
                                <td>{{$order->pieces}}</td><td>{{sprintf('%0.2f', $order->weight)}}lb</td><td>{{sprintf('%0.2f', $order->vol_weight)}}lb</td>
                            </tr>
                        </table>
                        <br>
                        <table style="background-color: white; font-size: x-small; border: 1px solid #b6bcc2;" cellspacing="0">
                            <tr align="center" style="background-color: #b6bcc2;">
                                <th width="10%">Largo</th><th width="10%">Ancho</th><th width="10%">Alto</th>
                                <th width="10%">Peso</th><th width="50%">Descripción del contenido</th>
                            </tr>
                            <tr align="center">
                                <td>{{sprintf('%0.2f', $order->large)}}"</td><td>{{sprintf('%0.2f', $order->width)}}"</td><td>{{sprintf('%0.2f', $order->high)}}"</td>
                                <td>{{sprintf('%0.2f', $order->weight)}}lb</td><td>{{$order->description}}</td>
                            </tr>
                        </table>                        
                        <br>
                        <p>Le notificaremos cuando el paquete arribe a nuestras instalaciones en Caracas y este listo para la entrega.</p>
                        <br>
                        <p>Saludos</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection        
