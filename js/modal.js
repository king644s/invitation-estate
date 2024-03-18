// // project image modal

// // Get the modal
// var modal = document.getElementById("myModal");

// // Get the image and insert it inside the modal - use its "alt" text as a caption
// var img = document.getElementById("myImg");
// var modalImg = document.getElementById("img01");
// var captionText = document.getElementById("caption");
// img.onclick = function () {
//   modal.style.display = "block";
//   modalImg.src = this.src;
//   captionText.innerHTML = this.alt;
// };

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks on <span> (x), close the modal
// span.onclick = function () {
//   modal.style.display = "none";
// };

document.addEventListener("DOMContentLoaded", function () {
  // Your code here
  // Get all images with the class 'img-fluid'
  var images = document.querySelectorAll(".modal-img");

  // Loop through each image
  images.forEach(function (img) {
    // Get the modal corresponding to the image
    var modalId = img.getAttribute("data-target");
    var modal = document.getElementById(modalId);
    // Get the modal content elements
    var modalImg = modal.querySelector(".modal-content");
    var captionText = modal.querySelector("#caption");

    // Get the <span> element that closes the modal
    var span = modal.querySelector(".close");

    // When the user clicks on the image, open the modal
    img.onclick = function () {
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
  });
});
