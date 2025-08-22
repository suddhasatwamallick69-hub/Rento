

<?php $__env->startSection('content'); ?>
 
 <div class="container-fluid" id="main-div">
   <div class="row">
      <div class="col-md-2 text-dark p-4 border-end border-4" style="max-height: 90vh;overflow-y: auto;scroll-behavior: smooth;scrollbar-width:none; scrollbar-color: #888 transparent;">
         <h3>Filter Vehicles</h3>
         <form id="filterForm">
             <div class="form-group">
                 <label for="carType">Vehicle Type:</label>
                 <div>
                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <h3><?php echo e($category->name); ?></h3>
                       <?php $__currentLoopData = $subcategories[$category->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <input type="checkbox" class="form-check-input search_category" id="search_category" name="categories[]" value="<?php echo e($subcategory->name); ?>">   <?php echo e($subcategory->name); ?><br>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                     
                 </div>
             </div>

             <div class="form-group mt-3">
                 <label for="fuelType">Fuel Type:</label>
                 <div>
                    <?php $__currentLoopData = $distinctFuelTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <input type="checkbox" class="form-check-input search_fuel_type" id="search_fuel_type" value="<?php echo e($item); ?>"> <?php echo e($item); ?><br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </div>
             </div>
           
      
             
         </form>
      </div>
       <!-- gallery section start -->
       <div class="col-md-10">
               <div class="container-fluid mt-2" style="background-color:transparent;box-shadow: 2px 2px #727272;">
                  <?php if($errors->any()): ?>
                   <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <div class="alert alert-danger mt-2"><?php echo e($error); ?></div>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
                <form action="<?php echo e(route('listofvehicles')); ?>" method="get">
                    
                  <div class="row"> 
                     <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" onclick="detectLocation()"><i class="bi bi-geo-alt-fill"></i></button>
                            </div>
                            <div class="col-md-10">
                                <div class="form-floating">
                                    <input type="text" id="location" name="location" placeholder="Location" value="<?php echo e($location); ?>" class="form-control" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    <label for="address">Location</label>
                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Search Location</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                   <div class="row">
                                                      <div class="form-floating">
                                                         <input type="text" id="address" name="location" autocomplete="off" placeholder="location" value="<?php echo e($location); ?>" class="form-control">
                                                         <label for="address">Location</label>
                                                      </div>
                                                        <div class="suggestions" id="suggestions"></div>
                                                        
                                                        <p><button type="button" onclick="detectMyLocation()" class="btn btn-warning"><i class="bi bi-geo-alt-fill"></i> Current Location</button></p>
                                                   </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning" >Set Location</button>
                                              </div>
                                          </div>
                                        </div>
                                      </div>  
                                </div>
                                <p><input type="hidden" id="latitude" name="latitude" placeholder="Location" value="<?php echo e($latitude); ?>" class="form-control"></p>
                                <p><input type="hidden" id="longitude" name="longitude" placeholder="Location" value="<?php echo e($longitude); ?>" class="form-control"></p>
                            </div>
                        </div>
                        
                     </div>
                     <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" id="pickupPicker" name="pickup" placeholder="Select Date & Time" value="<?php echo e($pickup); ?>" class="form-control">
                            <label for="pickupPicker">Pickup</label>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" name="dropoff" id="dropoffPicker" value="<?php echo e($dropoff); ?>" class="form-control">
                            <label for="dropoffPicker">Dropoff</label>
                        </div>
                     </div>
                     
                  </div>
                </form>
               </div>
               <div class="container-fluid" style="padding-top:40px;padding-bottom:30px;max-height: 80vh;overflow-y: auto;scroll-behavior: smooth;scrollbar-width:none; scrollbar-color: #888 transparent;">
                <div class="row gy-5" id="results">
                    <h3>Showing <?php echo e($numberOfRows); ?>  Vehicles</h3>
                    <?php if($vehicles->isEmpty()): ?>
                        <div class="alert alert-warning">No vehicles available nearby for the selected time and location.</div>
                    <?php else: ?>
                    <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                       $images=$item->images;
                       $images=explode(",",$images);
                       $carouselId = "carousel_".$item->id;
                    ?>
                    <div class="col-md-4">
                        <form action="<?php echo e(route('booking')); ?>" method="get">
                            
                       <div class="gallery_box">
                          <div class="gallery_img">
                             <div id="<?php echo e($carouselId); ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                  
                                  <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="carousel-item <?php if($index == 0): ?> active <?php endif; ?>">
                                       <a href="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" target="blank"> <img src="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" style="height: 220px" class="d-block w-100" alt="..."></a>
                                    </div>
                                    
                                    <?php echo e($active=''); ?>

                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo e($carouselId); ?>" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#<?php echo e($carouselId); ?>" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden"></span>
                                </button>
                             </div>
                             
                          </div>
                          <div class="row">
                             <div class="col-sm-7">
                                <h5 class="types_text"><?php echo e($item->model_name); ?></h5>
                             </div>
                             <div class="col-sm-5 d-flex justify-content-start">
                                 <?php $__currentLoopData = $vrate[$item->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="vrate">₹ <?php echo e($rate->rate_per_hour); ?>/ hr</p>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                             </div>
                             <hr>
                             <div class="col-sm-7">
                                <p class="" style="margin: 0%"><?php echo e($item->fuel_type); ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                 <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                               </svg><?php echo e($item->category); ?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                 <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                               </svg> <?php echo e($item->capacity); ?> seats </p>
                             </div>
                             <div class="col-sm-5">
                                <p class="" style="margin: 0%"><i class="bi bi-person-walking"></i><?php echo e(round($item->distance, 2)); ?> km away</p>
                             </div>
                          </div>
                          <input type="hidden" name="bid" value="<?php echo e($item->id); ?>">
                          <input type="hidden" name="duration" value="<?php echo e($duration); ?>">
                          <input type="hidden" name="pickup" value="<?php echo e($pickup); ?>" class="form-control">
                          <input type="hidden" name="dropoff" value="<?php echo e($dropoff); ?>" class="form-control">
                          <input type="hidden" name="latitude" value="<?php echo e($latitude); ?>" class="form-control">
                          <input type="hidden" name="longitude" value="<?php echo e($longitude); ?>" class="form-control">
                          
                          <div class="read_bt"><input type="submit" class="btn btn-warning" value="Book Now"></div>
                                   
                       </div>
                       </form>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                
               </div>
       </div>
   </div>
 </div>
 <script>
   $(document).ready(function () {
      var pickup = $("input[name='pickup']").val();  // Get pickup value
      var dropoff = $("input[name='dropoff']").val();
      var duration = $("input[name='duration']").val();
      var latitude = $("input[name='latitude']").val();
      var longitude = $("input[name='longitude']").val();
            $('.search_category').on('change', function () 
            {
                var selectedCategories = [];
                $('.search_category:checked').each(function () 
                {
                    selectedCategories.push($(this).val());
                });
                console.log(selectedCategories);
                console.log(pickup);
                console.log(dropoff);
                console.log(duration);
                console.log(latitude);
                console.log(longitude);
                if (selectedCategories.length === 0) {
                    location.reload(); // This will refresh the page to show original results
                    return;
                  }

                $.ajax({
                    url: "<?php echo e(route('search_category')); ?>",
                    method: "POST",
                    data: { _token: $('meta[name="csrf-token"]').attr('content'),categories: selectedCategories,pickup:pickup,dropoff:dropoff ,duration:duration ,latitude:latitude,longitude:longitude
                    },
                    success: function (response) {
                     if (response.trim() === "") {
                         location.reload(); // If no results, reload the original page
                     } else {
                         $('#results').html(response); // Update with filtered results
                         console.log(response);
                        }
                    }
                });
               
            });

            $('.search_fuel_type').on('change', function () 
            {
                var selected_fuel_type = [];
                $('.search_fuel_type:checked').each(function () 
                {
                    selected_fuel_type.push($(this).val());
                });
                console.log(selected_fuel_type);
                console.log(pickup);
                console.log(dropoff);
                console.log(duration);
                console.log(latitude);
                console.log(longitude);
                if (selected_fuel_type.length === 0) {
                    location.reload(); // This will refresh the page to show original results
                    return;
                  }

                $.ajax({
                    url: "<?php echo e(route('search_by_fuel_type')); ?>",
                    method: "POST",
                    data: { _token: $('meta[name="csrf-token"]').attr('content'),selected_fuel_type: selected_fuel_type,pickup:pickup,dropoff:dropoff ,duration:duration ,latitude:latitude,longitude:longitude
                    },
                    success: function (response) {
                     if (response.trim() === "") {
                         location.reload(); // If no results, reload the original page
                     } else {
                         $('#results').html(response); // Update with filtered results
                         console.log(response);
                        }
                    }
                });
               
            });
        });
 </script>

<script>
   let now = new Date();
   let currentHour = now.getHours();
flatpickr("#pickupPicker", {
    enableTime: true, 
    dateFormat: "Y-m-d H:i", 
    defaultDate: "<?php echo e($pickup); ?>", // Load Blade variable
    minDate: "today",
    minuteIncrement: 60 , // Restrict minutes (only hours selectable)
    altInput: true,
    altFormat: "j M'y, h K",
    maxTime: "23:00",
});

flatpickr("#dropoffPicker", {
    enableTime: true, 
    dateFormat: "Y-m-d H:i", 
    defaultDate: "<?php echo e($dropoff); ?>",
    minDate: "<?php echo e($pickup); ?>",  // Ensure drop-off is after pickup
    minuteIncrement: 60,
    altInput: true,
    altFormat: "j M'y, h K",
    maxTime: "23:00",
});
</script>

<script>
   function detectLocation() {
       
           navigator.geolocation.getCurrentPosition(function (position) {
            navigator.geolocation.getCurrentPosition(console.log, console.error)
               document.getElementById('latitude').value = position.coords.latitude;
               document.getElementById('longitude').value = position.coords.longitude;
               getAddressFromCoordinates(position.coords.latitude, position.coords.longitude);
           }, function (error) {
               console.error('Error obtaining location', error);
               alert('Error obtaining location. Please enter coordinates manually.');
           },{
               enableHighAccuracy: true,
               timeout: 10000,
               maximumAge: 0
            });
   }

   function getAddressFromCoordinates(latitude, longitude) {
       var url = 'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + encodeURIComponent(latitude) + '&lon=' + encodeURIComponent(longitude) + '&addressdetails=1';

       fetch(url, {
           headers: {
               'Referer': window.location.origin // Comply with Nominatim's usage policy
           }
       })
       .then(response => {
           if (!response.ok) {
               throw new Error('Error retrieving address');
           }
           return response.json();
       })
       .then(data => {
           var address = data.display_name;
           document.getElementById('location').value = address;
           document.getElementById('address').value = address;
       })
       .catch(error => {
           console.error(error);
           alert('Error retrieving address. Please try again.');
       });
   }

   document.getElementById('latitude').addEventListener('blur', function () {
       var lat = this.value;
       var lon = document.getElementById('longitude').value;
       if (lat && lon) {
           getAddressFromCoordinates(lat, lon);
       }
   });

   document.getElementById('longitude').addEventListener('blur', function () {
       var lon = this.value;
       var lat = document.getElementById('latitude').value;
       if (lat && lon) {
           getAddressFromCoordinates(lat, lon);
       }
   });
</script>

<script>
    const apiKey = '11cced8fe8ed4e289a1cb54dd621bdb2';
    const input = document.getElementById('address');
    const suggestionsContainer = document.getElementById('suggestions');
 
    // Autocomplete functionality
    input.addEventListener('input', () => {
      const query = input.value.trim();
 
      if (query.length < 3) {
        suggestionsContainer.innerHTML = '';
        return;
      }
 
      const url = `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(query)}&limit=5&apiKey=${apiKey}`;
 
      fetch(url)
        .then(response => response.json())
        .then(data => {
          suggestionsContainer.innerHTML = '';
          data.features.forEach(feature => {
            const item = document.createElement('div');
            item.className = 'suggestion';
            item.textContent = feature.properties.formatted;
 
            item.onclick = () => {
              const address = feature.properties.formatted;
              const lat = feature.properties.lat;
              const lon = feature.properties.lon;
 
              input.value = address;
              document.getElementById('location').value = address;
              document.getElementById('latitude').value = lat;
              document.getElementById('longitude').value = lon;
              suggestionsContainer.innerHTML = '';
            };
 
            suggestionsContainer.appendChild(item);
          });
        })
        .catch(error => {
          console.error('Error fetching autocomplete:', error);
        });
    });
 
    document.addEventListener('click', (e) => {
      if (!suggestionsContainer.contains(e.target) && e.target !== input) {
        suggestionsContainer.innerHTML = '';
      }
    });
 
    // Detect current location and reverse geocode it
    function detectMyLocation() {
      if (!navigator.geolocation) {
        alert('Geolocation is not supported by your browser.');
        return;
      }
 
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const lat = position.coords.latitude;
          const lon = position.coords.longitude;
 
          // Update lat/lon fields
          document.getElementById('latitude').value = lat;
          document.getElementById('longitude').value = lon;
 
          // Reverse geocode to get the address
          const reverseUrl = `https://api.geoapify.com/v1/geocode/reverse?lat=${lat}&lon=${lon}&apiKey=${apiKey}`;
 
          fetch(reverseUrl)
            .then(response => response.json())
            .then(data => {
              if (data.features && data.features.length > 0) {
                const address = data.features[0].properties.formatted;
                document.getElementById('address').value = address;
                document.getElementById('location').value = address;
              } else {
                document.getElementById('address').value = 'Address not found';
                document.getElementById('location').value = '';
              }
            })
            .catch(err => {
              console.error('Reverse geocoding error:', err);
            });
        },
        (error) => {
          console.error('Geolocation error:', error);
          alert('Could not retrieve your location.');
        }
      );
    }
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    Vehicles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('hideFooter'); ?>
<!-- This section triggers the footer removal -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/vehicles.blade.php ENDPATH**/ ?>