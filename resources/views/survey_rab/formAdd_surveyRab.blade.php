@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h3 class="text-black font-bold">Survey + RAB Desk</h3>
                    </div>
                </div>
                <div class="card-body px-5 py-2">
                    <form method="POST" action="{{ route('surveyRab.store') }}">
                        @csrf
                        <input type="hidden" name="lop_id" value="{{ $lop['id'] }}">
                        <div class="form-group">
                            <label for="">Tanggal Permintaan (m-d-Y)</label>
                            <input type="date" name="tanggal_permintaan" class="form-control" id="tanggalPermintaan"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Permintaan</label>
                            <input type="text" class="form-control" name="nama_permintaan" id="namaPermintaan" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama LOP</label>
                            <input type="text" class="form-control" name="nama_lop" id="namaLop" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tematik LOP</label>
                            <input type="text" class="form-control" name="tematik_lop" id="tematikLop" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">STO</label>
                            <input type="text" class="form-control" name="sto" id="sto" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">TIKOR LOP</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="longitude" id="longitude" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="latitude" id="latitude" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi LOP</label>
                            <textarea class="form-control" name="lokasi_lop" id="lokasiLop" rows="3" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">RAB OnDesk</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" name="rab_ondesk">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            @if ($errors->has('keterangan'))
                                <textarea class="form-control is-invalid" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                            @else
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{ route('permintaan.list') }}">
                                <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Get value from stored session
            var tanggalPermintaan = sessionStorage.getItem('tanggalPermintaan');
            var namaPermintaan = sessionStorage.getItem('namaPermintaan');
            var namaLop = sessionStorage.getItem('namaLop');
            var tematikLop = sessionStorage.getItem('tematikLop');
            var estimasiRab = sessionStorage.getItem('estimasiRab');
            var sto = sessionStorage.getItem('sto');
            var longitude = sessionStorage.getItem('longitude');
            var latitude = sessionStorage.getItem('latitude');
            var lokasiLop = sessionStorage.getItem('lokasiLop');
            var keterangan = sessionStorage.getItem('keterangan');

            // Set Value to input field
            $('#tanggalPermintaan').val(tanggalPermintaan);
            $('#namaPermintaan').val(namaPermintaan);
            $('#namaLop').val(namaLop);
            $('#tematikLop').val(tematikLop);
            $('#sto').val(sto);
            $('#longitude').val(longitude);
            $('#latitude').val(latitude);
            $('#lokasiLop').val(lokasiLop);
        });
    </script>
@endsection
