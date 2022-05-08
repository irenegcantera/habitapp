@extends('nav-foot')

@section('content')
<div class="row">
    <div class="col">
        <table>
            @foreach($mensajes as $mensaje)
                {{-- @if({{ auth()->user()->id == $mensaje->from_user }})
                    <tr><td>Mensaje 1</td></tr>
                    <tr><td>Mensaje 1</td></tr>
                    <tr><td>Mensaje 1</td></tr>
                    <tr><td>Mensaje 1</td></tr>
                @endif --}}
            @endforeach
        </table>
    </div>
    <div class="col">
        @livewire('chat-form')
    </div>
</div>
@endsection 

