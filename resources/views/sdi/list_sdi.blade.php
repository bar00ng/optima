@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('sdi.formAdd') }}">
                            <button class="btn btn-primary btn-sm ms-auto">Tambah SDI</button>
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama SDI
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sdi as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div> &nbsp;</div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">{{ ($item->last_name) ?  $item->first_name.' '.$item->last_name : $item->first_name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('sdi.edit', ['id' => $item->id]) }}">
                                                    <button type="button"
                                                        class="btn btn-outline-warning btn-sm btn-icon-only btn-tooltip"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Edit Mitra" data-container="body" data-animation="true"
                                                        style="margin-right: 5px;">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>

                                                <form action="{{ route('sdi.delete', ['id' => $item->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-sm btn-icon-only btn-tooltip"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Hapus Mitra" data-container="body" data-animation="true">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
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
