<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'HabitApp')
<img src="{{ asset('logo/logo-inicio.png')}}" class="logo" alt="HabitApp Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
