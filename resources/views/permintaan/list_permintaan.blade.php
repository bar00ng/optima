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
                                @foreach ($permintaan as $item)
                                    <tr>
                                        <td class="align-middle text-left">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $item->tematik_permintaan }}</span>
                                        </td>

                                        <td class="align-middle text-left">
                                            <a href="{{ route('lop.formAdd', ['id' => $item->id]) }}">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->nama_permintaan }}</span>
                                            </a>
                                        </td>
                                        <td class="align-middle text-left">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->tanggal_permintaan)->format('j F Y') }}</span>
                                        </td>
                                        <td class="align-middle text-left flex items-center">
                                            <span class="text-secondary text-xs font-weight-bold">-</span>
                                        </td>
                                        <td class="align-middle text-left">
                                            <span class="text-secondary text-xs font-weight-bold">-</span>
                                        </td>
                                        <!-- Add more table cells for other fields -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
