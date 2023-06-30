@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal3" class="form-control-label">Tanggal Permintaan</label>
                                    <input class="form-control" type="date" id="tanggal3"
                                        value="{{ $lop->tanggal_permintaan }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mitra3" class="form-control-label">Nama Mitra</label>
                                    <input class="form-control" type="text" value="{{ $lop->user->first_name }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input5" class="form-control-label">Nama
                                        Permintaan</label>
                                    <input class="form-control" type="text"
                                        value="{{ '[' . $lop->listPermintaan->tematik_permintaan . '] ' . $lop->listPermintaan->nama_permintaan }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input6" class="form-control-label">Nama LOP</label>
                                    <input class="form-control" type="text" value="{{ $lop->nama_lop }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input6" class="form-control-label">Tematik
                                        LOP</label>
                                    <input class="form-control" type="text" value="{{ $lop->tematik_lop }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input6" class="form-control-label">STO</label>
                                    <input class="form-control" type="text" value="{{ $lop->sto }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('lop.go-live.store', ['lop_id' => $lop->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <hr class="horizontal dark">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body px-0 pt-0 pb-2">
                                            <div class="table-responsive p-0">
                                                <table class="table align-items-center justify-content-center mb-0">
                                                    <tbody>
                                                        @if (Auth::user()->hasRole('optima'))
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check mb-3">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="isNeed" value="true"
                                                                            {{ ($goLive && $goLive->exists && $goLive->isNeed == true) ? 'checked' : '' }}
                                                                            {{ empty($goLive) ? '' : 'disabled' }}>
                                                                        <label class="custom-control-label"
                                                                            for="customRadio1">GoLive ODP</label>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <div class="form-check mb-3">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="isNeed" value="false"
                                                                            {{ ($goLive && $goLive->exists && $goLive->isNeed == false) ? 'checked' : '' }}
                                                                            {{ empty($goLive) ? '' : 'disabled' }}>
                                                                        <label class="custom-control-label"
                                                                            for="customRadio1">Tanpa GoLive ODP</label>
                                                                    </div>
                                                                </td>
                                                                <td colspan="2">
                                                                    <div class="form-group has-validation">
                                                                        <textarea name="keterangan_withoutGoLive" class="form-control {{ $errors->has('keterangan_withoutGoLive') ? 'is-invalid' : '' }}" cols="30" rows="2"
                                                                            placeholder="Keterangan Tanpa GoLive" {{ empty($goLive) ? '' : 'disabled' }}>{{ empty($goLive) ? '' : $goLive->keterangan_withoutGolive }}</textarea>
                                                                        <div class="invalid-feedback">
                                                                            {{ $errors->first('keterangan_withoutGoLive') }}
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @endif
                                                        <!-- Validasi -->
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2">
                                                                    <div class="my-auto">
                                                                        <h6 class="mb-0 text-sm">Validasi</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <span
                                                                        class="me-2 text-xs font-weight-bold">{{ empty($validasi) ? '0%' : '100%' }}</span>
                                                                    <div>
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-gradient-info"
                                                                                role="progressbar"
                                                                                aria-valuenow="{{ empty($validasi) ? '0' : '100' }}"
                                                                                aria-valuemin="0" aria-valuemax="100"
                                                                                style="width: {{ empty($validasi) ? '0%' : '100%' }};">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td colspan="2">
                                                                <textarea name="keterangan_validasi" class="form-control" cols="30" rows="2"
                                                                    placeholder="Keterangan Validasi" {{ empty($validasi) ? '' : 'disabled' }}>{{ empty($validasi) ? '' : $validasi->keterangan_validasi }}</textarea>
                                                            </td>
                                                        </tr>

                                                        <!-- Konfirmasi Mitra -->
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2">
                                                                    <div class="my-auto">
                                                                        <h6 class="mb-0 text-sm">Konfirmasi Mitra</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <span
                                                                        class="me-2 text-xs font-weight-bold">{{ empty($konfirmasiMitra) ? '0%' : '100%' }}</span>
                                                                    <div>
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-gradient-info"
                                                                                role="progressbar"
                                                                                aria-valuenow="{{ empty($konfirmasiMitra) ? '0' : '100' }}"
                                                                                aria-valuemin="0" aria-valuemax="100"
                                                                                style="width: {{ empty($konfirmasiMitra) ? '0%' : '100%' }};">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td colspan="2">
                                                                <textarea name="keterangan_konfirmasi_mitra" class="form-control" cols="30" rows="2"
                                                                    placeholder="Keterangan Konfirmasi Mitra" {{ empty($validasi) ? 'disabled' : '' }}
                                                                    {{ empty($konfirmasiMitra) ? '' : 'disabled' }}>{{ empty($konfirmasiMitra) ? '' : $konfirmasiMitra->keterangan_konfirmasi_mitra }}</textarea>
                                                            </td>
                                                        </tr>

                                                        <!-- Connectivity -->
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2">
                                                                    <div class="my-auto">
                                                                        <h6 class="mb-0 text-sm">Connectivity</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <span
                                                                        class="me-2 text-xs font-weight-bold">{{ empty($connectivity) ? '0%' : '100%' }}</span>
                                                                    <div>
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-gradient-info"
                                                                                role="progressbar"
                                                                                aria-valuenow="{{ empty($connectivity) ? '0' : '100' }}"
                                                                                aria-valuemin="0" aria-valuemax="100"
                                                                                style="width: {{ empty($connectivity) ? '0%' : '100%' }};">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td colspan="2">
                                                                <textarea name="keterangan_connectivity" class="form-control" cols="30" rows="2"
                                                                    placeholder="Keterangan Connectivity" {{ empty($konfirmasiMitra) ? 'disabled' : '' }}
                                                                    {{ empty($connectivity) ? '' : 'disabled' }}>{{ empty($connectivity) ? '' : $connectivity->keterangan_connectivity }}</textarea>
                                                            </td>
                                                        </tr>

                                                        <!-- Go Live ODP -->
                                                        @if (($goLive->exists && $goLive->isNeed == true) ? 'checked' : '')
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex px-2">
                                                                        <div class="my-auto">
                                                                            <h6 class="mb-0 text-sm">GoLive ODP</h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <!-- 0% -->
                                                                    @if ($goLive->exists && $goLive->isNeed == true && $goLive->evidence_golive == null) 
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-center">
                                                                        <span
                                                                            class="me-2 text-xs font-weight-bold">0%</span>
                                                                        <div>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-gradient-info"
                                                                                    role="progressbar" aria-valuenow="0"
                                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                                    style="width: 0%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- 100% -->
                                                                    @elseif ($goLive->exists && $goLive->isNeed == true && $goLive->evidence_golive !== null)
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-center">
                                                                        <span
                                                                            class="me-2 text-xs font-weight-bold">100%</span>
                                                                        <div>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-gradient-info"
                                                                                    role="progressbar" aria-valuenow="100"
                                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                                    style="width: 100%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($goLive->exists && $goLive->evidence_golive !== null)
                                                                        <div class="d-flex flex-row align-items-center">
                                                                            <a href="{{ asset('storage/uploads/evidence_golive/' . $goLive->evidence_golive) }}"
                                                                                target="_blank">
                                                                                <span
                                                                                    class="me-2 text-xs font-weight-bold">{{ $goLive->evidence_golive }}</span>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div
                                                                            class="d-flex flex-row align-items-center px-2">
                                                                            <input type="file" name="evidence_golive"
                                                                                class="form-control form-control-sm"
                                                                                {{ empty($connectivity) ? 'disabled' : '' }}>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <textarea name="keterangan_withGolive" class="form-control" cols="30" rows="2"
                                                                        placeholder="Keterangan GoLive" {{ $goLive->exists && $goLive->isNeed == false ? 'disabled' : '' }} {{ empty($connectivity) ? 'disabled' : '' }} {{ $goLive->exists && $goLive->evidence_golive !== null ? 'disabled' : ''}}></textarea>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success btn-sm ms-auto" type="submit">Update Status</button>
                                    <a href="{{ route('lop.list') }}">
                                        <button class="btn btn-danger btn-sm ms-auto" type="button">Cancel</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
