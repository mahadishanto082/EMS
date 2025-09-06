@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('_css')
<style>
.animated-greeting {
  opacity: 0;
  transform: translateX(-20px);
  animation: fadeSlideIn 1.5s forwards;
  
  font-weight: bold;
  font-size: 2rem;
  color: #333;
}

@keyframes fadeSlideIn {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}
</style>

@endsection

@section('page-info')
<div style="display: flex; align-items: center; position: relative; height: 60px;">
  <h1 class="animated-greeting" style="margin: 0 auto; text-align: center; flex: 1;">
    Welcome back, Admin!
  </h1>
  <div class="date" style="position: absolute; right: 0; font-weight: bold;">
    {{ date('l, d M Y') }} <br>
    {{ date('h:i A') }}
  </div>
</div>


    <div class="br-pagetitle">
   
        <i class="icon ion-ios-home-outline"></i>
        
        <div>
            <h4>Dashboard</h4>
            <p class="mg-b-0">Here is today's information</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-info rounded overflow-hidden">
                <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                    <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                    <div class="mg-l-20">
                    <p class="tx-12 tx-uppercase tx-white-8">Total Visits</p>
                    <h3 class="tx-lato tx-white mg-b-0">12,345</h3> <!-- Replace with dynamic value -->
                </div>
                    
                </div>
                <div id="ch1" class="ht-50 tr-y-1"></div>
            </div>
        </div><!-- col-3 -->



        <div class="col-sm-6 col-xl-3">
            <div class="bg-info rounded overflow-hidden">
                <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                    <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                    
                </div>
                <div id="ch1" class="ht-50 tr-y-1"></div>
            </div>
        </div><!-- col-3 -->

        <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-purple rounded overflow-hidden">
                <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                    <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                  
                </div>
                <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
        </div><!-- col-3 -->

        <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-purple rounded overflow-hidden">
                <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                    <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                   
                </div>
                <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
        </div><!-- col-3 -->
    </div>

    
@endsection
