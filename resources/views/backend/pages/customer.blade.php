@extends('backend.layouts.app')
@section('title')
    Müşteriler
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Müşteriler</h4>

                    <div class="table-responsive">
                        <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                            <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Ad</th>
                                <th>Soyad</th>
                                <th>Telefon Numarası</th>
                                <th>Eposta</th>
                            </tr>
                            </thead><!-- end thead -->
                            <tbody>
                            @foreach($users as $index=>$user)
                                <tr>
                                    <td><a href="{{route("backend.customerdetail",$user->id)}}" class="text-black">#{{$index+1}}</a></td>
                                    <td><h6 class="mb-0"><a  class="text-black" href="{{route("backend.customerdetail",$user->id)}}">{{$user->ad}}</a></h6></td>
                                    <td><h6 class="mb-0"><a  class="text-black" href="{{route("backend.customerdetail",$user->id)}}">{{$user->soyad}}</a></h6></td>
                                    <td>
                                        {{$user->tel}}
                                    </td>
                                    <td>
                                        {{$user->eposta}}
                                    </td>
                                </tr>
                            @endforeach

                            <!-- end -->
                            </tbody><!-- end tbody -->
                            <caption>
                                <div class="d-flex justify-content-end">

                                    {{$users->links()}}
                                </div>

                            </caption>
                        </table> <!-- end table -->
                    </div>
                </div><!-- end card -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
