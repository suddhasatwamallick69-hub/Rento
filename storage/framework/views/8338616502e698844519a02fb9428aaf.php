<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php if($errors->any()): ?>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="alert alert-danger" role="alert">
                        <?php echo e($error); ?>

                      </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
    <form action="<?php echo e(route('ins_hostvehicle')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <p><input type="text" name="name" placeholder="Host Name"></p>
        <p><input type="number" name="phone_number" placeholder="Host phone number"></p>
        <p><input type="email" name="email" id="" placeholder="Host email"></p>
        <p><textarea name="address" id="" cols="30" rows="10" placeholder="Host address"></textarea></p>
        <hr>
        <p><input type="text" name="model_name" placeholder="Car Model"></p>
        <p><select class="form-select" id="floatingSelect" name="category" aria-label="Parent Category">
            <option selected>--Select Vehicle Category--</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <optgroup label="<?php echo e($category->name); ?>"></optgroup>
                 <?php $__currentLoopData = $subcategories[$category->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($subcategory->name); ?>"><?php echo e($subcategory->name); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select></p>
        <p><select class="form-select" id="floatingSelect" name="fuel_type" aria-label="Parent Category">
            <option selected>--Select FuelType--</option>
            <option value="Petrol">Petrol</option>
            <option value="Gasoline">Gasoline</option>
            <option value="Diesel">Diesel</option>
            <option value="Electric">Electric</option>
            <option value="Manual/Hand-powered">Manual/Hand-powered</option>
          </select></p>
          <p><input type="text" name="capacity" placeholder="Vehicle capacity"></p>
        <p><input type="text" name="registration_number" placeholder="Car Registration Number"></p>
        <p>RC certificate<input type="file" name="registration_certificate"></p>

        <p>aadhar_card<input type="file" name="aadhar_card"></p>

        <p>driving_license<input type="file" name="driving_license" id=""></p>
        <hr>
        <p>Bank Account Details</p>
        <p><input type="text" name="account_number" placeholder="Host Account Number"></p>
        <p><input type="text" name="IFSC" placeholder="Account IFSC Code"></p>
        <hr>
        <p>Upload Host Vehicle Images</p>
        <p><input type="file" name="images[]" multiple id="images"></p>
        <div id="preview"></div>
        
        <p><a href="">Hosting Terms and Conditions </a><input type="checkbox" name="" id=""></p>

        <p><input type="submit" value="submit" class="bg-yellow-400 hover:bg-yellow-600"></p>
    </form>

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
      
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host_vehicle.blade.php ENDPATH**/ ?>