import '../css/filament-leaflet-map.scss';
import * as Leaflet from 'leaflet';

document.addEventListener('livewire:init', () => {
    window.filamentLeafletMap = ($wire, config) => {
        return {
            map: null,

            init: function () {
                this.$wire = $wire;
            },

            createMap: function (el) {
                this.map = Leaflet.map(el, {
                    center: this.createMapCoordinates(),
                    zoom: config.zoom,
                    zoomControl: config.zoomControl,
                });

                Leaflet.tileLayer(config.tileLayer, {
                    tileSize: config.tileSize,
                    zoomOffset: config.zoomOffset,
                    maxZoom: config.maxZoom,
                    minZoom: config.minZoom,
                    detectRetina: config.detectRetina,
                }).addTo(this.map);

                this.map.on('load', () => {
                    setTimeout(() => this.map.invalidateSize(true), 0);
                });

                this.map.addEventListener('move', (event) => this.updateMapCoordinates(event));

                if (!config.scrollWheelZoom) {
                    this.map.scrollWheelZoom.disable();
                }

                this.map.attributionControl.setPrefix('')
            },

            removeMap: function (el) {
                this.map.off();
                this.map.remove();
                this.map = null;
            },

            createMapCoordinates() {
                if (!this.$wire.get(config.statePath)) {
                    return new Leaflet.LatLng(config.latitude, config.longitude);
                }

                let coordinates = this.$wire.get(config.statePath).split(',');

                return new Leaflet.LatLng(coordinates[0], coordinates[1]);
            },

            updateMapCoordinates(event) {
                let coordinates = new Leaflet.LatLng(
                    this.map.getCenter().lat, this.map.getCenter().lng
                );

                this.$wire.set(
                    config.statePath, coordinates.lat + ',' + coordinates.lng
                );
            },

            debounce: function (func, wait) {
                let timeout;

                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };

                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            },

            attach: function (el, refs = null) {
                if (refs) {
                    this.$refs = refs;
                }

                this.createMap(el);

                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.intersectionRatio > 0) {
                            if (!this.map)
                                this.createMap(el);
                        } else {
                            this.removeMap(el);
                        }
                    });
                });

                observer.observe(el);
            },
        };
    };
});
