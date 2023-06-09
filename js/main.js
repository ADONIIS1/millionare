// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main-admin");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};


  // $(document).ready(function () {
  //     $(function () {
  //         let navigation = document.querySelector(".navigation");
  //         let main = document.querySelector(".main");
  //         navigation.classList.toggle("active");
  //         main.classList.toggle("active");
  //     })
  // });

  $(document).ready(function () {
      $(function () {
          var path = window.location.href;
          $(".navigation ul li a").each(function () {
              if (this.href === path) {
                  $(this).parent().addClass("hovered");
              }
              else{
                  $(this).parent().removeClass("hovered");
              }
          });
      });
  })