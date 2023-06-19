@extends('layouts.dashboard')
@section('content')
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
                                <input class="form-control" type="text" value="{{ $lop->alokasi_mitra }}" disabled>
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
                <form action="{{ route('lop.konstruksi.store', ['lop_id' => $lop->id]) }}" method="post"
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
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div class="my-auto">
                                                                    <h6 class="mb-0 text-sm">Persiapan</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex flex-column">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <span
                                                                        class="me-2 text-xs font-weight-bold">{{ empty($persiapan) ? '0%' : '100%' }}</span>
                                                                    <div>
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-gradient-info"
                                                                                role="progressbar"
                                                                                aria-valuenow="{{ empty($persiapan) ? '0' : '100' }}"
                                                                                aria-valuemin="0" aria-valuemax="100"
                                                                                style="width: {{ empty($persiapan) ? '0%' : '100%' }};">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-row align-items-center px-2">
                                                                <input type="file" name="evidence_persiapan"
                                                                    class="form-control form-control-sm"
                                                                    {{ empty($persiapan) ? '' : 'disabled' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_persiapan" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Persiapan (Opsional)" {{ empty($persiapan) ? '' : 'disabled' }}>{{ empty($persiapan) ? '' : $lop->persiapan->keterangan_persiapan }}</textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div class="my-auto">
                                                                    <h6 class="mb-0 text-sm">Instalasi</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <span
                                                                    class="me-2 text-xs font-weight-bold">{{ empty($instalasi) ? '0%' : '100%' }}</span>
                                                                <div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-gradient-info"
                                                                            role="progressbar"
                                                                            aria-valuenow="{{ empty($instalasi) ? '0' : '100' }}"
                                                                            aria-valuemin="0" aria-valuemax="100"
                                                                            style="width: {{ empty($instalasi) ? '0%' : '100%' }};">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-row align-items-center px-2">
                                                                <input type="file" name="evidence_instalasi"
                                                                    class="form-control form-control-sm"
                                                                    {{ empty($persiapan) ? 'disabled' : '' }}
                                                                    {{ empty($instalasi) ? '' : 'disabled' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_instalasi" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Instalasi (Opsional)" {{ empty($persiapan) ? 'disabled' : '' }}
                                                                {{ empty($instalasi) ? '' : 'disabled' }}>{{ empty($instalasi) ? '' : $lop->instalasi->keterangan_instalasi }}</textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div class="my-auto">
                                                                    <h6 class="mb-0 text-sm">Selesai Fisik</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <span
                                                                    class="me-2 text-xs font-weight-bold">{{ empty($selesaiFisik) ? '0%' : '100%' }}</span>
                                                                <div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-gradient-info"
                                                                            role="progressbar"
                                                                            aria-valuenow="{{ empty($selesaiFisik) ? '0' : '100' }}"
                                                                            aria-valuemin="0" aria-valuemax="100"
                                                                            style="width: {{ empty($selesaiFisik) ? '0%' : '100%' }};">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-row align-items-center px-2">
                                                                <input type="file" name="evidence_selesai"
                                                                    class="form-control form-control-sm"
                                                                    {{ empty($instalasi) ? 'disabled' : '' }}
                                                                    {{ empty($selesaiFisik) ? '' : 'disabled' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_selesai" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Selesai Fisik (Opsional)" {{ empty($instalasi) ? 'disabled' : '' }}
                                                                {{ empty($selesaiFisik) ? '' : 'disabled' }}>{{ empty($selesaiFisik) ? '' : $lop->selesaiFisik->keterangan_selesai }}</textarea>
                                                        </td>
                                                    </tr>
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
@endsection
