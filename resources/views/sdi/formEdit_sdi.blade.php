@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h3 class="text-black font-bold">Edit SDI</h3>
                    </div>
                </div>
                <div class="card-body px-5 py-2">
                    <form method="POST" action="{{ route('sdi.patch', ['id' => $sdi->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group has-validation">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ $sdi->username }}"
                                placeholder="Username">
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                        </div>
                        <div class="form-group has-validation">
                            <label for="">Email address</label>
                            <input type="email" class="form-control" name="email" value="{{ $sdi->email }}"
                                placeholder="example@example.com">
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-validation">
                                    <label for="">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="{{ $sdi->first_name }}"
                                        placeholder="First Name">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('first_name') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-validation">
                                    <label for="">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="{{ $sdi->last_name }}"
                                        placeholder="Last Name (Opsional)">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('last_name') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submitAction" class="btn btn-primary btn-sm"
                                value="toSurveyRab">Submit</button>
                            <a href="{{ route('sdi.list') }}">
                                <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
