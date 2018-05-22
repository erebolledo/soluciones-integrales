@extends('layouts.email')
@section('content')
    <tr>
        <td colspan="2">
            <br>
            <table style="border: 1px solid #b6bcc2; background-color: #f1f7fb; padding: 10px">
                <tr>
                    <td style="padding: 15px">
                        <p>Su orden identificada con el número {{$order->id}} fue registrada en nuestro sistema.</p>
                        <p>Le notificaremos cuando la misma arribe a nuestras instalaciones.</p>
                        <br>
                        <p>Saludos</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection        
