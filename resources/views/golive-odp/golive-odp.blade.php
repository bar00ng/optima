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
                                    <input class="form-control" type="date" id="tanggal3" value="{{ $lop->tanggal_permintaan }}" disabled>
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
                                    <input class="form-control" type="text" value="{{ '[' . $lop->listPermintaan->tematik_permintaan . '] ' . $lop->listPermintaan->nama_permintaan }}" disabled>
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
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="flexSwitchCheckDefault" checked="">
                                                                <label class="form-check-label"
                                                                    for="flexSwitchCheckDefault">GoLive ODP</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div class="my-auto">
                                                                    <h6 class="mb-0 text-sm">Validasi</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <span class="me-2 text-xs font-weight-bold">60%</span>
                                                                <div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-gradient-info"
                                                                            role="progressbar" aria-valuenow="60"
                                                                            aria-valuemin="0" aria-valuemax="100"
                                                                            style="width: 60%;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div class="my-auto">
                                                                    <h6 class="mb-0 text-sm">Konfirmasi Mitra</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <span class="me-2 text-xs font-weight-bold">60%</span>
                                                                <div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-gradient-info"
                                                                            role="progressbar" aria-valuenow="60"
                                                                            aria-valuemin="0" aria-valuemax="100"
                                                                            style="width: 60%;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div class="my-auto">
                                                                    <h6 class="mb-0 text-sm">Connectivity</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <span class="me-2 text-xs font-weight-bold">60%</span>
                                                                <div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-gradient-info"
                                                                            role="progressbar" aria-valuenow="60"
                                                                            aria-valuemin="0" aria-valuemax="100"
                                                                            style="width: 60%;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div class="my-auto">
                                                                    <h6 class="mb-0 text-sm">GoLive ODP</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <span class="me-2 text-xs font-weight-bold">60%</span>
                                                                <div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-gradient-info"
                                                                            role="progressbar" aria-valuenow="60"
                                                                            aria-valuemin="0" aria-valuemax="100"
                                                                            style="width: 60%;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-primary btn-sm ms-auto">Evidence
                                                                        GoLive</button>
                                                                </div>
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
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-sm ms-auto">Update Status</button>
                                <button class="btn btn-danger btn-sm ms-auto">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
