
 
<?php $__env->startSection('content'); ?>
    <!-- banner section start --> 
    <div class="banner_section layout_padding">
      <div class="container" style="margin-left:140px">
         <div class="row">
            <div class="col-md-5">
               <div class="banner_taital_main">
                  <form action="<?php echo e(route('ins_search')); ?>" method="post">
                     <?php echo csrf_field(); ?>
                     <h1 class="banner_taital">Self-drive car rentals in <span style="color: #ffd900;">Kolkata</span></h1>
                     <!-- <p class="banner_text">There are many variations of passages of Lorem Ipsum available, but the majority</p> -->
                      <div class="row mb-2">
                        <div class="col-md-12">
                           <div class="form-floating">
                              <input type="text" id="location" name="location" placeholder="location" value="53, Sarat Bose Rd, Paddapukur, Bhowanipore, Kolkata, West Bengal 700025, India" class="form-control" data-toggle="modal" data-target=".bd-example-modal-lg" readonly>
                              <label for="location">Location</label>
                            </div>

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
                                                <input type="text" id="address" name="location" autocomplete="off" placeholder="location" value="53, Sarat Bose Rd, Paddapukur, Bhowanipore, Kolkata, West Bengal 700025, India" class="form-control">
                                                <label for="address">Location</label>
                                             </div>
                                               <div class="suggestions" id="suggestions"></div>
                                               <input type="hidden" name="latitude" id="latitude" value="22.530287834213436"  />
                                               <input type="hidden" name="longitude" id="longitude" value="88.35265714234222"/>
                                               <p><button type="button" onclick="detectMyLocation()" class="btn btn-warning"><i class="bi bi-geo-alt-fill"></i> Current Location</button></p>
                                          </div>
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-warning" data-dismiss="modal">Set Location</button>
                                     </div>
                                 </div>
                               </div>
                             </div>                         
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                           <div class="form-floating">
                              <input type="text" id="pickupPicker" name="pickup" placeholder="Select Date & Time" value="<?php echo e($pickup); ?>" class="form-control">
                              <label for="pickupPicker">Pickup</label>
                            </div>  
                        </div>
                        <div class="col-md-6">
                           <div class="form-floating">
                              <input type="text" name="dropoff" id="dropoffPicker" value="<?php echo e($dropoff); ?>" class="form-control">
                              <label for="dropoffPicker">Dropoff</label>
                            </div>  
                           
                        </div>
                        
                      </div>
                      <?php if($errors->any()): ?>
                   <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <div class="alert alert-danger mt-2"><?php echo e($error); ?></div>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
                     <div class="btn_main">
                        <div class="contact_bt w-100"><input type="submit" class="a" value="Search"></div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-md-7">
               <div class="banner_img"><img src="images/banner-img.png"></div>
            </div>
         </div>
      </div>
   </div>
   <!-- banner section end -->
   <!-- about section start -->
   
   <!-- choose section start -->
   <div class="choose_section layout_padding">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h1 class="choose_taital">WHY CHOOSE US</h1>
            </div>
         </div>
         <div class="choose_section_2">
            <div class="row">
               <div class="col-sm-4">
                  <div class="icon_1"><img src="images/icon-1.png"></div>
                  <h4 class="safety_text">SAFETY & SECURITY</h4>
                  <p class="ipsum_text">variations of passages of Lorem Ipsum available, but the majority have </p>
               </div>
               <div class="col-sm-4">
                  <div class="icon_1"><img src="images/icon-2.png"></div>
                  <h4 class="safety_text">Online Booking</h4>
                  <p class="ipsum_text">variations of passages of Lorem Ipsum available, but the majority have </p>
               </div>
               <div class="col-sm-4">
                  <div class="icon_1"><img src="images/icon-3.png"></div>
                  <h4 class="safety_text">Verified Hosts</h4>
                  <p class="ipsum_text">variations of passages of Lorem Ipsum available, but the majority have </p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- choose section end -->

   <!-- become a host section start -->
   <div class="host_section layout_padding">
      <div class="container" >
         <div class="row">
            <div class="col-md-7">
               <h3 class="host_section_heading">Become a Host</h3>
               <p style="margin: 0%">Join our community of hosts and start earning money today!</p>
            </div>
            <div class="col-md-12 mt-5">
               <a href="<?php echo e(route('host')); ?>" class="host_section_btn">Become a Host</a>
            </div>
         </div>
      </div>
   </div>
   
   <!-- contact section start -->
   <div class="contact_section layout_padding" id="contact">
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <h1 class="contact_taital">Get In Touch</h1>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="contact_section_2">
            <div class="row">
               <div class="col-md-12">
                  <div class="mail_section_1">
                     <input type="text" class="mail_text" placeholder="Name" name="Name">
                     <input type="text" class="mail_text" placeholder="Email" name="Email">
                     <input type="text" class="mail_text" placeholder="Phone Number" name="Phone Number">
                     <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                     <div class="send_bt"><a href="">Send</a></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

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


      
      
   <!-- contact section end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    Home
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/index.blade.php ENDPATH**/ ?>