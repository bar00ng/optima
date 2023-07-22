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
                                                        @if(Auth::user()->hasRole('optima'))
                                                            <td class="align-middle text-center">
                                                                @if ($persiapan === null)
                                                                    &nbsp;
                                                                @elseif($persiapan !== null && $persiapan->isApproved !== 1)
                                                                    <div class="d-flex flex-column">
                                                                        <div
                                                                            class="d-flex align-items-center justify-content-center">
                                                                            <button type="button"
                                                                                class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                                title="Mark As Done"
                                                                                data-container="body" data-animation="true"
                                                                                id="approve-persiapan" data-id="{{ $persiapan !== null ? $persiapan->id : 0 }}">&#10003;</button>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="d-flex flex-column">
                                                                        <span
                                                                            class="me-2 text-xs text-success">Selesai</span>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td class="align-middle text-center">
                                                                @if ($persiapan === null)
                                                                    <div class="d-flex flex-column">
                                                                        <span
                                                                            class="me-2 text-xs text-secondary">Belum Selesai</span>
                                                                    </div>
                                                                @elseif($persiapan !== null && $persiapan->isApproved !== 1)
                                                                    <div class="d-flex flex-column">
                                                                        <span
                                                                            class="me-2 text-xs text-secondary">Belum Selesai</span>
                                                                    </div>
                                                                @else
                                                                    <div class="d-flex flex-column">
                                                                        <span
                                                                            class="me-2 text-xs text-success">Selesai</span>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td class="px-2">
                                                            <!-- Check apakah ada evidence persiapan -->
                                                            @if ($persiapan !== null)
                                                                <!-- Jika ada, check apakah ada data -->
                                                                @if (!empty($persiapan->data))
                                                                    <ul class="list-unstyled">
                                                                        @foreach ($data_persiapan_array as $dps)
                                                                            <li class="d-flex flex-row align-items-center">
                                                                                <a href="{{ Storage::url('uploads/evidence_persiapan/' . $dps['filename']) }}"
                                                                                    target="_blank">
                                                                                    <span
                                                                                        class="me-2 text-xs font-weight-bold text-truncate">{{ $dps['filename'] }}</span>
                                                                                </a>
                                                                                @if ($dps['isApproved'] === true)
                                                                                    <span
                                                                                        class="me-2 text-xs fst-italic text-success">(Disetujui)</span>
                                                                                @elseif ($dps['isApproved'] === false)
                                                                                    <span
                                                                                        class="me-2 text-xs fst-italic text-danger">(Ditolak)</span>
                                                                                @elseif ($dps['isApproved'] === null)
                                                                                    @if (Auth::user()->hasRole('optima'))
                                                                                        <div
                                                                                            class="d-flex align-items-center">
                                                                                            <form action="#"
                                                                                                method="post"
                                                                                                style="margin-right: 5px; display:hidden;"
                                                                                                id="form-approve-persiapan">
                                                                                            </form>

                                                                                            <form
                                                                                                action="{{ route('lop.konstruksi.approve.persiapan', ['approved' => 'true', 'persiapan_id' => $persiapan->id, 'evidence_id' => $dps['id']]) }}"
                                                                                                method="post"
                                                                                                style="margin-right: 5px"
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
                                                                                                action="{{ route('lop.konstruksi.approve.persiapan', ['approved' => 'false', 'persiapan_id' => $persiapan->id, 'evidence_id' => $dps['id']]) }}"
                                                                                                method="post"
                                                                                                style="margin-right: 5px"
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
                                                                                        <span
                                                                                            class="me-2 text-xs fst-italic">(Menunggu
                                                                                            Persetujuan)</span>
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
                                                                    class="form-control form-control-sm" {{ ($persiapan !== null && $persiapan->isApproved === 1) ?  'disabled' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_persiapan" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Persiapan (Opsional)" {{ ($persiapan !== null && $persiapan->isApproved === 1) ?  'disabled' : '' }}>{{ empty($persiapan) ? '' : $persiapan->keterangan_persiapan }}</textarea>
                                                        </td>
                                                    </tr>

                                                    @if($persiapan !== null && $persiapan->isApproved === 1)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2">
                                                                    <div class="my-auto">
                                                                        <h6 class="mb-0 text-sm">Instalasi</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @if (Auth::user()->hasRole('optima'))
                                                                <td class="align-middle text-center">
                                                                    @if($instalasi === null)
                                                                        &nbsp;
                                                                    @elseif($instalasi !== null && $instalasi->isApproved !== 1)
                                                                        <div class="d-flex align-items-center justify-content-center">
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-center">
                                                                                <button type="button"
                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                                    title="Mark As Done"
                                                                                    data-container="body" data-animation="true"
                                                                                    id="approve-instalasi" data-id="{{ $instalasi !== null ? $instalasi->id : 0 }}">&#10003;</button>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="d-flex flex-column">
                                                                            <span
                                                                                class="me-2 text-xs text-success">Selesai</span>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            @else
                                                                <td class="align-middle text-center">
                                                                    @if ($instalasi === null)
                                                                        <div class="d-flex flex-column">
                                                                            <span
                                                                                class="me-2 text-xs text-secondary">Belum Selesai</span>
                                                                        </div>
                                                                    @elseif($instalasi !== null && $instalasi->isApproved !== 1)
                                                                        <div class="d-flex flex-column">
                                                                            <span
                                                                                class="me-2 text-xs text-secondary">Belum Selesai</span>
                                                                        </div>
                                                                    @else
                                                                        <div class="d-flex flex-column">
                                                                            <span
                                                                                class="me-2 text-xs text-success">Selesai</span>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            <td class="px-2">
                                                                <!-- Check apakah ada evidence persiapan -->
                                                                @if ($instalasi !== null)
                                                                    <!-- Jika ada, check apakah ada data -->
                                                                    @if (!empty($instalasi->data))
                                                                        <ul class="list-unstyled">
                                                                            @foreach ($data_instalasi_array as $dis)
                                                                                <li class="d-flex flex-row align-items-center">
                                                                                    <a href="{{ 'uploads/evidence_instalasi/' . $dis['filename'] }}"
                                                                                        target="_blank">
                                                                                        <span
                                                                                            class="me-2 text-xs font-weight-bold text-truncate">{{ $dis['filename'] }}</span>
                                                                                    </a>
                                                                                    @if ($dis['isApproved'] === true)
                                                                                        <span
                                                                                            class="me-2 text-xs fst-italic text-success">(Disetujui)</span>
                                                                                    @elseif ($dis['isApproved'] === false)
                                                                                        <span
                                                                                            class="me-2 text-xs fst-italic text-danger">(Ditolak)</span>
                                                                                    @elseif ($dis['isApproved'] === null)
                                                                                        @if (Auth::user()->hasRole('optima'))
                                                                                            <div
                                                                                                class="d-flex align-items-center">
                                                                                                <form action="#"
                                                                                                    method="post"
                                                                                                    style="margin-right: 5px; display:hidden;"
                                                                                                    id="form-approve-persiapan">
                                                                                                </form>

                                                                                                <form
                                                                                                    action="{{ route('lop.konstruksi.approve.instalasi', ['approved' => 'true', 'instalasi_id' => $instalasi->id, 'evidence_id' => $dis['id']]) }}"
                                                                                                    method="post"
                                                                                                    style="margin-right: 5px"
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
                                                                                                    action="{{ route('lop.konstruksi.approve.instalasi', ['approved' => 'false', 'instalasi_id' => $instalasi->id, 'evidence_id' => $dis['id']]) }}"
                                                                                                    method="post"
                                                                                                    style="margin-right: 5px"
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
                                                                                            <span
                                                                                                class="me-2 text-xs fst-italic">(Menunggu
                                                                                                Persetujuan)</span>
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
                                                                        class="form-control form-control-sm" {{ ($instalasi !== null && $instalasi->isApproved === 1) ?  'disabled' : '' }}>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <textarea name="keterangan_instalasi" class="form-control" cols="30" rows="2"
                                                                    placeholder="Keterangan Instalasi (Opsional)" {{ ($instalasi !== null && $instalasi->isApproved === 1) ?  'disabled' : '' }}>{{ empty($instalasi) ? '' : $instalasi->keterangan_instalasi }}</textarea>
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    @if($instalasi !== null && $instalasi->isApproved === 1)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div class="my-auto">
                                                                    <h6 class="mb-0 text-sm">Selesai Fisik</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @if (Auth::user()->hasRole('optima'))
                                                            <td class="align-middle text-center">
                                                                @if ($selesaiFisik === null)
                                                                    &nbsp;
                                                                @elseif($selesaiFisik !== null && $selesaiFisik->isApproved !== 1)
                                                                    <div class="d-flex align-items-center justify-content-center">
                                                                        <div
                                                                            class="d-flex align-items-center justify-content-center">
                                                                            <button type="button"
                                                                                class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                                title="Mark As Done"
                                                                                data-container="body" data-animation="true"
                                                                                id="approve-selesai" data-id="{{ $selesaiFisik !== null ? $selesaiFisik->id : 0 }}">&#10003;</button>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="d-flex flex-column">
                                                                        <span
                                                                            class="me-2 text-xs text-success">Selesai</span>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td class="align-middle text-center">
                                                                @if ($selesaiFisik === null)
                                                                    <div class="d-flex flex-column">
                                                                        <span
                                                                            class="me-2 text-xs text-secondary">Belum Selesai</span>
                                                                    </div>
                                                                @elseif($selesaiFisik !== null && $selesaiFisik->isApproved !== 1)
                                                                    <div class="d-flex flex-column">
                                                                        <span
                                                                            class="me-2 text-xs text-secondary">Belum Selesai</span>
                                                                    </div>
                                                                @else
                                                                    <div class="d-flex flex-column">
                                                                        <span
                                                                            class="me-2 text-xs text-success">Selesai</span>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td class="px-2">
                                                            <!-- Check apakah ada evidence persiapan -->
                                                            @if ($selesaiFisik !== null)
                                                                <!-- Jika ada, check apakah ada data -->
                                                                @if (!empty($selesaiFisik->data))
                                                                    <ul class="list-unstyled">
                                                                        @foreach ($data_selesaiFisik_array as $dis)
                                                                            <li class="d-flex flex-row align-items-center">
                                                                                <a href="{{ 'uploads/evidence_selesai/' . $dis['filename'] }}"
                                                                                    target="_blank">
                                                                                    <span
                                                                                        class="me-2 text-xs font-weight-bold text-truncate">{{ $dis['filename'] }}</span>
                                                                                </a>
                                                                                @if ($dis['isApproved'] === true)
                                                                                    <span
                                                                                        class="me-2 text-xs fst-italic text-success">(Disetujui)</span>
                                                                                @elseif ($dis['isApproved'] === false)
                                                                                    <span
                                                                                        class="me-2 text-xs fst-italic text-danger">(Ditolak)</span>
                                                                                @elseif ($dis['isApproved'] === null)
                                                                                    @if (Auth::user()->hasRole('optima'))
                                                                                        <div
                                                                                            class="d-flex align-items-center">
                                                                                            <form action="#"
                                                                                                method="post"
                                                                                                style="margin-right: 5px; display:hidden;"
                                                                                                id="form-approve-persiapan">
                                                                                            </form>

                                                                                            <form
                                                                                                action="{{ route('lop.konstruksi.approve.selesaiFisik', ['approved' => 'true', 'selesai_fisik_id' => $selesaiFisik->id, 'evidence_id' => $dis['id']]) }}"
                                                                                                method="post"
                                                                                                style="margin-right: 5px"
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
                                                                                                action="{{ route('lop.konstruksi.approve.selesaiFisik', ['approved' => 'false', 'selesai_fisik_id' => $selesaiFisik->id, 'evidence_id' => $dis['id']]) }}"
                                                                                                method="post"
                                                                                                style="margin-right: 5px"
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
                                                                                        <span
                                                                                            class="me-2 text-xs fst-italic">(Menunggu
                                                                                            Persetujuan)</span>
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
                                                                    class="form-control form-control-sm" {{ ($selesaiFisik !== null && $selesaiFisik->isApproved === 1) ?  'disabled' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_selesai" class="form-control" cols="30" rows="2"
                                                                placeholder="Keterangan Selesai Fisik (Opsional)" {{ ($selesaiFisik !== null && $selesaiFisik->isApproved === 1) ?  'disabled' : '' }}>{{ empty($selesaiFisik) ? '' : $selesaiFisik->keterangan_selesai }}</textarea>
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

            $('#approve-persiapan').on('click', function(e) {
                e.preventDefault();
                var ele = $(this);

                var isApproved = "true";
                var persiapan_id = ele.data('id');

                $.ajax({
                    url: '/konstruksi/persiapan/' + isApproved + '/' + persiapan_id,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert("Persiapan marked as Done");
                        window.location.reload();
                    },
                    error: function (xhr, textStatus, error) {
                        // Handle errors if needed
                        console.error(error);
                    }
                });
            });

            $('#approve-instalasi').on('click', function(e) {
                e.preventDefault();
                var ele = $(this);

                var isApproved = "true";
                var instalasi_id = ele.data('id');

                $.ajax({
                    url: '/konstruksi/instalasi/' + isApproved + '/' + instalasi_id,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert("Instalasi marked as Done");
                        window.location.reload();
                    },
                    error: function (xhr, textStatus, error) {
                        // Handle errors if needed
                        console.error(error);
                    }
                });
            });

            $('#approve-selesai').on('click', function(e) {
                e.preventDefault();
                var ele = $(this);

                var isApproved = "true";
                var selesai_fisik_id = ele.data('id');

                $.ajax({
                    url: '/konstruksi/selesaiFisik/' + isApproved + '/' + selesai_fisik_id,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert("Instalasi marked as Done");
                        window.location.reload();
                    },
                    error: function (xhr, textStatus, error) {
                        // Handle errors if needed
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
