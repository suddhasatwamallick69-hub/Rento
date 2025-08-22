
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 20px;
  }
  #suggestions {
    border: 1px solid #ccc;
    max-width: 1700px;
    position: absolute;
    background: white;
    z-index: 999;
  }
  .suggestion {
    padding: 5px;
    cursor: pointer;
  }
  .suggestion:hover {
    background-color: #f0f0f0;
  }
  #map {
    height: 400px;
    margin-top: 20px;
  }
</style>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <?php if($errors->any()): ?>
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo e($error); ?>

                  </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
    <form action="<?php echo e(route('ins_hostvehicle')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Host your car</h4>
              <div class="form-group">
                <label for="exampleInputName1">Car Model</label>
                <input type="text" class="form-control" id="exampleInputName1" name="model_name" placeholder="Car Model">
              </div>
              <div class="form-group">
                 <label for="exampleSelectGender">Car Category</label>
                  <select class="form-control" name="category" id="exampleSelectGender">
                    <option>--Select Vehicle Category--</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <optgroup label="<?php echo e($category->name); ?>"></optgroup>
                     <?php $__currentLoopData = $subcategories[$category->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($subcategory->name); ?>"><?php echo e($subcategory->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
              </div>
              <div class="form-group">
                <label for="exampleSelectGender">Car FuelType</label>
                  <select class="form-control" id="floatingSelect" name="fuel_type">
                    <option selected>--Select FuelType--</option>
                    <option value="Petrol">Petrol</option>
                    <option value="Gasoline">Gasoline</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Electric">Electric</option>
                    <option value="Manual/Hand-powered">Manual/Hand-powered</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail3">Vehicle capacity</label>
                <input type="text" class="form-control" id="exampleInputEmail3" name="capacity" placeholder="Vehicle capacity">
              </div>
              <!-- <div class="form-group">
                <label for="exampleInputEmail3">Car Registration Number</label>
                <input type="text" class="form-control" id="exampleInputEmail3" name="registration_number" placeholder="Car Registration Number">
              </div> -->
              <hr>
              <div class="form-group">
                <label>RC certificate (JPG,JPEG)</label>
                <input type="file" name="registration_certificate" class="form-control">
              </div>
              <div class="form-group">
                <label>Pollution Certificate</label>
                <input type="file" name="pollution_certificate" class="form-control">
              </div>

              <hr>
              
              <div class="form-group">
                <label>Upload Host Vehicle Images</label>
                <input type="file" name="images[]" multiple id="images" class="form-control">
              </div>
             <div id="preview"></div>
          </div>
        </div>
      </div>
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Personal info</h4>
              <p class="card-description">
              </p>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword4">Phone Number</label>
                        <input type="number" class="form-control" name="phone_number" placeholder="Host phone number">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="autocomplete">Search Address:</label>
                      <input type="text" id="autocomplete" class="form-control" placeholder="Start typing address..." autocomplete="off" />
                      <div id="suggestions"></div>
                      <input type="hidden" id="latitude" name="latitude" readonly />
                      <input type="hidden" id="longitude" name="longitude"  readonly />

                      <input type="hidden" id="street" name="street" readonly />

                     <input type="text" id="suburb" name="suburb" readonly />
                     <input type="hidden" id="city" name="city" readonly />
                    <input type="hidden" id="state" name="state" readonly />
                    <input type="hidden" id="pincode" name="pincode" readonly />
                      
                    </div>
                </div>
                <div class="col-md-12">
                  <div id="map"></div>
                  <label for="address">Address:</label>
                  <textarea class="form-control" type="text" name="address" id="address" readonly></textarea>
                </div>
                <hr>
              </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button type="reset" class="btn btn-light">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
  <script src="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js"></script>
  <script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.2.0"></script>
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
   <script>
    const apiKey = '11cced8fe8ed4e289a1cb54dd621bdb2';
    const map = new maplibregl.Map({
      container: 'map',
      style: `https://maps.geoapify.com/v1/styles/osm-carto/style.json?apiKey=${apiKey}`,
      center: [88.3639, 22.5726], // Kolkata
      zoom: 12
    });

    const input = document.getElementById('autocomplete');
    const suggestionsDiv = document.getElementById('suggestions');
    let marker;

    function updateAddressFields(properties, lat, lon) {
      document.getElementById('latitude').value = lat;
      document.getElementById('longitude').value = lon;
      document.getElementById('address').value = properties.formatted || '';
      document.getElementById('street').value = properties.street || '';
      document.getElementById('suburb').value = properties.suburb || '';
      document.getElementById('city').value = properties.city || '';
      document.getElementById('state').value = properties.state || '';
      document.getElementById('pincode').value = properties.postcode || '';
    }

    input.addEventListener('input', () => {
      const text = input.value.trim();
      if (text.length < 3) {
        suggestionsDiv.innerHTML = '';
        return;
      }

      fetch(`https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(text)}&apiKey=${apiKey}`)
        .then(response => response.json())
        .then(data => {
          suggestionsDiv.innerHTML = '';
          data.features.forEach(feature => {
            const div = document.createElement('div');
            div.className = 'suggestion';
            div.textContent = feature.properties.formatted;
            div.onclick = () => {
              const lat = feature.properties.lat;
              const lon = feature.properties.lon;

              input.value = feature.properties.formatted;
              updateAddressFields(feature.properties, lat, lon);
              map.flyTo({ center: [lon, lat], zoom: 15 });

              if (marker) marker.remove();
              marker = new maplibregl.Marker({ color: 'red' })
                .setLngLat([lon, lat])
                .addTo(map);

              suggestionsDiv.innerHTML = '';
            };
            suggestionsDiv.appendChild(div);
          });
        });
    });

    map.on('click', (e) => {
      const { lng, lat } = e.lngLat;

      fetch(`https://api.geoapify.com/v1/geocode/reverse?lat=${lat}&lon=${lng}&apiKey=${apiKey}`)
        .then(response => response.json())
        .then(data => {
          if (data.features.length > 0) {
            const properties = data.features[0].properties;
            updateAddressFields(properties, lat, lng);

            if (marker) marker.remove();
            marker = new maplibregl.Marker({ color: 'blue' })
              .setLngLat([lng, lat])
              .addTo(map);
          }
        });
    });

    document.addEventListener('click', (e) => {
      if (!suggestionsDiv.contains(e.target) && e.target !== input) {
        suggestionsDiv.innerHTML = '';
      }
    });
   </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('host.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host/host_vehicle.blade.php ENDPATH**/ ?>