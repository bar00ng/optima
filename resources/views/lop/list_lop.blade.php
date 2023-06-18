@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Anggaran</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Progress</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($lop))
                                    @foreach ($lop as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div> &nbsp;</div>
                                                    <div class="my-auto">
                                                        <h6 class="mb-0 text-sm">{{ $item->nama_lop }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>

                                                <p class="text-sm font-weight-bold mb-0">
                                                    @if ($item->rab_ondesk !== '')
                                                      @if(strpos($item->keterangan_rab, 'dari 20 Jt') == false)
                                                        {{ 'Rp ' . number_format($item->rab_ondesk, 0, '.', '.') }}
                                                      @else
                                                        {{ $item->rab_ondesk }}
                                                      @endif
                                                    @else
                                                        {{ '-' }}
                                                    @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 'Survey + RAB')
                                                    <a href="{{ route('lop.formSurvey', ['lop_id' => $item->id]) }}">
                                                        <span class="text-xs font-weight-bold">Survey + RAB</span>
                                                    </a>
                                                @elseif($item->status == 'Alokasi Mitra')
                                                    <a href="{{ route('lop.formAlokasiMitra', ['lop_id' => $item->id]) }}">
                                                        <span class="text-xs font-weight-bold">Alokasi Mitra</span>
                                                    </a>
                                                @elseif($item->status == 'Persiapan')
                                                    <span class="text-xs font-weight-bold">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center"> <span
                                                        class="me-2 text-xs font-weight-bold">60%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-info" role="progressbar"
                                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                                style="width: 60%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="dropdown"> <a href="#"
                                                        class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown"
                                                        id="navbarDropdownMenuLink2"><i
                                                            class="fa fa-ellipsis-v text-xs"></i></a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                                        <li> <a class="dropdown-item" href="{{ route('konstruksi', ['lop_id' => $item->id]) }}">Konstruksi</a></li>
                                                        <li> <a class="dropdown-item" href="{{ route('go-live', ['lop_id' => $item->id]) }}">GoLive ODP</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="align-middle text-center" colspan="4">
                                            <span class="text-secondary text-xs font-weight-bold">List LOP Kosong</span>
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
