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
                                <input class="form-control" type="text" value="{{ $lop->user->first_name }}" disabled>
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
                                                                    @if(Auth::user()->hasRole('optima'))
                                                                        <input type="number" name="persiapan_progress" value="{{ !empty($persiapan) ? $persiapan->persiapan_progress : 0 }}" class="form-control form-control-sm" style="width: 60px; margin-right: 10px;">
                                                                    @else
                                                                        <span
                                                                            class="me-2 text-xs font-weight-bold">{{ !empty($persiapan) ? $persiapan->persiapan_progress.'%' : '0%' }}</span>
                                                                    @endif
                                                                    <div>
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-gradient-info"
                                                                                role="progressbar" aria-valuenow="{{ !empty($persiapan) ? $persiapan->persiapan_progress : 0 }}"
                                                                                aria-valuemin="0" aria-valuemax="100"
                                                                                style="width: {{ !empty($persiapan) ? $persiapan->persiapan_progress : 0 }}%;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <!-- Check apakah ada evidence persiapan -->
                                                            @if ($persiapan !== null)
                                                                <!-- Jika ada, check apakah ada evidence_persiapan -->
                                                                @if (!empty($persiapan->evidence_persiapan))
                                                                    <!-- Jika ada, check apakah approve/reject/belum ada action -->
                                                                    <!-- Jika sudah di approve -->        
                                                                    @if ($persiapan->isApproved === 1)
                                                                        <a href="{{ asset('storage/uploads/evidence_persiapan/' . $persiapan->evidence_persiapan) }}"
                                                                            target="_blank">
                                                                            <span
                                                                                class="me-2 text-xs font-weight-bold">{{ $persiapan->evidence_persiapan }}</span>
                                                                            <span class="me-2 text-xs fst-italic text-success">(Disetujui)</span>
                                                                        </a>
                                                                    <!-- Jika Direject -->
                                                                    @elseif ($persiapan->isApproved === 0)
                                                                        <div class="d-flex flex-column align-items-center px-2 has-validation">
                                                                            <input type="file" name="evidence_persiapan"
                                                                                class="form-control form-control-sm is-invalid">
                                                                            <div class="invalid-feedback text-xs fst-italic">
                                                                                Evidence ditolak. Silahkan upload ulang!
                                                                            </div>
                                                                        </div> 
                                                                    <!-- Jika belum di approve/reject -->
                                                                    @elseif ($persiapan->isApproved === null)
                                                                        <a href="{{ asset('storage/uploads/evidence_persiapan/' . $persiapan->evidence_persiapan) }}"
                                                                            target="_blank">
                                                                            <span
                                                                                class="me-2 text-xs font-weight-bold">{{ $persiapan->evidence_persiapan }}</span>
                                                                            <span class="me-2 text-xs fst-italic">(Menunggu Persetujuan)</span>
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    <!-- Jika tidak ada, upload file -->
                                                                    <div class="d-flex flex-row align-items-center px-2">
                                                                        <input type="file" name="evidence_persiapan"
                                                                            class="form-control form-control-sm"
                                                                            {{ empty($persiapan) ? '' : 'disabled' }}>
                                                                    </div>    
                                                                @endif
                                                            @else
                                                                <!-- Jika tidak, input upload file muncul -->
                                                                <div class="d-flex flex-row align-items-center px-2">
                                                                    <input type="file" name="evidence_persiapan"
                                                                        class="form-control form-control-sm"
                                                                        {{ empty($persiapan) ? '' : 'disabled' }}>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_persiapan" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Persiapan (Opsional)" {{ empty($persiapan) ? '' : 'disabled' }}>{{ empty($persiapan) ? '' : $lop->persiapan->keterangan_persiapan }}</textarea>
                                                        </td>
                                                        <td>
                                                            @if (!empty($persiapan))
                                                                @if ($persiapan->isApproved === null)
                                                                    @if (Auth::user()->hasRole('mitra'))
                                                                        <span
                                                                            class="me-2 text-sm text-secondary font-weight-bold">Menunggu
                                                                            Approval</span>
                                                                    @elseif (Auth::user()->hasRole('optima'))
                                                                        <div class="d-flex align-items-center">
                                                                            <form action="#" method="post"
                                                                                style="margin-right: 5px; display:hidden;"
                                                                                id="form-approve-persiapan">
                                                                            </form>

                                                                            <form
                                                                                action="{{ route('lop.konstruksi.approve.persiapan', ['approved' => 'true', 'persiapan_id' => $persiapan->id]) }}"
                                                                                method="post" style="margin-right: 5px"
                                                                                id="form-approve-persiapan">
                                                                                @method('PATCH')
                                                                                @csrf
                                                                                <button type="button"
                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="Approve Persiapan"
                                                                                    data-container="body"
                                                                                    data-animation="true"
                                                                                    id="submit-approve-persiapan">&#10003;</button>
                                                                            </form>

                                                                            <form
                                                                                action="{{ route('lop.konstruksi.approve.persiapan', ['approved' => 'false', 'persiapan_id' => $persiapan->id]) }}"
                                                                                method="post" style="margin-right: 5px"
                                                                                id="form-reject-persiapan">
                                                                                @method('PATCH')
                                                                                @csrf
                                                                                <button type="button"
                                                                                    class="btn btn-outline-danger btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="Reject Persiapan"
                                                                                    data-container="body"
                                                                                    data-animation="true"
                                                                                    id="submit-reject-persiapan">&#10007;</button>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                @elseif($persiapan->isApproved !== null)
                                                                    @if ($persiapan->isApproved == false)
                                                                        <span
                                                                            class="me-2 text-sm text-danger font-weight-bold">Ditolak</span>
                                                                    @elseif($persiapan->isApproved == true)
                                                                        <span
                                                                            class="me-2 text-sm text-success font-weight-bold">Disetujui</span>
                                                                    @else
                                                                        <span
                                                                            class="me-2 text-sm text-secondary font-weight-bold">Menunggu
                                                                            Approval</span>
                                                                    @endif
                                                                @endif
                                                            @endif
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
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    @if(Auth::user()->hasRole('optima'))
                                                                        <input type="number" name="instalasi_progress" value="{{ !empty($instalasi) ? $instalasi->instalasi_progress : 0 }}" class="form-control form-control-sm" style="width: 60px; margin-right: 10px;">
                                                                    @else
                                                                        <span
                                                                            class="me-2 text-xs font-weight-bold">{{ !empty($instalasi) ? $instalasi->instalasi_progress.'%' : '0%' }}</span>
                                                                    @endif
                                                                    <div>
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-gradient-info"
                                                                                role="progressbar" aria-valuenow="{{ !empty($instalasi) ? $instalasi->instalasi_progress : 0 }}"
                                                                                aria-valuemin="0" aria-valuemax="100"
                                                                                style="width: {{ !empty($instalasi) ? $instalasi->instalasi_progress : 0 }}%;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <!-- Check apakah ada evidence -->
                                                            @if ($instalasi !== null)
                                                                <!-- Jika ada, check apakah ada evidence_instalasi -->
                                                                @if (!empty($instalasi->evidence_instalasi))
                                                                    <!-- Jika ada, check apakah approve/reject/belum ada action -->
                                                                    <!-- Jika sudah di approve -->        
                                                                    @if ($instalasi->isApproved === 1)
                                                                        <a href="{{ asset('storage/uploads/evidence_instalasi/' . $instalasi->evidence_instalasi) }}"
                                                                            target="_blank">
                                                                            <span
                                                                                class="me-2 text-xs font-weight-bold">{{ $instalasi->evidence_instalasi }}</span>
                                                                            <span class="me-2 text-xs fst-italic text-success">(Disetujui)</span>
                                                                        </a>
                                                                    <!-- Jika Direject -->
                                                                    @elseif ($instalasi->isApproved === 0)
                                                                        <div class="d-flex flex-column align-items-center px-2 has-validation">
                                                                            <input type="file" name="evidence_instalasi"
                                                                                class="form-control form-control-sm is-invalid">
                                                                            <div class="invalid-feedback text-xs fst-italic">
                                                                                Evidence ditolak. Silahkan upload ulang!
                                                                            </div>
                                                                        </div> 
                                                                    <!-- Jika belum di approve/reject -->
                                                                    @elseif ($instalasi->isApproved === null)
                                                                        <a href="{{ asset('storage/uploads/evidence_instalasi/' . $instalasi->evidence_instalasi) }}"
                                                                            target="_blank">
                                                                            <span
                                                                                class="me-2 text-xs font-weight-bold">{{ $instalasi->evidence_instalasi }}</span>
                                                                            <span class="me-2 text-xs fst-italic">(Menunggu Persetujuan)</span>
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    <!-- Jika tidak ada, upload file -->
                                                                    <div class="d-flex flex-row align-items-center px-2">
                                                                        <input type="file" name="evidence_persiapan"
                                                                            class="form-control form-control-sm"
                                                                            {{ empty($persiapan) ? '' : 'disabled' }}>
                                                                    </div>    
                                                                @endif
                                                            @else
                                                                <!-- Jika tidak, input upload file muncul -->
                                                                <div class="d-flex flex-row align-items-center px-2">
                                                                    <input type="file" name="evidence_instalasi"
                                                                        class="form-control form-control-sm"
                                                                        {{ empty($persiapan) || $persiapan->isApproved == false ? 'disabled' : '' }}
                                                                        {{ empty($instalasi) ? '' : 'disabled' }}>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_instalasi" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Instalasi (Opsional)"
                                                                {{ empty($persiapan) || $persiapan->isApproved == false ? 'disabled' : '' }}
                                                                {{ empty($instalasi) ? '' : 'disabled' }}>{{ empty($instalasi) ? '' : $lop->instalasi->keterangan_instalasi }}</textarea>
                                                        </td>
                                                        <td>
                                                            @if (!empty($instalasi))
                                                                @if ($instalasi->isApproved === null)
                                                                    @if (Auth::user()->hasRole('mitra'))
                                                                        <span
                                                                            class="me-2 text-sm text-secondary font-weight-bold">Menunggu
                                                                            Approval</span>
                                                                    @elseif (Auth::user()->hasRole('optima'))
                                                                        <div class="d-flex align-items-center">
                                                                            <form action="#" method="post"
                                                                                style="margin-right: 5px; display:hidden;">
                                                                            </form>

                                                                            <form
                                                                                action="{{ route('lop.konstruksi.approve.instalasi', ['approved' => 'true', 'instalasi_id' => $instalasi->id]) }}"
                                                                                method="post" style="margin-right: 5px"
                                                                                id="form-approve-instalasi">
                                                                                @method('PATCH')
                                                                                @csrf
                                                                                <button type="button"
                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="Approve Instalasi"
                                                                                    data-container="body"
                                                                                    data-animation="true"
                                                                                    id="submit-approve-instalasi">&#10003;</button>
                                                                            </form>

                                                                            <form
                                                                                action="{{ route('lop.konstruksi.approve.instalasi', ['approved' => 'false', 'instalasi_id' => $instalasi->id]) }}"
                                                                                method="post" style="margin-right: 5px"
                                                                                id="form-reject-instalasi">
                                                                                @method('PATCH')
                                                                                @csrf
                                                                                <button type="button"
                                                                                    class="btn btn-outline-danger btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="Reject Instalasi"
                                                                                    data-container="body"
                                                                                    data-animation="true"
                                                                                    id="submit-reject-instalasi">&#10007;</button>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                @elseif($instalasi->isApproved !== null)
                                                                    @if ($instalasi->isApproved == false)
                                                                        <span
                                                                            class="me-2 text-sm text-danger font-weight-bold">Ditolak</span>
                                                                    @elseif($instalasi->isApproved == true)
                                                                        <span
                                                                            class="me-2 text-sm text-success font-weight-bold">Disetujui</span>
                                                                    @else
                                                                        <span
                                                                            class="me-2 text-sm text-secondary font-weight-bold">Menunggu
                                                                            Approval</span>
                                                                    @endif
                                                                @endif
                                                            @endif
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
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    @if (Auth::user()->hasRole('optima'))
                                                                        <input type="number" name="selesai_fisik_progress" value="{{ !empty($selesaiFisik) ? $selesaiFisik->selesai_fisik_progress : 0 }}" class="form-control form-control-sm" style="width: 60px; margin-right: 10px;">
                                                                    @else
                                                                        <span
                                                                            class="me-2 text-xs font-weight-bold">{{ !empty($selesaiFisik) ? $selesaiFisik->selesai_fisik_progress.'%' : '0%' }}</span>
                                                                    @endif
                                                                    <div>
                                                                        <div class="progress">
                                                                            <div class="progress-bar bg-gradient-info"
                                                                                role="progressbar" aria-valuenow="{{ !empty($selesaiFisik) ? $selesaiFisik->selesai_fisik_progress : 0 }}"
                                                                                aria-valuemin="0" aria-valuemax="100"
                                                                                style="width: {{ !empty($selesaiFisik) ? $selesaiFisik->selesai_fisik_progress : 0 }}%;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <!-- Check apakah ada evidence -->
                                                            @if ($selesaiFisik !== null)
                                                                <!-- Jika ada, check apakah ada evidence_selesai -->
                                                                @if (!empty($selesaiFisik->evidence_selesai))
                                                                    <!-- Jika ada, check apakah approve/reject/belum ada action -->
                                                                    <!-- Jika sudah di approve -->        
                                                                    @if ($selesaiFisik->isApproved === 1)
                                                                        <a href="{{ asset('storage/uploads/evidence_selesai/' . $selesaiFisik->evidence_selesai) }}"
                                                                            target="_blank">
                                                                            <span
                                                                                class="me-2 text-xs font-weight-bold">{{ $selesaiFisik->evidence_selesai }}</span>
                                                                            <span class="me-2 text-xs fst-italic text-success">(Disetujui)</span>
                                                                        </a>
                                                                    <!-- Jika Direject -->
                                                                    @elseif ($selesaiFisik->isApproved === 0)
                                                                        <div class="d-flex flex-column align-items-center px-2 has-validation">
                                                                            <input type="file" name="evidence_selesai"
                                                                                class="form-control form-control-sm is-invalid">
                                                                            <div class="invalid-feedback text-xs fst-italic">
                                                                                Evidence ditolak. Silahkan upload ulang!
                                                                            </div>
                                                                        </div> 
                                                                    <!-- Jika belum di approve/reject -->
                                                                    @elseif ($selesaiFisik->isApproved === null)
                                                                        <a href="{{ asset('storage/uploads/evidence_selesai/' . $selesaiFisik->evidence_selesai) }}"
                                                                            target="_blank">
                                                                            <span
                                                                                class="me-2 text-xs font-weight-bold">{{ $selesaiFisik->evidence_selesai }}</span>
                                                                            <span class="me-2 text-xs fst-italic">(Menunggu Persetujuan)</span>
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    <!-- Jika tidak ada, upload file -->
                                                                    <div class="d-flex flex-row align-items-center px-2">
                                                                        <input type="file" name="evidence_selesai"
                                                                            class="form-control form-control-sm"
                                                                            {{ empty($instalasi) ? '' : 'disabled' }}>
                                                                    </div>    
                                                                @endif
                                                            @else
                                                                <!-- Jika tidak, input upload file muncul -->
                                                                <div class="d-flex flex-row align-items-center px-2">
                                                                    <input type="file" name="evidence_instalasi"
                                                                        class="form-control form-control-sm"
                                                                        {{ empty($instalasi) || $instalasi->isApproved === 0 ? 'disabled' : '' }}
                                                                        {{ empty($instalasi) ? '' : 'disabled' }}>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_selesai" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Selesai Fisik (Opsional)"
                                                                {{ empty($instalasi) || $instalasi->isApproved == false ? 'disabled' : '' }}
                                                                {{ empty($selesaiFisik) ? '' : 'disabled' }}>{{ empty($selesaiFisik) ? '' : $lop->selesaiFisik->keterangan_selesai }}</textarea>
                                                        </td>
                                                        <td>
                                                            @if (!empty($selesaiFisik))
                                                                @if ($selesaiFisik->isApproved === null)
                                                                    @if (Auth::user()->hasRole('mitra'))
                                                                        <span
                                                                            class="me-2 text-sm text-secondary font-weight-bold">Menunggu
                                                                            Approval</span>
                                                                    @elseif (Auth::user()->hasRole('optima'))
                                                                        <div class="d-flex align-items-center">
                                                                            <form action="#" method="post"
                                                                                style="margin-right: 5px; display:hidden;"
                                                                                id="form-approve-persiapan">
                                                                            </form>

                                                                            <form
                                                                                action="{{ route('lop.konstruksi.approve.selesaiFisik', ['approved' => 'true', 'selesai_fisik_id' => $selesaiFisik->id]) }}"
                                                                                method="post" style="margin-right: 5px"
                                                                                id="form-approve-selesaiFisik">
                                                                                @method('PATCH')
                                                                                @csrf
                                                                                <button type="input"
                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="Approve Selesai Fisik"
                                                                                    data-container="body"
                                                                                    data-animation="true"
                                                                                    id="submit-approve-selesaiFisik">&#10003;</button>
                                                                            </form>

                                                                            <form
                                                                                action="{{ route('lop.konstruksi.approve.selesaiFisik', ['approved' => 'false', 'selesai_fisik_id' => $selesaiFisik->id]) }}"
                                                                                method="post" style="margin-right: 5px"
                                                                                id="form-reject-selesaiFisik">
                                                                                @method('PATCH')
                                                                                @csrf
                                                                                <button type="button"
                                                                                    class="btn btn-outline-danger btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="Reject Selesai Fisik"
                                                                                    data-container="body"
                                                                                    data-animation="true"
                                                                                    id="submit-reject-selesaiFisik">&#10007;</button>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                @elseif($selesaiFisik->isApproved !== null)
                                                                    @if ($selesaiFisik->isApproved == false)
                                                                        <span
                                                                            class="me-2 text-sm text-danger font-weight-bold">Ditolak</span>
                                                                    @elseif($selesaiFisik->isApproved == true)
                                                                        <span
                                                                            class="me-2 text-sm text-success font-weight-bold">Disetujui</span>
                                                                    @endif
                                                                @endif
                                                            @endif
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

@section('jquery_script')
    <script>
        $(document).ready(function() {
            $('#submit-approve-persiapan').click(function(e) {
                $('#form-approve-persiapan').submit();
            });

            $('#submit-reject-persiapan').click(function() {
                $('#form-reject-persiapan').submit();
            });

            $('#submit-approve-instalasi').click(function() {
                $('#form-approve-instalasi').submit();
            });

            $('#submit-reject-instalasi').click(function() {
                $('#form-reject-instalasi').submit();
            });

            $('#submit-approve-selesaiFisik').click(function() {
                $('#form-approve-selesaiFisik').submit();
            });

            $('#submit-reject-selesaiFisik').click(function() {
                $('#form-reject-selesaiFisik').submit();
            });
        });
    </script>
@endsection
