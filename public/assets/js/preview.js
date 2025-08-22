
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