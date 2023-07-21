@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('permintaan.formAdd') }}">
                            <button class="btn btn-primary btn-sm ms-auto">Buat Permintaan</button>
                        </a>
                        @if(Auth::user()->hasRole('optima'))
                            <a href="{{ route('permintaan.create.report') }}" style="margin-left: 5px">
                                <button type="submit"
                                    class="btn btn-outline-danger btn-sm btn-icon-only btn-tooltip"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Download PDF" data-container="body"
                                    data-animation="true">
                                        <i class="fa fa-download" style="font-size:12px;color:red"></i>
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tematik
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Permintaan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Permintaan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">LOP
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Reff</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$permintaan->isEmpty())
                                    @foreach ($permintaan as $item)
                                        @php
                                            $count = isset($LOPCount[$item->id]) ? $LOPCount[$item->id] : 0;
                                        @endphp
                                        <tr>
                                            <td class="align-middle text-left">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->tematik_permintaan }}</span>
                                            </td>

                                            <td class="align-middle text-left">
                                                <a href="{{ route('lop.formAdd', ['permintaan_id' => $item->id]) }}" class="icon-link icon-link-hover text-xs font-weight-bold">
                                                    {{ $item->nama_permintaan }}
                                                </a>
                                            </td>
                                            <td class="align-middle text-left">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->tanggal_permintaan)->format('j F Y') }}</span>
                                            </td>
                                            <td class="align-middle text-left flex items-center">
                                                @if ($count > 0)
                                                    <a href="{{ route('lop.list', ['id_permintaan' => $item->id]) }}">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $count }}</span>
                                                    </a>
                                                @else
                                                    <span class="text-secondary text-xs font-weight-bold">-</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-left">
                                                @if (!empty($item->no_nota_dinas) || !empty($item->refferal_permintaan))
                                                    <a href="{{ Storage::url('uploads/refferal_permintaan/' . $item->refferal_permintaan) }}" class="icon-link icon-link-hover text-xs font-weight-bold">
                                                        {{$item->no_nota_dinas}}
                                                    </a>
                                                @else
                                                    <span class="text-secondary text-xs font-weight-bold">-</span>
                                                @endif
                                            </td>
                                            <!-- Add more table cells for other fields -->
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="align-middle text-center" colspan="10">
                                            <span class="text-secondary text-xs font-weight-bold">List Permintaan
                                                Kosong</span>
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
@endsection
