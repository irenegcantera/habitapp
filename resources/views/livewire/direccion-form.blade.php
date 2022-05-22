<div>
    <label class="fw-bold mb-2" for="direccion">Dirección</label><br>
    <label class="form-label" for="comunidades">Comunidad</label>
    <select class="form-select mb-3" name="comunidades" wire:model="selectedComunidad" required>
        <option value="0" selected>Seleccione...</option>
        @foreach($comunidades as $comunidad)
            <option value="{{ $comunidad['CCOM'] }}">{{ $comunidad['COM'] }}</option>
        @endforeach
    </select>
    {{-- {{ "selectedComunidad ->".$selectedComunidad }} --}}
    <label class="form-label" for="provincias">Provincia</label>
    <select class="form-select mb-3" name="provincias" wire:model="selectedProvincia" required>
        <option value="0" selected>Seleccione...</option>
        @if(!is_null($selectedComunidad))
            @foreach($provincias as $provincia)
                <option value="{{ $provincia['CPRO'] }}">{{ $provincia['PRO'] }}</option>
            @endforeach
        @endif
    </select>
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
        </div>
        <div class="col">
            <label class="form-label" for="cod_postal">Código postal</label>
            <input class="form-control" type="text" name="cod_postal" id="cod_postal" required>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <label class="form-label" for="calle">Calle</label>
            <input class="form-control" type="text" name="calle" id="calle" required>
        </div>
        <div class="col-2">
            <label class="form-label" for="numero">Número</label>
            <input class="form-control" type="text" name="numero" id="numero" required>
        </div>
        <div class="col-2">
            <label class="form-label" for="portal">Portal</label>
            <input class="form-control" type="text" name="portal" id="portal">
        </div>
    </div>   
</div>        



    {{-- {{ "selectedMunicipio ->".$selectedMunicipio }} --}}
    {{-- <select class="form-select mb-3" name="poblaciones" wire:model="selectedPoblacion">
        <option value="0" selected>Población...</option>
        @if(!is_null($selectedMunicipio))
            @foreach($poblaciones as $poblacion)
                <option value="{{ $poblacion['NENTSI50'] }}">{{ $poblacion['NENTSI50'] }}</option>
            @endforeach
        @endif
    </select>
    {{ "selectedPoblacion ->".rawurlencode(utf8_encode($selectedPoblacion)) }}
    <select class="form-select mb-3" name="nucleos" wire:model="selectedNucleo">
        <option value="0" selected>Núcleo...</option>
        @if(!is_null($selectedPoblacion))
            @foreach($nucleos as $nucleo)
                <option value="{{ $nucleo['CUN'] }}">{{ $nucleo['NNUCLE50'] }}</option>
            @endforeach
        @endif
    </select>
    {{ "selectedNucleo ->".$selectedNucleo }}
    <select class="form-select mb-3" name="codPostales" wire:model="selectedCodPostal">
        <option value="0" selected>Código postal...</option>
        @if(!is_null($selectedNucleo))
            @foreach($codPostales as $codPostal)
                <option value="{{ $codPostal['CPOS'] }}">{{ $codPostal['CPOS'] }}</option>
            @endforeach
        @endif
    </select>
    {{ "selectedCodPostal ->".$selectedCodPostal }}
    <div class="row">
        <div class="col">
            <select class="form-select mb-3" name="calles" wire:model="selectedCalle">
                <option value="0" selected>Calle...</option>
                @if(!is_null($selectedCodPostal))
                    @foreach($calles as $calle)
                        <option value="{{ $calle['NVIAC'].", ".$calle['TVIA'] }}">{{ $calle['NVIAC'].", ".$calle['TVIA'] }}</option>
                    @endforeach
                @endif
            </select>
            {{ "selectedCalle ->".$selectedCalle }}
        </div> --}}