@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h3 class="text-black font-bold">Form Alokasi Mitra</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="{{ route('lop.storeAlokasiMitra') }}" method="post">
                                @csrf
                                <input type="hidden" name="lop_id" value="{{ $lop->id }}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Tanggal Permintaan (m-d-Y)</label>
                                        <input type="date" name="tanggal_permintaan" class="form-control"
                                            id="tanggalPermintaan" readonly value="{{ $lop->tanggal_permintaan }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nama Permintaan</label>
                                        <input type="text" class="form-control" name="nama_permintaan"
                                            id="namaPermintaan"
                                            value="{{ '[' . $lop->listPermintaan->tematik_permintaan . '] ' . $lop->listPermintaan->nama_permintaan }}"
                                            value="{{ $lop['nama_permintaan'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nama LOP</label>
                                        <input type="text" class="form-control" name="nama_lop" id="namaLop"
                                            value="{{ $lop['nama_lop'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Tematik LOP</label>
                                        <input type="text" class="form-control" name="tematik_lop" id="tematikLop"
                                            value="{{ $lop['tematik_lop'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">STO</label>
                                        <input type="text" class="form-control" name="sto" id="sto"
                                            value="{{ $lop['sto'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">TIKOR LOP (Longitude, Latitude)</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="longitude"
                                                        id="longitude" value="{{ $lop['longitude'] }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="latitude"
                                                        id="latitude" value="{{ $lop['latitude'] }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Lokasi LOP</label>
                                        <textarea class="form-control" name="lokasi_lop" id="lokasiLop" rows="3" readonly>{{ $lop['lokasi_lop'] }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" readonly>{{ $lop['keterangan_lop'] }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-validation">
                                        <label for="">Alokasi Mitra</label>
                                        <select name="mitra_id" class="form-control {{ $errors->has('alokasi_mitra') ? 'is-invalid' : '' }}">
                                            <option value="">--- Pilih Mitra ---</option>
                                            @foreach($mitra as $m)
                                            <option value="{{ $m->id }}">{{$m->username}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('alokasi_mitra') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-sm ms-auto">Submit</button>
                                    <a href="{{ route('lop.list') }}">
                                        <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-body pt-0">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mitra</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            LOP Done</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            LOP in Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-left">
                                            <div class="d-flex px-2"> <span
                                                    class="text-secondary text-xs font-weight-bold">PT. TA</span>
                                            </div>
                                        </td>
                                        <td class="align-middle text-left"><span
                                                class="text-secondary text-xs font-weight-bold">12</span></td>
                                        <td class="align-middle text-left"><span
                                                class="text-secondary text-xs font-weight-bold">3</span></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left">
                                            <div class="d-flex px-2"> <span
                                                    class="text-secondary text-xs font-weight-bold">KOPEG</span>
                                            </div>
                                        </td>
                                        <td class="align-middle text-left"><span
                                                class="text-secondary text-xs font-weight-bold">3</span></td>
                                        <td class="align-middle text-left"><span
                                                class="text-secondary text-xs font-weight-bold">4</span></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left">
                                            <div class="d-flex px-2"> <span
                                                    class="text-secondary text-xs font-weight-bold">WMT</span>
                                            </div>
                                        </td>
                                        <td class="align-middle text-left"><span
                                                class="text-secondary text-xs font-weight-bold">2</span></td>
                                        <td class="align-middle text-left"><span
                                                class="text-secondary text-xs font-weight-bold">1</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
