@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h3 class="text-black font-bold">Alokasi Mitra</h3>
                    </div>
                </div>
                <div class="card-body px-5 py-2">
                    <form method="POST" action="{{ route('lop.storeAlokasiMitra') }}">
                        @csrf
                        <input type="hidden" name="lop_id" value="{{ $lop['id'] }}">
                        <div class="form-group">
                            <label for="">Tanggal Permintaan (m-d-Y)</label>
                            <input type="date" name="tanggal_permintaan" class="form-control" id="tanggalPermintaan"
                                readonly value="{{ $lop['tanggal_permintaan'] }}">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Permintaan</label>
                            <input type="text" class="form-control" name="nama_permintaan" id="namaPermintaan"
                                value="{{ $lop['nama_permintaan'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama LOP</label>
                            <input type="text" class="form-control" name="nama_lop" id="namaLop"
                                value="{{ $lop['nama_lop'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tematik LOP</label>
                            <input type="text" class="form-control" name="tematik_lop" id="tematikLop"
                                value="{{ $lop['tematik_lop'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">STO</label>
                            <input type="text" class="form-control" name="sto" id="sto"
                                value="{{ $lop['sto'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">TIKOR LOP (Longitude, Latitude)</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="longitude" id="longitude"
                                            value="{{ $lop['longitude'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="latitude" id="latitude" value="{{ $lop['latitude'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi LOP</label>
                            <textarea class="form-control" name="lokasi_lop" id="lokasiLop" rows="3" readonly>{{ $lop['lokasi_lop'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">RAB OnDesk</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" name="rab_ondesk" value="{{ $lop['rab_ondesk'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" readonly>{{ $lop['keterangan_lop'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Alokasi Mitra</label>
                                <select name="alokasi_mitra" class="form-control">
                                    <option>--- Pilih Mitra ---</option>
                                    <option value="tes1">Value1</option>
                                    <option value="tes2">Value2</option>
                                </select>
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
