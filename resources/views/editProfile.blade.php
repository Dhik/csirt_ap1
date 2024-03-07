@extends('layout.' . auth()->user()->role_user  . 'Layout')
@section('title', 'Edit Profile')
@section('content')

<div class="container-fluid pt-4 px-4" >
    <div class="col-8 mx-auto bg-light rounded h-100 p-4 editProfile" >
        <h2 class="mb-4 text-center">Edit Profile</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        

        <form action="{{ auth()->check() ? route('updateProfil', ['id' => auth()->user()->id]) : '#' }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <!-- Left column for profile picture and upload button -->
                    <div class="mb-3 text-center" style="display: flex; flex-direction: column; align-items: center;">
                        <div id="image-preview" style="margin-bottom: 20px;">
                            @if(auth()->user()->profile_picture)
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" class="img-fluid" alt="Profile Picture" style="max-width: 100%;">
                            @else
                                <p>No profile picture available</p>
                            @endif
                        </div>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" onchange="previewImage()">
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Right column for other profile details -->
                    <div class="mb-3">
                        <label for="nama_user">Full Name</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" value="{{ auth()->user()->nama_user }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="old_password">Old Password</label>
                        <input type="password" class="form-control @if(session('error_oldPass')) is-invalid @endif" id="old_password" name="old_password">
                        @if(session('error_oldPass'))
                            <div class="text-danger">
                                {{ session('error_oldPass') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control @if(session('error_newPass')) is-invalid @endif id="new_password" name="new_password" >
                        @if(session('error_newPass'))
                            <div class="text-danger">
                                {{ session('error_newPass') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>

<script>
    function previewImage() {
        const fileInput = document.getElementById('profile_picture');
        const imagePreview = document.getElementById('image-preview');
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" alt="Profile Picture" style="max-width: 100%;">`;
            };

            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '<p>No profile picture available</p>';
        }
    }
</script>

@endsection
