@php
    $id = 'SW' . $switch->id;
    $class = match ($switch->tipo) {
        'principal' => 'principal',
        'secundario' => 'secundario',
        'idf' => 'idf',
        default => 'secundario',
    };
@endphp

{{ $id }}["{{ $switch->name }}\nIP: {{ $switch->ip }}\nPuerto: {{ $switch->connected_port }}\nPuertos:
{{ $switch->ports }}"]:::{{ $class }}

@foreach ($switch->cameras as $camera)
    @php $camId = 'CAM' . $camera->id; @endphp
    {{ $id }} --> {{ $camId }}["{{ $camera->name }}\nIP: {{ $camera->ip }}\nPuerto:
    {{ $camera->connected_port }}"]:::camara
@endforeach

@foreach ($switch->connectedSwitches as $child)
    @php $childId = 'SW' . $child->id; @endphp
    {{ $id }} --> {{ $childId }}["{{ $child->name }}\nIP: {{ $child->ip }}\nPuerto:
    {{ $child->connected_port }}"]:::{{ match ($child->tipo) {
        'principal' => 'principal',
        'secundario' => 'secundario',
        'idf' => 'idf',
        default => 'secundario',
    } }}
    @include('cctv.partials.mermaid-tree', ['switch' => $child])
@endforeach
