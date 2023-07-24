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
                                                                            {{ ($goLive && $goLive->exists && $goLive->isNeed == true) ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="customRadio1">GoLive ODP</label>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <div class="form-check mb-3">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="isNeed" value="false"
                                                                            {{ ($goLive && $goLive->exists && $goLive->isNeed == false) ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="customRadio1">Tanpa GoLive ODP</label>
                                                                    </div>
                                                                </td>
                                                                <td colspan="2">
                                                                    <div class="form-group has-validation">
                                                                        <textarea name="keterangan_withoutGoLive" class="form-control {{ $errors->has('keterangan_withoutGoLive') ? 'is-invalid' : '' }}" cols="30" rows="2"
                                                                            placeholder="Keterangan Tanpa GoLive">{{ !empty($goLive) ? $goLive->keterangan_withoutGolive : '' }}</textarea>
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
                                                                        <h6 class="mb-0 text-sm">Validasi DOC</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @if (Auth::user()->hasRole('optima'))
                                                                <td class="align-middle text-center">
                                                                    @if($validasi === null)
                                                                        &nbsp;
                                                                    @elseif($validasi !== null && $validasi->isApproved !== 1)
                                                                        <div class="d-flex align-items-center justify-content-center">
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-center">
                                                                                <button type="button"
                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                                    title="Mark As Done"
                                                                                    data-container="body" data-animation="true"
                                                                                    id="approve-validasi" data-id="{{ $validasi !== null ? $validasi->lop->id : 0 }}">&#10003;</button>
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
                                                                    @if ($validasi === null)
                                                                        <div class="d-flex flex-column">
                                                                            <span
                                                                                class="me-2 text-xs text-secondary">Belum Selesai</span>
                                                                        </div>
                                                                    @elseif($validasi !== null && $validasi->isApproved !== 1)
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
                                                            <td colspan="2">
                                                                <textarea name="keterangan_validasi" class="form-control" cols="30" rows="2"
                                                                    placeholder="Keterangan Validasi"  {{ ($validasi !== null && $validasi->isApproved === 1) ?  'disabled' : '' }}>{{ empty($validasi) ? '' : $validasi->keterangan_validasi }}</textarea>
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
                                                            @if (Auth::user()->hasRole('optima'))
                                                                <td class="align-middle text-center">
                                                                    @if($konfirmasiMitra === null)
                                                                        &nbsp;
                                                                    @elseif($konfirmasiMitra !== null && $konfirmasiMitra->isApproved !== 1)
                                                                        <div class="d-flex align-items-center justify-content-center">
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-center">
                                                                                <button type="button"
                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                                    title="Mark As Done"
                                                                                    data-container="body" data-animation="true"
                                                                                    id="approve-konfirmasiMitra" data-id="{{ $konfirmasiMitra !== null ? $konfirmasiMitra->lop->id : 0 }}">&#10003;</button>
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
                                                                    @if ($konfirmasiMitra === null)
                                                                        <div class="d-flex flex-column">
                                                                            <span
                                                                                class="me-2 text-xs text-secondary">Belum Selesai</span>
                                                                        </div>
                                                                    @elseif($konfirmasiMitra !== null && $konfirmasiMitra->isApproved !== 1)
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
                                                            <td colspan="2">
                                                                <textarea name="keterangan_konfirmasi_mitra" class="form-control" cols="30" rows="2"
                                                                    placeholder="Keterangan Konfirmasi Mitra"  {{ ($konfirmasiMitra !== null && $konfirmasiMitra->isApproved === 1) ?  'disabled' : '' }}>{{ empty($konfirmasiMitra) ? '' : $konfirmasiMitra->keterangan_konfirmasi_mitra }}</textarea>
                                                            </td>
                                                        </tr>

                                                        <!-- Connectivity -->
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2">
                                                                    <div class="my-auto">
                                                                        <h6 class="mb-0 text-sm">OGP Connectivity</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @if (Auth::user()->hasRole('optima'))
                                                                <td class="align-middle text-center">
                                                                    @if($connectivity === null)
                                                                        &nbsp;
                                                                    @elseif($connectivity !== null && $connectivity->isApproved !== 1)
                                                                        <div class="d-flex align-items-center justify-content-center">
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-center">
                                                                                <button type="button"
                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                                    title="Mark As Done"
                                                                                    data-container="body" data-animation="true"
                                                                                    id="approve-connectivity" data-id="{{ $connectivity !== null ? $connectivity->lop->id : 0 }}">&#10003;</button>
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
                                                                    @if ($connectivity === null)
                                                                        <div class="d-flex flex-column">
                                                                            <span
                                                                                class="me-2 text-xs text-secondary">Belum Selesai</span>
                                                                        </div>
                                                                    @elseif($connectivity !== null && $connectivity->isApproved !== 1)
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
                                                            <td colspan="2">
                                                                <textarea name="keterangan_connectivity" class="form-control" cols="30" rows="2"
                                                                    placeholder="Keterangan Connectivity"  {{ ($connectivity !== null && $connectivity->isApproved === 1) ?  'disabled' : '' }}>{{ empty($connectivity) ? '' : $connectivity->keterangan_connectivity }}</textarea>
                                                            </td>
                                                        </tr>

                                                        <!-- Go Live ODP -->
                                                            <tr style="display: {{ ($goLive && $goLive->exists && $goLive->isNeed == true) ? '' : 'none' }};">
                                                                <td>
                                                                    <div class="d-flex px-2">
                                                                        <div class="my-auto">
                                                                            <h6 class="mb-0 text-sm">GoLive</h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                @if (Auth::user()->hasRole('optima'))
                                                                    <td class="align-middle text-center">
                                                                        @if($goLive === null)
                                                                            &nbsp;
                                                                        @elseif($goLive !== null && $goLive->isApproved !== 1)
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <div
                                                                                    class="d-flex align-items-center justify-content-center">
                                                                                    <button type="button"
                                                                                        class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                                        title="Mark As Done"
                                                                                        data-container="body" data-animation="true"
                                                                                        id="approve-odp" data-id="{{ $goLive !== null ? $goLive->lop->id : 0 }}">&#10003;</button>
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
                                                                        @if ($goLive === null)
                                                                            <div class="d-flex flex-column">
                                                                                <span
                                                                                    class="me-2 text-xs text-secondary">Belum Selesai</span>
                                                                            </div>
                                                                        @elseif($goLive !== null && $goLive->isApproved !== 1)
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
                                                                <td>
                                                                    @if (!empty($goLive))
                                                                        @if ($goLive->exists && $goLive->evidence_golive !== null)
                                                                            <div class="d-flex flex-row align-items-center">
                                                                                <a href="{{ Storage::url('uploads/evidence_golive/' . $goLive['evidence_golive']) }}"
                                                                                    target="_blank">
                                                                                    <span
                                                                                        class="me-2 text-xs font-weight-bold">{{ $goLive->evidence_golive }}</span>
                                                                                </a>
                                                                            </div>
                                                                        @else
                                                                            <div
                                                                                class="d-flex flex-row align-items-center px-2">
                                                                                <input type="file" name="evidence_golive"
                                                                                    class="form-control form-control-sm"  {{ ($goLive !== null && $goLive->isApproved === 1) ?  'disabled' : '' }}>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        <div
                                                                            class="d-flex flex-row align-items-center px-2">
                                                                            <input type="file" name="evidence_golive"
                                                                                class="form-control form-control-sm"  {{ ($goLive !== null && $goLive->isApproved === 1) ?  'disabled' : '' }}>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <textarea name="keterangan_withGoLive" class="form-control" cols="30" rows="2"
                                                                        placeholder="Keterangan GoLive"  {{ ($goLive !== null && $goLive->isApproved === 1) ?  'disabled' : '' }} {{ isset($goLive) && $goLive->exists && $goLive->isNeed == false ? 'disabled' : '' }}>{{ isset($goLive) && $goLive->exists && isset($goLive->keterangan_withGolive) ? $goLive->keterangan_withGolive : '' }}</textarea>
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
    </div>
@endsection

@section('jquery_script')
    <script>
        $(document).ready(function() {
            $('#approve-validasi').on('click', function(e) {
                e.preventDefault();
                var ele = $(this);

                var lop_id = ele.data('id');

                $.ajax({
                    url: '/goLive/validasi/' + lop_id,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert("Validasi DOC marked as Done");
                        window.location.reload();
                    },
                    error: function (xhr, textStatus, error) {
                        // Handle errors if needed
                        console.error(error);
                    }
                });
            });

            $('#approve-konfirmasiMitra').on('click', function(e) {
                e.preventDefault();
                var ele = $(this);

                var lop_id = ele.data('id');

                $.ajax({
                    url: '/goLive/konfirmasiMitra/' + lop_id,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert("Konfirmasi Mitra marked as Done");
                        window.location.reload();
                    },
                    error: function (xhr, textStatus, error) {
                        // Handle errors if needed
                        console.error(error);
                    }
                });
            });

            $('#approve-connectivity').on('click', function(e) {
                e.preventDefault();
                var ele = $(this);

                var lop_id = ele.data('id');

                $.ajax({
                    url: '/goLive/connectivity/' + lop_id,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert("OGP Connectivity marked as Done");
                        window.location.reload();
                    },
                    error: function (xhr, textStatus, error) {
                        // Handle errors if needed
                        console.error(error);
                    }
                });
            });

            $('#approve-odp').on('click', function(e) {
                e.preventDefault();
                var ele = $(this);

                var lop_id = ele.data('id');

                $.ajax({
                    url: '/goLive/odp/' + lop_id,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert("GoLive ODP marked as Done");
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