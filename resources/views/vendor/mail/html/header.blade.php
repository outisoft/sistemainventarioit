@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('images/outisoft.jpg') }}" class="logo" alt="Outisoft Logo" style="border-radius: 50%;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
