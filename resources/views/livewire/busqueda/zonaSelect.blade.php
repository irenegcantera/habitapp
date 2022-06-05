<div>
    <select class="form-select form-select-sm mb-3" name="comunidades" id="comunidad" wire:model="selectedComunidad">
        <option value="0">Comunidad...</option>
        
        @foreach($comunidades as $comunidad)
            @if($comunidad['COM'] == Cache::get('comunidad'))
                <option value="{{ $comunidad['CCOM'] }}" selected>{{ $comunidad['COM'] }}</option>
            @else
                <option value="{{ $comunidad['CCOM'] }}">{{ $comunidad['COM'] }}</option>
            @endif
        @endforeach
    </select>

    <select class="form-select form-select-sm mb-3" name="provincias" id="provincia" wire:model="selectedProvincia">
        <option value="0" selected>Provincia...</option>
        @if(!is_null($selectedComunidad))
            @foreach($provincias as $provincia)
                <option value="{{ $provincia['CPRO'] }}">{{ $provincia['PRO'] }}</option>
            @endforeach
        @endif
    </select>

    <select class="form-select form-select-sm mb-3" name="municipios" id="municipio" wire:model="selectedMunicipio">
        <option value="0" selected>Municipio...</option>
        @if(!is_null($selectedProvincia))
            @foreach($municipios as $municipio)
                <option value="{{ $municipio['CMUM'] }}">{{ $municipio['DMUN50'] }}</option>
            @endforeach
        @endif
    </select>
</div>

