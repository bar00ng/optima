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
                                                                        <input type="number" name="persiapan_progress" value="{{ !empty($persiapan) ? $persiapan->persiapan_progress : 0 }}" class="form-control form-control-sm" style="width: 60px; margin-right: 10px;" {{ empty($persiapan) ? 'disabled' : '' }}>
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
                                                        <td class="px-2">
                                                            <!-- Check apakah ada evidence persiapan -->
                                                            @if ($persiapan !== null)
                                                                <!-- Jika ada, check apakah ada data -->
                                                                @if (!empty($persiapan->data))
                                                                    <ul class="list-unstyled">
                                                                        @foreach ($data_persiapan_array as $dps)
                                                                            <li class="d-flex flex-row align-items-center">
                                                                                <a href="{{ asset('storage/uploads/evidence_persiapan/' . $dps['filename']) }}"
                                                                                    target="_blank">
                                                                                    <span
                                                                                        class="me-2 text-xs font-weight-bold text-truncate">{{ $dps['filename'] }}</span>
                                                                                </a>
                                                                                @if ($dps['isApproved'] === true)
                                                                                    <span class="me-2 text-xs fst-italic text-success">(Disetujui)</span>
                                                                                @elseif ($dps['isApproved'] === false)
                                                                                    <span class="me-2 text-xs fst-italic text-danger">(Ditolak)</span>
                                                                                @elseif ($dps['isApproved'] === null)
                                                                                    @if(Auth::user()->hasRole('optima'))
                                                                                        <div class="d-flex align-items-center">
                                                                                            <form action="#" method="post"
                                                                                                style="margin-right: 5px; display:hidden;"
                                                                                                id="form-approve-persiapan">
                                                                                            </form>

                                                                                            <form
                                                                                                action="{{ route('lop.konstruksi.approve.persiapan', ['approved' => 'true', 'persiapan_id' => $persiapan->id, 'evidence_id' => $dps['id'] ]) }}"
                                                                                                method="post" style="margin-right: 5px"
                                                                                                id="form-approve-persiapan">
                                                                                                @method('PATCH')
                                                                                                @csrf
                                                                                                <button type="button"
                                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                                    data-bs-toggle="tooltip"
                                                                                                    data-bs-placement="bottom"
                                                                                                    title="Approve Evidence Persiapan"
                                                                                                    data-container="body"
                                                                                                    data-animation="true"
                                                                                                    id="submit-approve-persiapan">&#10003;</button>
                                                                                            </form>

                                                                                            <form
                                                                                                action="{{ route('lop.konstruksi.approve.persiapan', ['approved' => 'false', 'persiapan_id' => $persiapan->id, 'evidence_id' => $dps['id'] ]) }}"
                                                                                                method="post" style="margin-right: 5px"
                                                                                                id="form-reject-persiapan">
                                                                                                @method('PATCH')
                                                                                                @csrf
                                                                                                <button type="button"
                                                                                                    class="btn btn-outline-danger btn-sm btn-icon-only btn-tooltip"
                                                                                                    data-bs-toggle="tooltip"
                                                                                                    data-bs-placement="bottom"
                                                                                                    title="Reject Evidence Persiapan"
                                                                                                    data-container="body"
                                                                                                    data-animation="true"
                                                                                                    id="submit-reject-persiapan">&#10007;</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    @else
                                                                                        <span class="me-2 text-xs fst-italic">(Menunggu Persetujuan)</span>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            @endif
                                                            <!-- Jika tidak, input upload file muncul -->
                                                            <div class="d-flex flex-row align-items-center">
                                                                <input type="file" name="evidence_persiapan"
                                                                    class="form-control form-control-sm">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_persiapan" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Persiapan (Opsional)">{{ empty($persiapan) ? '' : $persiapan->keterangan_persiapan }}</textarea>
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
                                                                        <input type="number" name="instalasi_progress" value="{{ !empty($instalasi) ? $instalasi->instalasi_progress : 0 }}" class="form-control form-control-sm" style="width: 60px; margin-right: 10px;" {{ empty($instalasi) ? 'disabled' : '' }}>
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
                                                        <td class="px-2">
                                                            <!-- Check apakah ada evidence persiapan -->
                                                            @if ($instalasi !== null)
                                                                <!-- Jika ada, check apakah ada data -->
                                                                @if (!empty($instalasi->data))
                                                                    <ul class="list-unstyled">
                                                                        @foreach ($data_instalasi_array as $dis)
                                                                            <li class="d-flex flex-row align-items-center">
                                                                                <a href="{{ asset('storage/uploads/evidence_instalasi/' . $dis['filename']) }}"
                                                                                    target="_blank">
                                                                                    <span
                                                                                        class="me-2 text-xs font-weight-bold text-truncate">{{ $dis['filename'] }}</span>
                                                                                </a>
                                                                                @if ($dis['isApproved'] === true)
                                                                                    <span class="me-2 text-xs fst-italic text-success">(Disetujui)</span>
                                                                                @elseif ($dis['isApproved'] === false)
                                                                                    <span class="me-2 text-xs fst-italic text-danger">(Ditolak)</span>
                                                                                @elseif ($dis['isApproved'] === null)
                                                                                    @if(Auth::user()->hasRole('optima'))
                                                                                        <div class="d-flex align-items-center">
                                                                                            <form action="#" method="post"
                                                                                                style="margin-right: 5px; display:hidden;"
                                                                                                id="form-approve-persiapan">
                                                                                            </form>

                                                                                            <form
                                                                                                action="{{ route('lop.konstruksi.approve.instalasi', ['approved' => 'true', 'instalasi_id' => $instalasi->id, 'evidence_id' => $dis['id'] ]) }}"
                                                                                                method="post" style="margin-right: 5px"
                                                                                                id="form-approve-persiapan">
                                                                                                @method('PATCH')
                                                                                                @csrf
                                                                                                <button type="button"
                                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                                    data-bs-toggle="tooltip"
                                                                                                    data-bs-placement="bottom"
                                                                                                    title="Approve Evidence Instalasi"
                                                                                                    data-container="body"
                                                                                                    data-animation="true"
                                                                                                    id="submit-approve-persiapan">&#10003;</button>
                                                                                            </form>

                                                                                            <form
                                                                                                action="{{ route('lop.konstruksi.approve.instalasi', ['approved' => 'false', 'instalasi_id' => $instalasi->id, 'evidence_id' => $dis['id'] ]) }}"
                                                                                                method="post" style="margin-right: 5px"
                                                                                                id="form-reject-persiapan">
                                                                                                @method('PATCH')
                                                                                                @csrf
                                                                                                <button type="button"
                                                                                                    class="btn btn-outline-danger btn-sm btn-icon-only btn-tooltip"
                                                                                                    data-bs-toggle="tooltip"
                                                                                                    data-bs-placement="bottom"
                                                                                                    title="Reject Evidence Instalasi"
                                                                                                    data-container="body"
                                                                                                    data-animation="true"
                                                                                                    id="submit-reject-persiapan">&#10007;</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    @else
                                                                                        <span class="me-2 text-xs fst-italic">(Menunggu Persetujuan)</span>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            @endif
                                                            <!-- Jika tidak, input upload file muncul -->
                                                            <div class="d-flex flex-row align-items-center">
                                                                <input type="file" name="evidence_instalasi"
                                                                    class="form-control form-control-sm">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_instalasi" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Instalasi (Opsional)">{{ empty($instalasi) ? '' : $instalasi->keterangan_instalasi }}</textarea>
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
                                                                        <input type="number" name="selesai_fisik_progress" value="{{ !empty($selesaiFisik) ? $selesaiFisik->selesai_fisik_progress : 0 }}" class="form-control form-control-sm" style="width: 60px; margin-right: 10px;" {{ empty($selesaiFisik) ? 'disabled' : '' }}>
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
                                                        <td class="px-2">
                                                            <!-- Check apakah ada evidence persiapan -->
                                                            @if ($selesaiFisik !== null)
                                                                <!-- Jika ada, check apakah ada data -->
                                                                @if (!empty($selesaiFisik->data))
                                                                    <ul class="list-unstyled">
                                                                        @foreach ($data_selesaiFisik_array as $dis)
                                                                            <li class="d-flex flex-row align-items-center">
                                                                                <a href="{{ asset('storage/uploads/evidence_selesai/' . $dis['filename']) }}"
                                                                                    target="_blank">
                                                                                    <span
                                                                                        class="me-2 text-xs font-weight-bold text-truncate">{{ $dis['filename'] }}</span>
                                                                                </a>
                                                                                @if ($dis['isApproved'] === true)
                                                                                    <span class="me-2 text-xs fst-italic text-success">(Disetujui)</span>
                                                                                @elseif ($dis['isApproved'] === false)
                                                                                    <span class="me-2 text-xs fst-italic text-danger">(Ditolak)</span>
                                                                                @elseif ($dis['isApproved'] === null)
                                                                                    @if(Auth::user()->hasRole('optima'))
                                                                                        <div class="d-flex align-items-center">
                                                                                            <form action="#" method="post"
                                                                                                style="margin-right: 5px; display:hidden;"
                                                                                                id="form-approve-persiapan">
                                                                                            </form>

                                                                                            <form
                                                                                                action="{{ route('lop.konstruksi.approve.selesaiFisik', ['approved' => 'true', 'selesai_fisik_id' => $selesaiFisik->id, 'evidence_id' => $dis['id'] ]) }}"
                                                                                                method="post" style="margin-right: 5px"
                                                                                                id="form-approve-persiapan">
                                                                                                @method('PATCH')
                                                                                                @csrf
                                                                                                <button type="button"
                                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                                    data-bs-toggle="tooltip"
                                                                                                    data-bs-placement="bottom"
                                                                                                    title="Approve Evidence Selesai Fisik"
                                                                                                    data-container="body"
                                                                                                    data-animation="true"
                                                                                                    id="submit-approve-persiapan">&#10003;</button>
                                                                                            </form>

                                                                                            <form
                                                                                                action="{{ route('lop.konstruksi.approve.selesaiFisik', ['approved' => 'false', 'selesai_fisik_id' => $selesaiFisik->id, 'evidence_id' => $dis['id'] ]) }}"
                                                                                                method="post" style="margin-right: 5px"
                                                                                                id="form-reject-persiapan">
                                                                                                @method('PATCH')
                                                                                                @csrf
                                                                                                <button type="button"
                                                                                                    class="btn btn-outline-danger btn-sm btn-icon-only btn-tooltip"
                                                                                                    data-bs-toggle="tooltip"
                                                                                                    data-bs-placement="bottom"
                                                                                                    title="Reject Evidence Selesai Fisik"
                                                                                                    data-container="body"
                                                                                                    data-animation="true"
                                                                                                    id="submit-reject-persiapan">&#10007;</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    @else
                                                                                        <span class="me-2 text-xs fst-italic">(Menunggu Persetujuan)</span>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            @endif
                                                            <!-- Jika tidak, input upload file muncul -->
                                                            <div class="d-flex flex-row align-items-center">
                                                                <input type="file" name="evidence_selesai"
                                                                    class="form-control form-control-sm">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_selesai" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Selesai Fisik (Opsional)">{{ empty($selesaiFisik) ? '' : $selesaiFisik->keterangan_selesai }}</textarea>
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
