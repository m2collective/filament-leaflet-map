<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div class="filament-leaflet-map" x-data="filamentLeafletMap($wire, {{ $config() }})" {{ $getExtraAttributeBag() }}
    x-init="async () => {
            do {
                await (new Promise(resolve => setTimeout(resolve, 100)));
            } while (!$refs.map);

            attach($refs.map);
        }" wire:ignore>
        <div x-ref="map" class="filament-leaflet-map__container">
            <div class="filament-leaflet-map__sight"></div>
        </div>
        <input {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}" type="hidden"/>
    </div>
</x-dynamic-component>
