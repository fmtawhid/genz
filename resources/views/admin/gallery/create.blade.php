@extends('layouts.admin_master')

@section('content')
<!-- Start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Add Gallery Item</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('gallery.list') }}" class="btn btn-primary"> Gallery List </a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- End page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Gallery Name -->
                        <!-- <div class="mb-3 col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" name="image" id="image" accept="image/*">
                            @error('image')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div> -->
                        <div class="mb-3 col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" name="image" id="image" accept="image/*">
                            @error('image')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image preview -->
                        <div class="img-container">
                            <img id="image-preview" src="#" alt="Your Image" style="max-width:100%; display:none;">
                        </div>

                        <!-- Cropped Image Preview -->
                        <div class="cropped-preview mt-3">
                            <h5>Cropped Image</h5>
                            <img id="cropped-image" src="#" alt="Cropped Image" style="max-width: 100%; display:none;">
                        </div>

                        <!-- Button to get the cropped image -->
                        <button id="get-cropped-image-btn" class="btn btn-primary mt-3">Get Cropped Image</button>

                        <!-- Cropping Library Scripts -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
                        <script>
                        let cropper;

                        document.getElementById('image').addEventListener('change', function(e) {
                            const file = e.target.files[0];
                            if (file) {
                                const reader = new FileReader();

                                reader.onload = function(event) {
                                    const image = document.getElementById('image-preview');
                                    image.src = event.target.result;
                                    image.style.display = 'block'; // Show the image preview
                                };

                                reader.readAsDataURL(file);
                            }
                        });

                        document.getElementById('image-preview').addEventListener('load', function() {
                            const image = document.getElementById('image-preview');

                            if (cropper) {
                                cropper.destroy();
                            }

                            cropper = new Cropper(image, {
                                aspectRatio: 1080 / 450,
                                viewMode: 1,
                                autoCropArea: 0.8,
                                responsive: true,
                                cropBoxResizable: true
                            });
                        });

                        function getCroppedImage() {
                            if (cropper) {
                                const canvas = cropper.getCroppedCanvas({
                                    width: 380,
                                    height: 200
                                });

                                const croppedImage = document.getElementById('cropped-image');
                                croppedImage.src = canvas.toDataURL();
                                croppedImage.style.display = 'block'; // Show cropped image
                            }
                        }

                        document.getElementById('get-cropped-image-btn').addEventListener('click', getCroppedImage);
                        </script>


                        <!-- Date -->
                        <div class="mb-3 col-md-6">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input class="form-control" name="date" value="{{ old('date') }}" type="date" id="date"
                                required>
                            @error('date')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Note (Optional) -->
                        <div class="mb-3 col-md-12">
                            <label for="note" class="form-label">Note (Optional)</label>
                            <textarea class="form-control" name="note" id="note" rows="4"
                                placeholder="Enter any additional note">{{ old('note') }}</textarea>
                            @error('note')
                            <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <!-- Submit Button -->
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
<!-- End row -->

@endsection