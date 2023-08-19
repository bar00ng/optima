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
                                                        <td></td>
                                                        <td>
                                                            <textarea name="keterangan_persiapan" class="form-control @error('keterangan_persiapan') is-invalid @enderror" cols="30" rows="2" placeholder="Keterangan Persiapan Wajib diisi" {{ isset($persiapan) && $persiapan->isApproved == true ? 'disabled' : '' }}>{{ isset($persiapan) ? $persiapan->keterangan_persiapan : old('keterangan_persiapan') }}</textarea>
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('keterangan_persiapan') }}
                                                            </div>
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
                                                            <td class="px-2"></td>
                                                            <td>
                                                                <textarea name="keterangan_instalasi" class="form-control @error('keterangan_instalasi') is-invalid @enderror" cols="30" rows="2"
                                                                    placeholder="Keterangan instalasi wajib diisi" {{ isset($instalasi) && $instalasi->isApproved == true ? 'disabled' : '' }}>{{ isset($instalasi) ? $instalasi->keterangan_instalasi : old('keterangan_instalasi') }}</textarea>
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('keterangan_instalasi') }}
                                                                </div>
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
                                                            <input type="file" name="evidence_selesai"
                                                                class="form-control form-control-sm @error('evidence_selesai') is-invalid @enderror" {{ isset($selesaiFisik) && $selesaiFisik->isApproved == true ? 'disabled' : '' }} >
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('evidence_selesai') }}
                                                            </div>

                                                            @if (isset($selesaiFisik) && !$selesaiFisik->selesaiFisikDetail->isEmpty())
                                                                @foreach ($selesaiFisik->selesaiFisikDetail as $dis)
                                                                    <ul class="list-unstyled">
                                                                        <li class="d-flex flex-row align-items-center">
                                                                            <a href="{{ Storage::url('uploads/evidence_selesai/' . $dis->evidence_name) }}"
                                                                                target="_blank">
                                                                                <span
                                                                                    class="me-2 text-xs font-weight-bold text-truncate">{{ $dis->evidence_name }}</span>
                                                                            </a>
                                                                            @if ($dis->isApproved === 0)
                                                                                <span
                                                                                    class="me-2 text-xs fst-italic text-danger">(Ditolak)</span>
                                                                            @elseif ($dis->isApproved === 1)
                                                                                <span
                                                                                    class="me-2 text-xs fst-italic text-success">(Disetujui)</span>
                                                                            @elseif (is_null($dis->isApproved))
                                                                                @if (Auth::user()->hasRole('optima'))
                                                                                <div class="d-flex align-items-center">
                                                                                    <button type="button"
                                                                                        class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-placement="bottom"
                                                                                        title="Approve Evidence Selesai Fisik"
                                                                                        data-container="body"
                                                                                        data-animation="true"
                                                                                        data-id="{{ $dis->id }}"
                                                                                        data-value="true"
                                                                                        id="evidence-approve">
                                                                                        &#10003;
                                                                                    </button>

                                                                                    <button type="button"
                                                                                            class="btn btn-outline-danger btn-sm btn-icon-only btn-tooltip"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-placement="bottom"
                                                                                            title="Reject Evidence Selesai Fisik"
                                                                                            data-container="body"
                                                                                            data-animation="true"
                                                                                            data-id="{{ $dis->id }}"
                                                                                            data-value="false"
                                                                                            id="evidence-reject">
                                                                                            &#10007;
                                                                                    </button>
                                                                                </div>
                                                                                @else
                                                                                    <span
                                                                                        class="me-2 text-xs fst-italic">(Menunggu
                                                                                        Persetujuan)</span>
                                                                                @endif
                                                                            @endif
                                                                        </li>
                                                                    </ul>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <textarea name="keterangan_selesai" class="form-control @error('keterangan_selesai') is-invalid @enderror" cols="30" rows="2"
                                                                placeholder="Keterangan selesai fisik wajib diisi" {{ isset($selesaiFisik) && $selesaiFisik->isApproved == true ? 'disabled' : '' }}>{{ isset($selesaiFisik) ? $selesaiFisik->keterangan_selesai : old('keterangan_selesai') }}</textarea>
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('keterangan_selesai') }}
                                                            </div>
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
            $('#evidence-approve').on('click', function(e) {
                e.preventDefault();

                var ele = $(this);

                var evidenceId = ele.data('id');

                $.ajax({
                    url: '/konstruksi/selesai-fisik/approve-evidence/' + evidenceId,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert("Evidence disetujui");
                        console.log(response);
                        window.location.reload();
                    },
                    error: function (xhr, textStatus, error) {
                        // Handle errors if needed
                        console.error(error);
                    }
                })
            });

            $('#evidence-reject').on('click', function(e) {
                e.preventDefault();

                var ele = $(this);

                var evidenceId = ele.data('id');

                $.ajax({
                    url: '/konstruksi/selesai-fisik/reject-evidence/' + evidenceId,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert("Evidence ditolak");
                        console.log(response);
                        window.location.reload();
                    },
                    error: function (xhr, textStatus, error) {
                        // Handle errors if needed
                        console.error(error);
                    }
                })
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
                        alert("Selesai Fisik marked as Done");
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
