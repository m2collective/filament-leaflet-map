<?php
declare(strict_types=1);

namespace M2Collective\FilamentLeafletMap;

use Filament\Support\Assets\Asset;
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
            __DIR__ . '/../config/filament-leaflet-map.php', $this->getPackageName()
        );
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views', $this->getPackageName()
        );

        FilamentAsset::register(
            $this->getPackageAssets(), $this->getPackageName()
        );
    }

    /**
     * @return string
     */
    protected function getPackageName(): string
    {
        return 'filament-leaflet-map';
    }

    /**
     * @return array<Asset>
     */
    public function getPackageAssets(): array
    {
        return [
            Css::make($this->getPackageName(), __DIR__.'/../dist/filament-leaflet-map.css'),
            Js::make($this->getPackageName(), __DIR__.'/../dist/filament-leaflet-map.js'),
        ];
    }
}
