<div class="row mt-3 mb-3">
    <div class="col-4">
        <select class="form-control border rounded-pill" id="comunidades" wire:model="selectedComunidad">
            <option selected>Comunidad...</option>
            @foreach($comunidades as $comunidad)
                <option value="{{ $comunidad['CCOM'] }}">{{ $comunidad['COM'] }}</option>
            @endforeach
        </select>
        @error('comunidad')
            <p class-"text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
    <div class="col-4">
        <select class="form-control border rounded-pill" id="provincias" wire:model="selectedProvincia">
            <option selected>Provincia...</option>
            @if(!is_null($selectedComunidad))
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia['CPRO'] }}">{{ $provincia['PRO'] }}</option>
                @endforeach
            @endif
        </select>
        @error('provincia')
            <p class-"text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
    <div class="col-4">
        <select class="form-control border rounded-pill" id="municipios" wire:model="selectedMunicipio">
            <option selected>Municipio...</option>
            @if(!is_null($selectedProvincia))
                @foreach($municipios as $municipio)
                    <option value="{{ $municipio['CMUM'] }}">{{ $municipio['DMUN50'] }}</option>
                @endforeach
            @endif
        </select>
        @error('municipio')
            <p class-"text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

</div>