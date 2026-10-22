<?php
declare(strict_types=1);

namespace M2Collective\FilamentLeafletMap;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

final class FilamentLeafletMapServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            path: __DIR__ . '/../config/filament-leaflet-map.php',
            key: 'filament-leaflet-map'
        );
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(
            path: __DIR__ . '/../resources/views',
            namespace: 'filament-leaflet-map'
        );

        FilamentAsset::register(assets: [
            Css::make(id: 'filament-leaflet-map', path: __DIR__.'/../dist/filament-leaflet-map.css'),
            Js::make(id: 'filament-leaflet-map', path: __DIR__.'/../dist/filament-leaflet-map.js'),
        ], package: 'filament-leaflet-map');
    }
}
