@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h3 class="text-black font-bold">Create Project (LOP)</h3>
                    </div>
                </div>
                <div class="card-body px-5 py-2">
                    <form method="POST" action="{{ route('lop.store') }}" id="lopForm">
                        @csrf
                        <input type="hidden" name="permintaan_id" value="{{ $permintaan['id'] }}">
                        <div class="form-group">
                            <label for="">Tanggal Permintaan (m-d-Y)</label>
                            @if ($errors->has('tanggal_permintaan'))
                                <input type="date" name="tanggal_permintaan" class="form-control is-invalid"
                                    id="tanggalPermintaan" value="{{ old('tanggal_permintaan') }}" readonly>
                            @else
                                <input type="date" name="tanggal_permintaan" class="form-control" id="tanggalPermintaan"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="">Nama Permintaan</label>
                            @if ($errors->has('nama_permintaan'))
                                <input type="text" name="nama_permintaan" id="namaPermintaan"
                                    class="form-control is-invalid" value="{{ old('nama_permintaan') }}" readonly>
                            @else
                                <input type="text" class="form-control" name="nama_permintaan" id="namaPermintaan"
                                    value="{{ '[' . $permintaan['tematik_permintaan'] . '] ' . $permintaan['nama_permintaan'] }}"
                                    readonly>
                            @endif
                        </div>
                        <div class="form-group has-validation">
                            <label for="">Nama LOP</label>
                            <input type="text" class="form-control {{ $errors->has('nama_lop') ? 'is-invalid' : '' }}"
                                name="nama_lop" id="namaLop" value="{{ old('nama_lop') }}" placeholder="Nama LOP">
                            <div class="invalid-feedback">
                                {{ $errors->first('nama_lop') }}
                            </div>
                        </div>
                        <div class="form-group has-validation">
                            <label for="">Tematik LOP</label>
                            <select class="form-control {{ $errors->has('tematik_lop') ? 'is-invalid' : '' }}"
                                name="tematik_lop" id="select_tematik_lop">
                                <option value="">-- PILIH TEMATIK --</option>
                                <option value="HEM" {{ old('tematik_lop') == 'HEM' ? 'selected' : '' }}>
                                    HEM</option>
                                <option value="PT 2" {{ old('tematik_lop') == 'PT 2' ? 'selected' : '' }}>
                                    PT 2</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('tematik_lop') }}
                            </div>
                        </div>
                        <div class="form-group has-validation" id="estimasi_rab" style="display: none;">
                            <label for="">Estimasi RAB</label>
                            <select class="form-control {{ $errors->has('estimasi_rab') ? 'is-invalid' : '' }}"
                                name="estimasi_rab" id="select_estimasi_rab">
                                <option value="">-- PILIH ESTIMASI RAB --</option>
                                <option value="<20" {{ old('estimasi_rab') == '< 20 Jt' ? 'selected' : '' }}
                                    data-modal-target="#modalAlokasiMitra">
                                    < 20 Jt </option>
                                <option value=">20" {{ old('estimasi_rab') == '> 20 Jt' ? 'selected' : '' }}>> 20
                                    Jt
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('estimasi_rab') }}
                            </div>
                        </div>

                        <!-- Alokasi Mitra Modal Box -->
                        <div class="modal fade" id="modalAlokasiMitra" tabindex="-1" role="dialog"
                            aria-labelledby="modalAlokasiMitra" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-left">
                                                <h3 class="mb-0">Konfirmasi Alokasi Mitra</h3>
                                            </div>
                                            <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <b>Nama Permintaan</b>
                                                        </td>
                                                        <td>
                                                            <b>:</b>
                                                        </td>
                                                        <td>
                                                            <span id="namaPermintaan-modalAlokasiMitra"
                                                                style="padding-left: 10px;"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <b>Nama LOP</b>
                                                        </td>
                                                        <td>
                                                            <b>:</b>
                                                        </td>
                                                        <td>
                                                            <span id="namaLop-modalAlokasiMitra"
                                                                style="padding-left: 10px;"></span>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <span class="mt-5">
                                                    Anda memilih <b>Tematik LOP = PT 2</b> dan <b>RAB < 20 jt</b> Apakah
                                                            Anda akan langsung
                                                            Alokasi Mitra untuk LOP ini?
                                                </span>
                                            </div>
                                            <div class="card-footer pt-0 px-lg-2 px-1">
                                                <button type="submit" name="submitAction" class="btn btn-primary btn-sm"
                                                    value="toAlokasiMitra">Ya</button>
                                                <button type="button" id="close-modalAlokasiMitra"
                                                    class="btn btn-danger btn-sm">Tidak</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-validation">
                            <label for="">STO</label>
                            <select class="form-control {{ $errors->has('sto') ? 'is-invalid' : '' }}" name="sto"
                                id="select_sto">
                                <option value="">-- PILIH STO --</option>
                                <option value="BJA" {{ old('sto') == 'BJA' ? 'selected' : '' }}>BJA</option>
                                <option value="PNL" {{ old('sto') == 'PNL' ? 'selected' : '' }}>PNL</option>
                                <option value="BTJ" {{ old('sto') == 'BTJ' ? 'selected' : '' }}>BTJ</option>
                                <option value="GNH" {{ old('sto') == 'GNH' ? 'selected' : '' }}>GNH</option>
                                <option value="CLL" {{ old('sto') == 'CLL' ? 'selected' : '' }}>CLL</option>
                                <option value="CKW" {{ old('sto') == 'CKW' ? 'selected' : '' }}>CKW</option>
                                <option value="CPT" {{ old('sto') == 'CKP' ? 'selected' : '' }}>CPT</option>
                                <option value="PDL" {{ old('sto') == 'PDL' ? 'selected' : '' }}>PDL</option>
                                <option value="CMI" {{ old('sto') == 'CMI' ? 'selected' : '' }}>CMI</option>
                                <option value="NJG" {{ old('sto') == 'NJG' ? 'selected' : '' }}>NJG</option>
                                <option value="CSA" {{ old('sto') == 'CSA' ? 'selected' : '' }}>CSA</option>
                                <option value="LEM" {{ old('sto') == 'LEM' ? 'selected' : '' }}>LEM</option>
                                <option value="RJW" {{ old('sto') == 'RJW' ? 'selected' : '' }}>RJW</option>
                                <option value="MJY" {{ old('sto') == 'MJY' ? 'selected' : '' }}>MJY</option>
                                <option value="CCL" {{ old('sto') == 'CCL' ? 'selected' : '' }}>CCL</option>
                                <option value="RCK" {{ old('sto') == 'RCK' ? 'selected' : '' }}>RCK</option>
                                <option value="CWD" {{ old('sto') == 'CWD' ? 'selected' : '' }}>CWD</option>
                                <option value="SOR" {{ old('sto') == 'SOR' ? 'selected' : '' }}>SOR</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('sto') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">TIKOR LOP</label>
                            <div class="row">
                                <div class="col">
                                    <!-- Mapbox -->
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <!-- Search Location -->
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="location-input"
                                            aria-label="Cari Lokasi" placeholder="Cari Lokasi">
                                        <button class="btn btn-primary mb-0" type="button" id="search-button">Cari
                                            Lokasi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-validation">
                                        <input type="text" placeholder="Longitude" id="longitude"
                                            class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}"
                                            name="longitude" value="{{ old('longitude') }}">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('longitude') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-validation">
                                        <input type="text" placeholder="Latitude" id="latitude"
                                            class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}"
                                            name="latitude" value="{{ old('latitude') }}">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('latitude') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-validation">
                            <label for="">Lokasi LOP</label>
                            <textarea class="form-control {{ $errors->has('lokasi_lop') ? 'is-invalid' : '' }}" name="lokasi_lop" id="lokasiLop"
                                rows="3" placeholder="Deskripsi Lokasi LOP">{{ old('lokasi_lop') }}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('lokasi_lop') }}
                            </div>
                        </div>
                        <div class="form-group has-validation">
                            <label for="">Keterangan</label>
                            <textarea class="form-control {{ $errors->has('keterangan_lop') ? 'is-invalid' : '' }}" id="keterangan"
                                name="keterangan_lop" rows="3" placeholder="Keterangan LOP">{{ old('keterangan_lop') }}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('keterangan') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submitAction" class="btn btn-primary btn-sm"
                                value="toSurveyRab">Submit</button>
                            <a href="{{ route('lop.list') }}">
                                <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jquery_script')
    <script>
        // Mapbox Section
        const marker = new mapboxgl.Marker();
        const longitude = document.querySelector('#longitude');
        const latitude = document.querySelector('#latitude');

        var lng = 107.615299,
            lat = -6.8868957;

        function coordinateFeature(lng, lat) {
            return {
                center: [lng, lat],
                geometry: {
                    type: 'Point',
                    coordinates: [lng, lat]
                },
                place_name: 'Lat: ' + lat + ' Lng: ' + lng,
                place_type: ['coordinate'],
                properties: {},
                type: 'Feature'
            };
        }

        function add_marker(e) {
            var coordinates = e.lngLat;
            console.log('Lng:', coordinates.lng, 'Lat:', coordinates.lat);
            marker.setLngLat(coordinates).addTo(map);

            longitude.value = coordinates.lng;
            latitude.value = coordinates.lat;

            lng = coordinates.lng;
            lat = coordinates.lat;
        }

        function geocodeLocation(location) {
            var geocodingUrl = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + encodeURIComponent(location) +
                '.json';
            var accessToken =
                'pk.eyJ1IjoiZWxtYXJpYWNoaWkiLCJhIjoiY2w0ZXcyZ3ltMDFpbDNqcXJkbW93NHpyYiJ9.yXen73uhCggvG8NmvExFGw';

            $.get(geocodingUrl, {
                    access_token: accessToken,
                    limit: 1
                })
                .done(function(data) {
                    if (data.features.length > 0) {
                        var coordinates = data.features[0].center;
                        var lng = coordinates[0];
                        var lat = coordinates[1];

                        // Update the map's center and marker position
                        map.setCenter([lng, lat]);
                        marker.setLngLat([lng, lat]);

                        // Update the longitude and latitude input fields
                        longitude.value = lng;
                        latitude.value = lat;
                    } else {
                        // Handle case when no results are found for the entered location
                        console.log('No results found');
                    }
                })
                .fail(function(error) {
                    // Handle any errors that occur during the API request
                    console.log('Error:', error);
                });
        }

        mapboxgl.accessToken =
            "pk.eyJ1Ijoic3l1a3VyemFreSIsImEiOiJjbDVoanF2a2QwYTU3M2NtZDRjc3BiaGdyIn0.bDzvwmyRWBKYqF1M9Hxkkw";

        const map = new mapboxgl.Map({
            container: "map", // container ID
            style: "mapbox://styles/mapbox/streets-v11", // style URL
            center: [lng, lat], // starting position [lng, lat]
            zoom: 15, // starting zoom
            projection: "globe", // display the map as a 3D globe
        });

        map.on("style.load", () => {
            map.setFog({});
        });
        map.on('click', add_marker.bind(this));

        map.addControl(
            new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                trackUserLocation: true,
                showUserHeading: true
            })
        );

        // Search location feature
        $('#search-button').on('click', function() {
            var location = $('#location-input').val();
            geocodeLocation(location);
        });
        // End Mapbox Section


        $(document).ready(function() {
            // Toggle Field Estimasi RAB
            $('#select_tematik_lop').on('change', function() {
                var selectedValue = $(this).val();

                if (selectedValue === "PT 2") {
                    $("#estimasi_rab").show();
                } else {
                    $("#estimasi_rab").hide();
                }
            });

            // Toggle Modal Alokasi Mitra
            $('#select_estimasi_rab').on('change', function() {
                var selectedRAB = $(this).val();
                var namaPermintaan = $("#namaPermintaan").val();
                var namaLop = $("#namaLop").val();

                if (namaLop === '') {
                    $('#namaLop').addClass('is-invalid');
                    alert('Isi Nama LOP terlebih dahulu!');
                } else if (selectedRAB === '<20' && namaLop !== '') {
                    $("#modalAlokasiMitra").modal('show');
                    $("#namaPermintaan-modalAlokasiMitra").text(namaPermintaan);
                    $("#namaLop-modalAlokasiMitra").text(namaLop);
                }
            });

            $("#close-modalAlokasiMitra").on('click', function() {
                $("#modalAlokasiMitra").modal('hide');
            });

            // Add event listener to the form submit event
            document.getElementById('lopForm').addEventListener('submit', function(event) {
                // Get the clicked submit button
                var clickedButton = document.activeElement;

                // Check the value of the clicked button
                if (clickedButton && clickedButton.name === 'submitAction') {
                    var actionValue = clickedButton.value;

                    // Modify the form's action URL based on the clicked button value
                    if (actionValue === 'toAlokasiMitra') {
                        this.action = "{{ route('lop.store', ['toAlokasiMitra' => true]) }}";
                    }
                }
            });
        });
    </script>
@endsection
