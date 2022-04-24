@extends('backend.layouts.app')
@section('title')
    {{$user->ad}} {{$user->soyad}}
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route("backend.updatecustomer",$user->id)}}">
                        @csrf
                        <div class="mb-3">
                            <label for="aktif">Aktif:</label>
                            <select name="aktif" class="form-control">
                                @if($user->aktif=="1")
                                    <option value="1" selected>Aktif</option>
                                    <option value="0">Pasif</option>
                                @else
                                    <option value="0" selected>Pasif</option>
                                    <option value="1">Aktif</option>
                                @endif
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ad">Ad:</label>
                                    <input name="ad" type="text" class="form-control" value="{{$user->ad}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="soyad">Soyad:</label>
                                    <input name="soyad" type="text" class="form-control" value="{{$user->soyad}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tel">Telefon Numarası:</label>
                                    <input name="tel" type="text" class="form-control" value="{{$user->tel}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="eposta">Eposta:</label>
                                    <input name="eposta" type="email" class="form-control" value="{{$user->eposta}}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-success btn-lg">Kaydet</button>
                            <a href="{{route("backend.deletecustomer",$user->id)}}" class="btn btn-danger btn-lg">Sil</a>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
