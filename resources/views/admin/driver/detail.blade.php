@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    Detail Driver
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                {{-- profile --}}
                <div class="card">
                    <h5 class="card-header">User Info</h5>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('img/no_img.jpeg') }}" class="rounded-circle" alt="Cinque Terre" width="200"
                                height="200">
                        </div>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>Dogregertgretgertgrgergte</td>
                                </tr>
                                <tr>
                                    <td>email</td>
                                    <td>Dogregertgretgertgrgergte</td>
                                </tr>
                                <tr>
                                    <td>No Telepon</td>
                                    <td>Dooley</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>Dooley</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>Dooley</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                {{-- Data Driver --}}
                <div class="card">
                    <h5 class="card-header">Driver Info</h5>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>

                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

@section('css')

@stop

@section('js')

@stop
