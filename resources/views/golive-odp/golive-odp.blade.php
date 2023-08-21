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
                                                                        <input class="form-check-input" type="radio" id="need-golive"
                                                                            name="isNeed" value="true" {{ isset($goLiveData) && ($goLiveData->isNeed == 1) ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="customRadio1">GoLive ODP</label>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <div class="form-check mb-3">
                                                                        <input class="form-check-input" type="radio" id="no-need-golive"
                                                                            name="isNeed" value="false" {{ isset($goLiveData) && ($goLiveData->isNeed == 0) ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="customRadio1">Tanpa GoLive ODP</label>
                                                                    </div>
                                                                </td>
                                                                <td colspan="2">
                                                                    <div class="form-group has-validation">
                                                                        <textarea name="keterangan_tanpa_golive"
                                                                            class="form-control @error('keterangan_tanpa_golive') is-invalid @enderror" cols="30" id="keterangan-tanpa-golive"
                                                                            rows="2" placeholder="Keterangan Tanpa GoLive" {{ isset($goLiveData) && ($goLiveData->isNeed == 1) ? 'disabled' : '' }}>{{ isset($goLiveData) && ($goLiveData->isNeed == 0) ? $goLiveData->withoutGoLive->keterangan_golive : old('keterangan_tanpa_golive') }}</textarea>
                                                                        <div class="invalid-feedback">
                                                                            {{ $errors->first('keterangan_tanpa_golive') }}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        
                                                        <!-- Validasi -->
                                                        {{ session('errors') }}
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
                                                                    @if (is_null($validasiData))
                                                                        &nbsp;
                                                                    @elseif($validasiData !== null && $validasiData->isApproved !== 1)
                                                                        <div
                                                                            class="d-flex align-items-center justify-content-center">
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-center">
                                                                                <button type="button"
                                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="Mark As Done"
                                                                                    data-container="body"
                                                                                    data-animation="true"
                                                                                    id="approve-validasi"
                                                                                    data-id="{{ $validasiData !== null ? $validasiData->id : 0 }}">&#10003;</button>
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
                                                                    @if (is_null($validasiData) || $validasiData->isApproved == false)
                                                                        <div class="d-flex flex-column">
                                                                            <span class="me-2 text-xs text-secondary">Belum
                                                                                Selesai</span>
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
                                                                <textarea name="keterangan_validasi" class="form-control @error('keterangan_validasi') is-invalid @enderror" cols="30" rows="2"
                                                                    placeholder="Keterangan Validasi" {{ isset($validasiData) && $validasiData->isApproved == true ? 'disabled' : '' }}>{{ isset($validasiData) ? $validasiData->keterangan_validasi : old('keterangan_validasi') }}</textarea>
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('keterangan_validasi') }}
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <!-- Konfirmasi Mitra -->
                                                        @if ($validasiData !== null && $validasiData->isApproved === 1)
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
                                                                        @if (is_null($konfirmasiMitraData))
                                                                            &nbsp;
                                                                        @elseif($konfirmasiMitraData !== null && $konfirmasiMitraData->isApproved !== 1)
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-center">
                                                                                <div
                                                                                    class="d-flex align-items-center justify-content-center">
                                                                                    <button type="button"
                                                                                        class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-placement="bottom"
                                                                                        title="Mark As Done"
                                                                                        data-container="body"
                                                                                        data-animation="true"
                                                                                        id="approve-konfirmasiMitra"
                                                                                        data-id="{{ $konfirmasiMitraData !== null ? $konfirmasiMitraData->id : 0 }}">&#10003;</button>
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
                                                                        @if (is_null($konfirmasiMitraData) || $konfirmasiMitraData->isApproved == false)
                                                                            <div class="d-flex flex-column">
                                                                                <span
                                                                                    class="me-2 text-xs text-secondary">Belum
                                                                                    Selesai</span>
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
                                                                    <textarea name="keterangan_konfirmasi_mitra" class="form-control @error('keterangan_konfirmasi_mitra') is-invalid @enderror" cols="30" rows="2"
                                                                        placeholder="Keterangan Konfirmasi Mitra"
                                                                        {{ isset($konfirmasiMitraData) && $konfirmasiMitraData->isApproved == true ? 'disabled' : '' }}>{{ isset($konfirmasiMitraData) ? $konfirmasiMitraData->keterangan_konfirmasi_mitra : old('keterangan_konfirmasi_mitra') }}</textarea>
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('keterangan_konfirmasi_mitra') }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif


                                                        <!-- Connectivity -->
                                                        @if ($konfirmasiMitraData !== null && $konfirmasiMitraData->isApproved === 1)
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
                                                                        @if ($connectivityData === null)
                                                                            &nbsp;
                                                                        @elseif($connectivityData !== null && $connectivityData->isApproved !== 1)
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-center">
                                                                                <div
                                                                                    class="d-flex align-items-center justify-content-center">
                                                                                    <button type="button"
                                                                                        class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-placement="bottom"
                                                                                        title="Mark As Done"
                                                                                        data-container="body"
                                                                                        data-animation="true"
                                                                                        id="approve-connectivity"
                                                                                        data-id="{{ $connectivityData !== null ? $connectivityData->id : 0 }}">&#10003;</button>
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
                                                                        @if (is_null($connectivityData) || $connectivityData->isApproved == false)
                                                                            <div class="d-flex flex-column">
                                                                                <span
                                                                                    class="me-2 text-xs text-secondary">Belum
                                                                                    Selesai</span>
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
                                                                    <textarea name="keterangan_connectivity" class="form-control @error('keterangan_connectivity') is-invalid @enderror" cols="30" rows="2"
                                                                        placeholder="Keterangan Connectivity"
                                                                        {{ isset($connectivityData) && $connectivityData->isApproved == true ? 'disabled' : '' }}>{{ isset($connectivityData) ? $connectivityData->keterangan_connectivity : old('keterangan_connectivity') }}</textarea>
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('keterangan_connectivity') }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif


                                                        <!-- Go Live ODP -->
                                                        @if ($connectivityData !== null && $connectivityData->isApproved === 1 && $goLiveData->isNeed == 1)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex px-2">
                                                                        <div class="my-auto">
                                                                            <h6 class="mb-0 text-sm">GoLive</h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                @if (Auth::user()->hasRole('optima'))
                                                                    <td class="align-middle text-center">
                                                                        @if ($goLiveData === null)
                                                                            &nbsp;
                                                                        @elseif($goLiveData !== null && $goLiveData->isApproved !== 1)
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-center">
                                                                                <div
                                                                                    class="d-flex align-items-center justify-content-center">
                                                                                    <button type="button"
                                                                                        class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-placement="bottom"
                                                                                        title="Mark As Done"
                                                                                        data-container="body"
                                                                                        data-animation="true"
                                                                                        id="approve-odp"
                                                                                        data-id="{{ $goLiveData !== null ? $goLiveData->id : 0 }}">&#10003;</button>
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
                                                                        @if ($goLiveData === null)
                                                                            <div class="d-flex flex-column">
                                                                                <span
                                                                                    class="me-2 text-xs text-secondary">Belum
                                                                                    Selesai</span>
                                                                            </div>
                                                                        @elseif($goLiveData !== null && $goLiveData->isApproved !== 1)
                                                                            <div class="d-flex flex-column">
                                                                                <span
                                                                                    class="me-2 text-xs text-secondary">Belum
                                                                                    Selesai</span>
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
                                                                    <input type="file" name="evidence_golive" class="form-control @error('evidence_golive') is-invalid @enderror"
                                                                        {{ isset($goLiveData) && $goLiveData->isApproved == 1 ? 'disabled' : '' }}>
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('evidence_golive') }}
                                                                    </div>

                                                                    @if (isset($goLiveData) && !$goLiveData->withGoLive->withGoLiveDetail->isEmpty())
                                                                        @foreach ($goLiveData->withGoLive->withGoLiveDetail as $item)
                                                                            <ul class="list-unstyled">
                                                                                <li class="d-flex flex-row align-items-center">
                                                                                    <a href="{{ Storage::url('uploads/evidence_golive/' . $item->evidence_name) }}" target="_blank">
                                                                                        <span class="me-2 text-xs font-weight-bold text-truncate">
                                                                                            {{ $item->evidence_name }}
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        @endforeach
                                                                    @endif
                                                                    {{-- @if (!empty($goLiveData))
                                                                        @if ($goLive->exists && $goLive->evidence_golive !== null)
                                                                            <div
                                                                                class="d-flex flex-row align-items-center">
                                                                                <a href="{{ Storage::url('uploads/evidence_golive/' . $goLive['evidence_golive']) }}"
                                                                                    target="_blank">
                                                                                    <span
                                                                                        class="me-2 text-xs font-weight-bold">{{ $goLive->evidence_golive }}</span>
                                                                                </a>
                                                                            </div>
                                                                        @else
                                                                            <div
                                                                                class="d-flex flex-row align-items-center px-2">
                                                                                <input type="file"
                                                                                    name="evidence_golive"
                                                                                    class="form-control form-control-sm"
                                                                                    {{ $goLive !== null && $goLive->isApproved === 1 ? 'disabled' : '' }}>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        <div
                                                                            class="d-flex flex-row align-items-center px-2">
                                                                            <input type="file" name="evidence_golive"
                                                                                class="form-control form-control-sm"
                                                                                {{ $goLive !== null && $goLive->isApproved === 1 ? 'disabled' : '' }}>
                                                                        </div>
                                                                    @endif --}}
                                                                </td>
                                                                <td>
                                                                    <textarea name="keterangan_dengan_golive" class="form-control @error('keterangan_dengan_golive') is-invalid @enderror" cols="30" rows="2"
                                                                        placeholder="Keterangan GoLive" {{ isset($goLiveData) && $goLiveData->isApproved == 1 ? 'disabled' : '' }}>{{ isset($goLiveData) && ($goLiveData->isNeed == 1) ? $goLiveData->withGoLive->keterangan_golive : old('keterangan_dengan_golive') }}</textarea>
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('keterangan_dengan_golive') }}
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
                    success: function(response) {
                        alert("Validasi DOC marked as Done");
                        window.location.reload();
                    },
                    error: function(xhr, textStatus, error) {
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
                    success: function(response) {
                        alert("Konfirmasi Mitra marked as Done");
                        window.location.reload();
                    },
                    error: function(xhr, textStatus, error) {
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
                    success: function(response) {
                        alert("OGP Connectivity marked as Done");
                        window.location.reload();
                    },
                    error: function(xhr, textStatus, error) {
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
                    success: function(response) {
                        alert("GoLive ODP marked as Done");
                        window.location.reload();
                    },
                    error: function(xhr, textStatus, error) {
                        // Handle errors if needed
                        console.error(error);
                    }
                });
            });

            $('#need-golive').on('change', function() {
                if ($(this).is(':checked')) {
                    // Clear the textarea and disable it
                    $('#keterangan-tanpa-golive').val('');
                    $('#keterangan-tanpa-golive').prop('disabled', true);
                } 
            });

            // Add event listener to the 'no-need-golive' radio button
            $('#no-need-golive').on('change', function() {
                if ($(this).is(':checked')) {
                    // Enable the textarea
                    $('#keterangan-tanpa-golive').prop('disabled', false);
                }
            });
        });
    </script>
@endsection
