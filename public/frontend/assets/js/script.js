$(document).ready(function () {
    var navbar = $(".navbar");

    $(window).scroll(() => {
        var scrollPosition = $(this).scrollTop();

        if (scrollPosition > 300) {
            navbar.addClass("navbar-fixed");
        } else if (scrollPosition <= 0) {
            navbar.removeClass("navbar-fixed");
        }
    });
});

// $(document).ready(function () {
//   function initVivusForSvg() {
//     $(".mySvg").each(function () {
//       if (!$(this).data("vivusInitialized")) {
//         new Vivus(this, {
//           type: "delayed",
//           duration: 50,
//           start: "inViewport",
//         });
//         $(this).data("vivusInitialized", true);
//       }
//     });
//   }

//   initVivusForSvg();
// });
