<div>
    <label class="fw-bold mb-2" for="direccion">Dirección</label><br>
    <label class="form-label" for="comunidades">Comunidad <span class="text-danger fw-bold">(*)</span></label>
    <select class="form-select mb-3" name="comunidades" wire:model="selectedComunidad" required>
        <option value="0" selected>Seleccione...</option>
        @foreach($comunidades as $comunidad)
            <option value="{{ $comunidad['CCOM'] }}">{{ $comunidad['COM'] }}</option>
        @endforeach
    </select>
    @error('comunidades')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    {{-- {{ "selectedComunidad ->".$selectedComunidad }} --}}
    <label class="form-label" for="provincias">Provincia <span class="text-danger fw-bold">(*)</span></label>
    <select class="form-select mb-3" name="provincias" wire:model="selectedProvincia" required>
        <option value="0" selected>Seleccione...</option>
        @if(!is_null($selectedComunidad))
            @foreach($provincias as $provincia)
                <option value="{{ $provincia['CPRO'] }}">{{ $provincia['PRO'] }}</option>
            @endforeach
        @endif
    </select>
    @error('provincias')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    {{-- {{ "selectedProvincia ->".$selectedProvincia }} --}}
    <div class="row">
        <div class="col">
            <label class="form-label" for="municipios">Municipio</label>
            <select class="form-select mb-3" name="municipios" wire:model="selectedMunicipio">
                <option value="0" selected>Seleccione...</option>
                @if(!is_null($selectedProvincia))
                    @foreach($municipios as $municipio)
                        <option value="{{ $municipio['CMUM'] }}">{{ $municipio['DMUN50'] }}</option>
                    @endforeach
                @endif
            </select>
            @error('municipios')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label class="form-label" for="cod_postal">Código postal <span class="text-danger fw-bold">(*)</span></label>
            <input class="form-control" type="text" name="cod_postal" id="cod_postal" value="{{ old('cod_postal') }}" required>
        </div>
    </div>     
</div>        