@extends('components.layouts.website')
@section('title', 'Employee Profile')

@section('content')
<style>
/* Profile Page Styles */
.profile-bg {
  min-height: 85vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(-45deg, #001f54, #007bff, #b3e5fc, #ffffff);
    background-size: 400% 400%;
    animation: gradientBG 10s ease infinite;
}

</style>
<div class="profile-bg">
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Employee Profile</h3>
          </div>
          <div class="card-body">
           
          <div class="text-center mb-4">
    <i class="fa-solid fa-user-circle" style="font-size: 120px; color: #00AEEF;"></i>
</div>


            <table class="table table-borderless">
              <tbody>
                <tr>
                  <th scope="row">Name:</th>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Email:</th>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Phone:</th>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Position:</th>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Department:</th>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Date of Joining:</th>
                  <td></td>
                </tr>
                <tr></tr>
                  <th scope="row">Status</th>
                  <td></td>
               
              </tbody>
            </table>
            <div class="text-center mt-4">
              <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection