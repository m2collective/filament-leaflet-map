<?php
declare(strict_types=1);

namespace M2Collective\FilamentLeafletMap\Forms\Components;

use Filament\Forms\Components\Field;
use M2Collective\FilamentSDK\Forms\Components\Concerns\CanDetectRetina;
use M2Collective\FilamentSDK\Forms\Components\Concerns\CanScrollWheelZoom;
use M2Collective\FilamentSDK\Forms\Components\Concerns\CanZoomControl;
use M2Collective\FilamentSDK\Forms\Components\Concerns\HasLatitude;
use M2Collective\FilamentSDK\Forms\Components\Concerns\HasLongitude;
use M2Collective\FilamentSDK\Forms\Components\Concerns\HasMaxZoom;
use M2Collective\FilamentSDK\Forms\Components\Concerns\HasMinZoom;
use M2Collective\FilamentSDK\Forms\Components\Concerns\HasTileLayer;
use M2Collective\FilamentSDK\Forms\Components\Concerns\HasTileSize;
use M2Collective\FilamentSDK\Forms\Components\Concerns\HasZoom;
use M2Collective\FilamentSDK\Forms\Components\Concerns\HasZoomOffset;
use M2Collective\FilamentSDK\Support\Concerns\ConvertToJson;

final class Map extends Field
{
    use CanDetectRetina,
        CanScrollWheelZoom,
        CanZoomControl,
        HasTileLayer,
        HasTileSize,
        HasLatitude,
        HasLongitude,
        HasZoom,
        HasZoomOffset,
        HasMaxZoom,
        HasMinZoom,
        ConvertToJson;

    /**
     * @var string
     */
    protected string $view = 'filament-leaflet-map::forms.components.map';

    /**
     * @var array
     */
    protected array $config = [];

    /**
     * @return string
     */
    public function config(): string
    {
        $this->config['statePath'] = $this->getStatePath();

        if(!empty($this->tileLayer)) {
            $this->config['tileLayer'] = $this->tileLayer;
        } else {
            $this->config['tileLayer'] = config('filament-leaflet-map.tileLayer');
        }

        if(!empty($this->tileSize)) {
            $this->config['tileSize'] = $this->tileSize;
        } else {
            $this->config['tileSize'] = config('filament-leaflet-map.tileSize');
        }

        if(!empty($this->latitude)) {
            $this->config['latitude'] = $this->latitude;
        } else {
            $this->config['latitude'] = config('filament-leaflet-map.latitude');
        }

        if(!empty($this->longitude)) {
            $this->config['longitude'] = $this->longitude;
        } else {
            $this->config['longitude'] = config('filament-leaflet-map.longitude');
        }

        if(!empty($this->zoom)) {
            $this->config['zoom'] = $this->zoom;
        } else {
            $this->config['zoom'] = config('filament-leaflet-map.zoom');
        }

        if(!empty($this->zoomOffset)) {
            $this->config['zoomOffset'] = $this->zoomOffset;
        } else {
            $this->config['zoomOffset'] = config('filament-leaflet-map.zoomOffset');
        }

        if(!empty($this->maxZoom)) {
            $this->config['maxZoom'] = $this->maxZoom;
        } else {
            $this->config['maxZoom'] = config('filament-leaflet-map.maxZoom');
        }

        if(!empty($this->minZoom)) {
            $this->config['minZoom'] = $this->minZoom;
        } else {
            $this->config['minZoom'] = config('filament-leaflet-map.minZoom');
        }

        if(!empty($this->detectRetina)) {
            $this->config['detectRetina'] = $this->detectRetina;
        } else {
            $this->config['detectRetina'] = config('filament-leaflet-map.detectRetina');
        }

        if(!empty($this->zoomControl)) {
            $this->config['zoomControl'] = $this->zoomControl;
        } else {
            $this->config['zoomControl'] = config('filament-leaflet-map.zoomControl');
        }

        if(!empty($this->scrollWheelZoom)) {
            $this->config['scrollWheelZoom'] = $this->scrollWheelZoom;
        } else {
            $this->config['scrollWheelZoom'] = config('filament-leaflet-map.scrollWheelZoom');
        }

        return $this->convertToJson($this->config);
    }
}
