@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Anggaran Terpakai</p>
                                <h5 class="font-weight-bolder"> {{ 'Rp ' . number_format($anggaranTerpakai, 0) }} </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle"> <i
                                    class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">List of Projects</p>
                                <h5 class="font-weight-bolder"> {{ $listOfProject }} </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle"> <i
                                    class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">List Permintaan</p>
                                <h5 class="font-weight-bolder"> +{{ $listPermintaan }} </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle"> <i
                                    class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4 class="text-black font-bold">Sedang Berjalan</h4>
                </div>
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
                                @if (!$lop->isEmpty())
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
                                                        @if (strpos($item->keterangan_rab, 'dari 20 Jt') == false)
                                                            {{ 'Rp ' . number_format($item->rab_ondesk, 0, '.', '.') }}
                                                        @else
                                                            {{ $item->rab_ondesk }}
                                                        @endif
                                                    @else
                                                        {{ '-' }}
                                                    @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 'Alokasi Mitra')
                                                    @if (empty($item->mitra_id))
                                                        @if (Auth::user()->hasRole(['admin', 'optima']))
                                                            <a
                                                                href="{{ route('lop.formAlokasiMitra', ['lop_id' => $item->id]) }}">
                                                                <span class="badge badge-pill bg-gradient-danger">Belum
                                                                    Pilih
                                                                    Mitra</span>
                                                            </a>
                                                        @else
                                                            <span class="badge badge-pill bg-gradient-danger">Belum Pilih
                                                                Mitra</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-pill bg-gradient-success">Sudah Pilih
                                                            Mitra</span>
                                                    @endif
                                                @elseif ($item->status == 'Survey + RAB')
                                                    @if (empty($item->rabApproval))
                                                        @if (Auth::user()->hasRole(['optima', 'mitra', 'sdi']))
                                                            <a href="{{ route('lop.formSurvey', ['lop_id' => $item->id]) }}">
                                                                <span class="badge badge-pill bg-gradient-danger">Belum
                                                                    Survey</span>
                                                            </a>
                                                        @else
                                                            <span class="badge badge-pill bg-gradient-danger">Belum
                                                                Survey</span>
                                                        @endif
                                                    @elseif($item->rabApproval->isApproved == 0 && $item->rabApproval->created_at == $item->rabApproval->updated_at)
                                                        <span class="badge badge-pill bg-gradient-warning">Menunggu
                                                            Approval</span>
                                                    @elseif($item->rabApproval->isApproved == 0 && $item->rabApproval->created_at != $item->rabApproval->updated_at)
                                                        <span class="badge badge-pill bg-gradient-warning">RAB not
                                                            Approved</span>
                                                    @elseif($item->rabApproval->isApproved == 1)
                                                        <span class="badge badge-pill bg-gradient-success">RAB
                                                            Approved</span>
                                                    @endif
                                                @elseif ($item->status == 'Selesai')
                                                    <span class="badge badge-pill bg-gradient-success">Selesai</span>
                                                @elseif ($item->status == 'Persiapan')
                                                    <span class="badge badge-pill bg-gradient-primary">Persiapan</span>
                                                @else
                                                    <span class="badge badge-pill bg-gradient-secondary">{{$item->status}}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($item->status == 'Persiapan')
                                                    <div class="d-flex align-items-center justify-content-center"> <span
                                                            class="me-2 text-xs font-weight-bold">20%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-info"
                                                                    role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                                    aria-valuemax="100" style="width: 20%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif ($item->status == 'Instalasi')
                                                    <div class="d-flex align-items-center justify-content-center"> <span
                                                            class="me-2 text-xs font-weight-bold">50%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-info"
                                                                    role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="100" style="width: 50%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif ($item->status == 'GoLive' || $item->status == 'Selesai' || $item->status == 'Selesai Fisik')
                                                    <div class="d-flex align-items-center justify-content-center"> <span
                                                            class="me-2 text-xs font-weight-bold">100%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-info"
                                                                    role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                                    aria-valuemax="100" style="width: 100%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center"> <span
                                                            class="me-2 text-xs font-weight-bold">0%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-info"
                                                                    role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                                    aria-valuemax="100" style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($item->status == 'Survey + RAB' && Auth::user()->hasRole(['admin', 'optima']) && !empty($item->rabApproval))
                                                        @if ($item->rabApproval->isApproved == 0)
                                                            <form
                                                                action="{{ route('lop.approveRab', ['approved' => 'true', 'lop_id' => $item->id]) }}"
                                                                method="post" style="margin-right: 5px">
                                                                @method('PATCH')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-outline-success btn-sm btn-icon-only btn-tooltip"
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="Approve RAB" data-container="body"
                                                                    data-animation="true">&#10003;</button>
                                                            </form>

                                                            <form
                                                                action="{{ route('lop.approveRab', ['approved' => 'false', 'lop_id' => $item->id]) }}"
                                                                method="post" style="margin-right: 5px">
                                                                @method('PATCH')
                                                                @csrf
                                                                <button type="submit"
                                                                class="btn btn-outline-danger btn-sm btn-icon-only btn-tooltip"
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="Reject RAB" data-container="body"
                                                                    data-animation="true">&#10007;</button>
                                                            </form>
                                                        @endif
                                                    @endif

                                                    @if (Auth::user()->hasRole(['optima', 'mitra']))
                                                        @if ($item->status == 'Persiapan' || $item->status == 'Instalasi' || $item->status == 'Selesai Fisik' ||  $item->status == 'GoLive')
                                                            <a href="{{ route('lop.konstruksi', ['lop_id' => $item->id]) }}">
                                                                <button type="button" class="btn btn-outline-primary btn-sm"
                                                                    style="margin-right: 5px">Konstruksi</button>
                                                            </a>
                                                        @endif
                                                    @endif

                                                    @if (Auth::user()->hasRole(['optima', 'sdi']))
                                                        @if ($item->status == 'Persiapan' || $item->status == 'Instalasi' || $item->status == 'Selesai Fisik' ||  $item->status == 'GoLive')
                                                            <a href="{{ route('lop.go-live', ['lop_id' => $item->id]) }}">
                                                                <button type="button"
                                                                    class="btn btn-outline-secondary btn-sm"
                                                                    style="margin-right: 5px">GoLive</button>
                                                            </a>
                                                        @endif
                                                    @endif

                                                    <!-- view info LOP -->
                                                    <!-- Toggle Modal -->
                                                    <button type="button"
                                                        class="btn btn-outline-info btn-sm btn-icon-only"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal-{{ $item->id }}">&#128065;</button>
                                                    <!-- Modal box -->
                                                    <div class="modal fade" id="exampleModal-{{ $item->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        {{ $item->nama_lop }}</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body container">
                                                                    <dl class="row">
                                                                        <dt class="col-sm-4">Tgl. Permintaan</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ \Carbon\Carbon::parse($item->tanggal_permintaan)->format('j F Y') }}
                                                                        </dd>

                                                                        <dt class="col-sm-4">Tematik LOP</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->tematik_lop) ? $item->tematik_lop : '-' }}
                                                                        </dd>

                                                                        <dt class="col-sm-4">Estimasi RAB</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->estimasi_rab) ? $item->estimasi_rab : '-' }}
                                                                        </dd>

                                                                        <dt class="col-sm-4 text-truncate">STO</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->sto) ? $item->sto : '-' }}
                                                                        </dd>

                                                                        <dt class="col-sm-4 text-truncate">TiKor. LOP</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->longitude) ? $item->longitude : '-' }}
                                                                        </dd>

                                                                        <dt class="col-sm-4 text-truncate">&nbsp;</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->latitude) ? $item->latitude : '-' }}
                                                                        </dd>

                                                                        <dt class="col-sm-4 text-truncate">Lokasi LOP</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->lokasi_lop) ? $item->lokasi_lop : '-' }}
                                                                        </dd>

                                                                        <dt class="col-sm-4 text-truncate">Keterangan LOP
                                                                        </dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->keterangan_lop) ? $item->keterangan_lop : '-' }}
                                                                        </dd>

                                                                        <dt class="col-sm-4 text-truncate">Mitra</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->mitra_id) ? $item->user->first_name : '-' }}
                                                                        </dd>

                                                                        <dt class="col-sm-4 text-truncate">RAB OnDesk</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->rab_ondesk) ? $item->rab_ondesk : '-' }}
                                                                        </dd>

                                                                        <dt class="col-sm-4 text-truncate">Keterangan RAB
                                                                        </dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->keterangan_rab) ? $item->keterangan_rab : '-' }}
                                                                        </dd>

                                                                        <dt class="col-sm-4 text-truncate">Status</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ !empty($item->status) ? $item->status : '-' }}
                                                                        </dd>
                                                                    </dl>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn bg-gradient-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="align-middle text-center" colspan="10">
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
