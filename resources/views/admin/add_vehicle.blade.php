@extends('admin.layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Vehicle</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
          {{-- <li class="breadcrumb-item">Forms</li> --}}
          <li class="breadcrumb-item active">add vehicle</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Vehicle Details</h5>

              <!-- Floating Labels Form -->
              {{-- {{$subcategories}} --}}
              @if($errors->any())
              @foreach ($errors->all() as $error)
                  <div class="alert alert-danger" role="alert">
                    {{$error}}
                  </div>
              @endforeach
            @endif
              <form class="row g-3" action="{{route('addvehiclepost')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                  <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" name="category" aria-label="Parent Category">
                      <option selected>--Select Vehicle Category--</option>
                      @foreach ($categories as $category)
                          <optgroup label="{{$category->name}}"></optgroup>
                           @foreach ($subcategories[$category->id] as $subcategory)
                               <option value="{{$subcategory->name}}">{{$subcategory->name}}</option>
                           @endforeach                        
                      @endforeach
                    </select>
                    <label for="floatingSelect">Vehicle Category</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text"  name="model_name" class="form-control" id="floatingName" placeholder="Your Name">
                    <label for="floatingName">Vehicle Name (Model Name)</label>
                  </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <select class="form-select" id="floatingSelect" name="fuel_type" aria-label="Parent Category">
                        <option selected>--Select FuelType--</option>
                        <option value="Petrol">Petrol</option>
                        <option value="Gasoline">Gasoline</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Electric">Electric</option>
                        <option value="Manual/Hand-powered">Manual/Hand-powered</option>
                      </select>
                      <label for="floatingSelect">FuelType</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="capacity" id="floatingName" placeholder="Your Name">
                      <label for="floatingName">Payload</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingName" name="registration_number" placeholder="REGISTRATION No.">
                      <label for="floatingName">REGISTRATION No.</label>
                    </div>
                </div>
                <div class="col-md-8">
                  <label for="inputNumber" class="col-sm-2 col-form-label">RC Certificate</label>
                    <input class="form-control" type="file" name="registration_certificate">
                </div>
                <hr>
                <div id="preview"></div>
                <div class="col-md-12">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Vehicle Images Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="images[]" multiple id="images">
                  </div>
                </div>
                <hr>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>

        </div>
      </div>
    </section>
  </main>
  <script>
    
    document.addEventListener("DOMContentLoaded", function() {
        let imageInput = document.getElementById("images");
    
        if (imageInput) { // Ensure the element exists before accessing it
            imageInput.addEventListener("change", function(event) {
                let previewDiv = document.getElementById("preview");
                previewDiv.innerHTML = ""; // Clear previous previews
    
                Array.from(event.target.files).forEach((file) => {
                    if (file.type.startsWith("image/")) { // Ensure it's an image
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            let img = document.createElement("img");
                            img.src = e.target.result;
                            img.style.width = "100px"; // Set preview size
                            img.style.margin = "5px";
                            previewDiv.appendChild(img);
                        };
                        reader.readAsDataURL(file); // Convert to Base64
                    }
                });
            });
        } else {
            console.error("Image input field not found!");
        }
    });
  </script>
@endsection