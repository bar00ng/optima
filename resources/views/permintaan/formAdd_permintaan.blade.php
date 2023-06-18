@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h3 class="text-black font-bold">Input Permintaan</h3>
                    </div>
                </div>
                <div class="card-body px-5 py-2">
                    <form method="POST" action="{{ route('permintaan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group has-validation">
                            <label for="">Tanggal Permintaan (m-d-Y)</label>
                            @if ($errors->has('tanggal_permintaan'))
                                <input type="date" name="tanggal_permintaan" class="form-control is-invalid"
                                    value="{{ old('tanggal_permintaan') }}">
                            @else
                                <input type="date" name="tanggal_permintaan" class="form-control">
                            @endif
                            <div class="invalid-feedback">
                                {{ $errors->first('tanggal_permintaan') }}
                            </div>
                        </div>
                        <div class="form-group has-validation">
                            <label for="">Tematik Permintaan</label>
                            <select class="form-control {{ $errors->has('tematik_permintaan') ? 'is-invalid' : '' }}"
                                name="tematik_permintaan">
                                <option value="">-- PILIH TEMATIK --</option>
                                <option value="HEM" {{ old('tematik_permintaan') == 'HEM' ? 'selected' : '' }}>HEM
                                </option>
                                <option value="PT2" {{ old('tematik_permintaan') == 'PT2' ? 'selected' : '' }}>PT2
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('tematik_permintaan') }}
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="toggle_reffPermintaan" class="form-check-input">
                            <label class="custom-control-label">Apakah ada nota dinas?</label>
                        </div>
                        <div class="form-group" id="reffPermintaan" style="display: none;">
                            <label for="">Reff Permintaan</label>
                            <input type="file" class="form-control" name="reff_permintaan">
                        </div>
                        <div class="form-group has-validation">
                            <label for="">Nama Permintaan</label>
                            @if ($errors->has('nama_permintaan'))
                                <input type="text" name="nama_permintaan" class="form-control is-invalid"
                                    value="{{ old('nama_permintaan') }}">
                            @else
                                <input type="text" class="form-control" name="nama_permintaan">
                            @endif
                            <div class="invalid-feedback">
                                {{ $errors->first('nama_permintaan') }}
                            </div>
                        </div>
                        <div class="form-group has-validation">
                            <label for="">PIC Permintaan</label>
                            @if ($errors->has('pic_permintaan'))
                                <input type="text" name="pic_permintaan" class="form-control is-invalid"
                                    value="{{ old('pic_permintaan') }}">
                            @else
                                <input type="text" class="form-control" name="pic_permintaan">
                            @endif
                            <div class="invalid-feedback">
                                {{ $errors->first('pic_permintaan') }}
                            </div>
                        </div>
                        <div class="form-group has-validation">
                            <label for="">Keterangan</label>
                            @if ($errors->has('keterangan'))
                                <textarea class="form-control is-invalid" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                            @else
                                <textarea class="form-control" name="keterangan" rows="3"></textarea>
                            @endif
                            <div class="invalid-feedback">
                                {{ $errors->first('keterangan') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{ route('permintaan.list') }}">
                                <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#toggle_reffPermintaan').change(function() {
                if ($(this).is(':checked')) {
                    $('#reffPermintaan').show();
                } else {
                    $('#reffPermintaan').hide();
                }
            });
        });
    </script>
@endsection
