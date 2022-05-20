<div>
    <select class="form-select form-select-sm mb-3" name="comunidades" wire:model="selectedComunidad">
        <option class="text-white-50" value="0" selected>Comunidad...</option>
        @foreach($comunidades as $comunidad)
            <option value="{{ $comunidad['CCOM'] }}">{{ $comunidad['COM'] }}</option>
        @endforeach
    </select>

    <select class="form-select form-select-sm mb-3" name="provincias" wire:model="selectedProvincia">
        <option value="0" selected>Provincia...</option>
        @if(!is_null($selectedComunidad))
            @foreach($provincias as $provincia)
                <option value="{{ $provincia['CPRO'] }}">{{ $provincia['PRO'] }}</option>
            @endforeach
        @endif
    </select>

    <select class="form-select form-select-sm mb-3" name="municipios" wire:model="selectedMunicipio">
        <option value="0" selected>Municipio...</option>
        @if(!is_null($selectedProvincia))
            @foreach($municipios as $municipio)
                <option value="{{ $municipio['CMUM'] }}">{{ $municipio['DMUN50'] }}</option>
            @endforeach
        @endif
    </select>
</div>
