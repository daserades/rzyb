@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sözleşme Maddeleri Ekleme') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('sipsozmad.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="turkce" class="col-md-4 col-form-label text-md-right">{{ __('Türkçe') }}</label>

                            <div class="col-md-6">
                                <textarea id="turkce" type="text" class="form-control @error('turkce') is-invalid @enderror" name="turkce" value="{{ old('turkce') }}" required autocomplete="turkce" autofocus rows="5">

                                @error('turkce')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="english" class="col-md-4 col-form-label text-md-right">{{ __('English') }}</label>

                            <div class="col-md-6">
                                <textarea id="english" type="text" class="form-control @error('english') is-invalid @enderror" name="english" value="{{ old('english') }}" required autocomplete="english" autofocus rows="5">

                                @error('english')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Sözleşme Maddesi Ekle') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
