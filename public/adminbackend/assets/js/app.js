$(function () {
  "use strict";
  $(window).on("load", function () {
      $("#preloader-active").delay(450).fadeOut("slow");
      $("body").delay(50).css({
          overflow: "visible",
      });
      $("#onloadModal").modal("show");
  });
  new PerfectScrollbar(".header-message-list"),
      new PerfectScrollbar(".header-notifications-list"),
      $(".mobile-search-icon").on("click", function () {
          $(".search-bar").addClass("full-search-bar");
      }),
      $(".search-close").on("click", function () {
          $(".search-bar").removeClass("full-search-bar");
      }),
      $(".mobile-toggle-menu").on("click", function () {
          $(".wrapper").addClass("toggled");
      }),
      $(".toggle-icon").click(function () {
          $(".wrapper").hasClass("toggled")
              ? ($(".wrapper").removeClass("toggled"),
                $(".sidebar-wrapper").unbind("hover"))
              : ($(".wrapper").addClass("toggled"),
                $(".sidebar-wrapper").hover(
                    function () {
                        $(".wrapper").addClass("sidebar-hovered");
                    },
                    function () {
                        $(".wrapper").removeClass("sidebar-hovered");
                    }
                ));
      }),
      $(document).ready(function () {
          $(window).on("scroll", function () {
              $(this).scrollTop() > 300
                  ? $(".back-to-top").fadeIn()
                  : $(".back-to-top").fadeOut();
          }),
              $(".back-to-top").on("click", function () {
                  return (
                      $("html, body").animate(
                          {
                              scrollTop: 0,
                          },
                          600
                      ),
                      !1
                  );
              });
      }),
      $(function () {
          for (
              var e = window.location,
                  o = $(".metismenu li a")
                      .filter(function () {
                          return this.href == e;
                      })
                      .addClass("")
                      .parent()
                      .addClass("mm-active");
              o.is("li");

          )
              o = o
                  .parent("")
                  .addClass("mm-show")
                  .parent("")
                  .addClass("mm-active");
      }),
      $(function () {
          $("#menu").metisMenu();
      }),
      $(".chat-toggle-btn").on("click", function () {
          $(".chat-wrapper").toggleClass("chat-toggled");
      }),
      $(".chat-toggle-btn-mobile").on("click", function () {
          $(".chat-wrapper").removeClass("chat-toggled");
      }),
      $(".email-toggle-btn").on("click", function () {
          $(".email-wrapper").toggleClass("email-toggled");
      }),
      $(".email-toggle-btn-mobile").on("click", function () {
          $(".email-wrapper").removeClass("email-toggled");
      }),
      $(".compose-mail-btn").on("click", function () {
          $(".compose-mail-popup").show();
      }),
      $(".compose-mail-close").on("click", function () {
          $(".compose-mail-popup").hide();
      }),
      $(".switcher-btn").on("click", function () {
          $(".switcher-wrapper").toggleClass("switcher-toggled");
      });

  $(".close-switcher").on("click", function () {
      $(".switcher-wrapper").removeClass("switcher-toggled");
  });

  $("#lightmode").on("click", function () {
      $("html").attr("class", "light-theme");
      localStorage.setItem("theme", "light-theme");
  });

  $("#darkmode").on("click", function () {
      $("html").attr("class", "dark-theme");
      localStorage.setItem("theme", "dark-theme");
  });

  $("#semidark").on("click", function () {
      $("html").attr("class", "semi-dark");
      localStorage.setItem("theme", "semi-dark");
  });

  $("#minimaltheme").on("click", function () {
      $("html").attr("class", "minimal-theme");
      localStorage.setItem("theme", "minimal-theme");
  });

  $("#headercolor1").on("click", function () {
      $("html")
          .addClass("color-header headercolor1")
          .removeClass(
              "headercolor2 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8"
          );
      localStorage.setItem("headerColor", "headercolor1");
  });

  $("#headercolor2").on("click", function () {
      $("html")
          .addClass("color-header headercolor2")
          .removeClass(
              "headercolor1 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8"
          );
      localStorage.setItem("headerColor", "headercolor2");
  });

  $("#headercolor3").on("click", function () {
      $("html")
          .addClass("color-header headercolor3")
          .removeClass(
              "headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8"
          );
      localStorage.setItem("headerColor", "headercolor3");
  });

  $("#headercolor4").on("click", function () {
      $("html")
          .addClass("color-header headercolor4")
          .removeClass(
              "headercolor1 headercolor2 headercolor3 headercolor5 headercolor6 headercolor7 headercolor8"
          );
      localStorage.setItem("headerColor", "headercolor4");
  });

  $("#headercolor5").on("click", function () {
      $("html")
          .addClass("color-header headercolor5")
          .removeClass(
              "headercolor1 headercolor2 headercolor4 headercolor3 headercolor6 headercolor7 headercolor8"
          );
      localStorage.setItem("headerColor", "headercolor5");
  });

  $("#headercolor6").on("click", function () {
      $("html")
          .addClass("color-header headercolor6")
          .removeClass(
              "headercolor1 headercolor2 headercolor4 headercolor5 headercolor3 headercolor7 headercolor8"
          );
      localStorage.setItem("headerColor", "headercolor6");
  });

  $("#headercolor7").on("click", function () {
      $("html")
          .addClass("color-header headercolor7")
          .removeClass(
              "headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor3 headercolor8"
          );
      localStorage.setItem("headerColor", "headercolor7");
  });

  $("#headercolor8").on("click", function () {
      $("html")
          .addClass("color-header headercolor8")
          .removeClass(
              "headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor3"
          );
      localStorage.setItem("headerColor", "headercolor8");
  });

  $("#sidebarcolor1").on("click", function () {
      $("html")
          .addClass("color-sidebar sidebarcolor1")
          .removeClass(
              "sidebarcolor2 sidebarcolor3 sidebarcolor4 sidebarcolor5 sidebarcolor6 sidebarcolor7 sidebarcolor8"
          );
      localStorage.setItem("sidebarColor", "sidebarcolor1");
  });

  $("#sidebarcolor2").on("click", function () {
      $("html")
          .addClass("color-sidebar sidebarcolor2")
          .removeClass(
              "sidebarcolor1 sidebarcolor3 sidebarcolor4 sidebarcolor5 sidebarcolor6 sidebarcolor7 sidebarcolor8"
          );
      localStorage.setItem("sidebarColor", "sidebarcolor2");
  });

  $("#sidebarcolor3").on("click", function () {
      $("html")
          .addClass("color-sidebar sidebarcolor3")
          .removeClass(
              "sidebarcolor1 sidebarcolor2 sidebarcolor4 sidebarcolor5 sidebarcolor6 sidebarcolor7 sidebarcolor8"
          );
      localStorage.setItem("sidebarColor", "sidebarcolor3");
  });

  $("#sidebarcolor4").on("click", function () {
      $("html")
          .addClass("color-sidebar sidebarcolor4")
          .removeClass(
              "sidebarcolor1 sidebarcolor2 sidebarcolor3 sidebarcolor5 sidebarcolor6 sidebarcolor7 sidebarcolor8"
          );
      localStorage.setItem("sidebarColor", "sidebarcolor4");
  });

  $("#sidebarcolor5").on("click", function () {
      $("html")
          .addClass("color-sidebar sidebarcolor5")
          .removeClass(
              "sidebarcolor1 sidebarcolor2 sidebarcolor4 sidebarcolor3 sidebarcolor6 sidebarcolor7 sidebarcolor8"
          );
      localStorage.setItem("sidebarColor", "sidebarcolor5");
  });

  $("#sidebarcolor6").on("click", function () {
      $("html")
          .addClass("color-sidebar sidebarcolor6")
          .removeClass(
              "sidebarcolor1 sidebarcolor2 sidebarcolor4 sidebarcolor5 sidebarcolor3 sidebarcolor7 sidebarcolor8"
          );
      localStorage.setItem("sidebarColor", "sidebarcolor6");
  });

  $("#sidebarcolor7").on("click", function () {
      $("html")
          .addClass("color-sidebar sidebarcolor7")
          .removeClass(
              "sidebarcolor1 sidebarcolor2 sidebarcolor4 sidebarcolor5 sidebarcolor6 sidebarcolor3 sidebarcolor8"
          );
      localStorage.setItem("sidebarColor", "sidebarcolor7");
  });

  $("#sidebarcolor8").on("click", function () {
      $("html")
          .addClass("color-sidebar sidebarcolor8")
          .removeClass(
              "sidebarcolor1 sidebarcolor2 sidebarcolor4 sidebarcolor5 sidebarcolor6 sidebarcolor7 sidebarcolor3"
          );
      localStorage.setItem("sidebarColor", "sidebarcolor8");
  });

  // Apply stored theme and colors on page load
  $(document).ready(function () {
      var storedTheme = localStorage.getItem("theme");
      var storedHeaderColor = localStorage.getItem("headerColor");
      var storedSidebarColor = localStorage.getItem("sidebarColor");

      if (storedTheme) {
          $("html").attr("class", storedTheme);
      }

      if (storedHeaderColor) {
          $("html").addClass("color-header " + storedHeaderColor);
      }

      if (storedSidebarColor) {
          $("html").addClass("color-sidebar " + storedSidebarColor);
      }
  });
});
