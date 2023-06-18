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
                <form action="" method="post" enctype="multipart/form-data">
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
                                                            <div class="d-flex align-items-center justify-content-center">
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
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-row align-items-center px-2">
                                                                <div class="input-group-append">
                                                                    <input id="evidence-persiapan-upload" type="file" style="display:none" name="evidence_persiapan"/>
                                                                    <button class="btn btn-primary btn-sm ms-auto"
                                                                        onclick="document.getElementById('evidence-persiapan-upload').click()"
                                                                        {{ empty($persiapan) ? '' : 'disabled' }}>
                                                                        Evidence Persiapan
                                                                    </button>
                                                                </div>
                                                                <p class="text-success text-xs"
                                                                    id="evidence-persiapan-notif" style="display: none;">
                                                                    Berhasil upload </p>
                                                            </div>
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
                                                                <div class="input-group-append">
                                                                    <input id="evidence-instalasi-upload" type="file"
                                                                        name="evidence_instalasi" style="display:none" />
                                                                    <button class="btn btn-primary btn-sm ms-auto"
                                                                        onclick="document.getElementById('evidence-instalasi-upload').click()"
                                                                        {{ empty($persiapan) ? 'disabled' : '' }}>
                                                                        Evidence instalasi
                                                                    </button>
                                                                </div>
                                                                <p class="text-success text-xs"
                                                                    id="evidence-instalasi-notif" style="display: none;">
                                                                    Berhasil upload </p>
                                                            </div>
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
                                                                <div class="input-group-append">
                                                                    <input id="evidence-selesai-upload" type="file"
                                                                        name="evidence_selesai" style="display:none"/>
                                                                    <button class="btn btn-primary btn-sm ms-auto"
                                                                        onclick="document.getElementById('evidence-selesai-upload').click()"
                                                                        {{ empty($instalasi) ? 'disabled' : '' }}>
                                                                        Evidence Selesai Fisik
                                                                    </button>
                                                                </div>
                                                                <p class="text-success text-xs"
                                                                    id="evidence-selesai-notif" style="display: none;">
                                                                    Berhasil upload </p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-sm ms-auto" type="submit">Update Status</button>
                                <button class="btn btn-danger btn-sm ms-auto">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('#evidence-persiapan-upload').on('change', function() {
                if ($(this).val()) {
                    // A file has been selected
                    $('#evidence-persiapan-notif').show();
                } else {
                    // No file selected
                    $('#evidence-persiapan-notif').hide();
                }
            });

            $('#evidence-instalasi-upload').on('change', function() {
                if ($(this).val()) {
                    // A file has been selected
                    $('#evidence-instalasi-notif').show();
                } else {
                    // No file selected
                    $('#evidence-instalasi-notif').hide();
                }
            });

            $('#evidence-selesai-upload').on('change', function() {
                if ($(this).val()) {
                    // A file has been selected
                    $('#evidence-selesai-notif').show();
                } else {
                    // No file selected
                    $('#evidence-selesai-notif').hide();
                }
            });
        });
    </script>
@endsection
