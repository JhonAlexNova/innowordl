@extends('layouts.dash')
@section('title','Dashboard')
@section('content')
<div class="row">
    <div class="col-xl-3 col-xxl-6 col-sm-6">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="media align-items-center">
                    <span class="p-3 mr-3 border border-white rounded">
                        icono
                    </span>
                    <div class="media-body text-right">
                        <p class="fs-18 text-white mb-2">Interviews Schedule</p>
                        <span class="fs-48 text-white font-w600">86</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-xxl-6 col-sm-6">
        <div class="card bg-info">
            <div class="card-body">
                <div class="media align-items-center">
                    <span class="p-3 mr-3 border border-white rounded">
                        icono
                    </span>
                    <div class="media-body text-right">
                        <p class="fs-18 text-white mb-2">Application Sent</p>
                        <span class="fs-48 text-white font-w600">75</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-xxl-6 col-sm-6">
        <div class="card bg-success">
            <div class="card-body">
                <div class="media align-items-center">
                    <span class="p-3 mr-3 border border-white rounded">
                       icono
                    </span>
                    <div class="media-body text-right">
                        <p class="fs-18 text-white mb-2">Profile Viewed</p>
                        <span class="fs-48 text-white font-w600">45</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-xxl-6 col-sm-6">
        <div class="card bg-secondary">
            <div class="card-body">
                <div class="media align-items-center">
                    <span class="p-3 mr-3 border border-white rounded">
                        icono
                    </span>
                    <div class="media-body text-right">
                        <p class="fs-18 text-white mb-2">Unread Message</p>
                        <span class="fs-48 text-white font-w600">93</span>
                    </div>
                </div>
            </div>
        </div>
    </div>               
</div>
@endsection