@extends('layouts.admin')
@section('content')
    <div>
        <h3>Ordenes</h3>
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>
        <div id="root"><script src="<?= asset('js/TableOrders.js')?>"></script></div>
    </div>    
@endsection

