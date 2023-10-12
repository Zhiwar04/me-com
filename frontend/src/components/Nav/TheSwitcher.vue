<script>
import $ from "jquery";

$(function () {
  ("use strict");
  $(window).on("load", function () {
    $("#preloader-active").delay(450).fadeOut("slow");
    $("body").delay(50).css({
      overflow: "visible",
    });
  });
  //   new PerfectScrollbar(".header-message-list"),
  //     new PerfectScrollbar(".header-notifications-list"),
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
        o = o.parent("").addClass("mm-show").parent("").addClass("mm-active");
    }),
    $(function () {
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
</script>
<template>
  <div class="switcher-wrapper">
    <div class="switcher-btn" @click="switcherToggle">
      <i class="bx bx-cog bx-spin"></i>
    </div>
    <div class="switcher-body">
      <div class="d-flex align-items-center">
        <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
        <button
          type="button"
          class="btn-close ms-auto close-switcher"
          aria-label="Close"
        ></button>
      </div>
      <hr />
      <h6 class="mb-0">Theme Styles</h6>
      <hr />
      <div class="d-flex align-items-center justify-content-between">
        <div class="form-check">
          <a id="lightmode">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="30"
              height="30"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="feather feather-sun animated sun"
            >
              <circle cx="12" cy="12" r="5"></circle>
              <line x1="12" y1="1" x2="12" y2="3"></line>
              <line x1="12" y1="21" x2="12" y2="23"></line>
              <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
              <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>

              <line x1="1" y1="12" x2="3" y2="12"></line>
              <line x1="21" y1="12" x2="23" y2="12"></line>
              <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
              <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
          </a>
        </div>
        <div class="form-check">
          <a id="darkmode">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="30"
              height="30"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="feather feather-moon animated bounceIn moon"
            >
              <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
          </a>
        </div>
        <div class="form-check">
          <img
            src="{{ asset('adminbackend/assets/images/icons/half-sun.png') }}"
            width="40"
            height="40"
            id="semidark"
            alt=""
          />
        </div>
      </div>
      <hr />
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="minimaltheme"
          name="flexRadioDefault"
        />
        <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
      </div>
      <hr />
      <h6 class="mb-0">Header Colors</h6>
      <hr />
      <div class="header-colors-indigators">
        <div class="row row-cols-auto g-3">
          <div class="col">
            <div class="indigator headercolor1" id="headercolor1"></div>
          </div>
          <div class="col">
            <div class="indigator headercolor2" id="headercolor2"></div>
          </div>
          <div class="col">
            <div class="indigator headercolor3" id="headercolor3"></div>
          </div>
          <div class="col">
            <div class="indigator headercolor4" id="headercolor4"></div>
          </div>
          <div class="col">
            <div class="indigator headercolor5" id="headercolor5"></div>
          </div>
          <div class="col">
            <div class="indigator headercolor6" id="headercolor6"></div>
          </div>
          <div class="col">
            <div class="indigator headercolor7" id="headercolor7"></div>
          </div>
          <div class="col">
            <div class="indigator headercolor8" id="headercolor8"></div>
          </div>
        </div>
      </div>

      <hr />
      <h6 class="mb-0">Sidebar Backgrounds</h6>
      <hr />
      <div class="header-colors-indigators">
        <div class="row row-cols-auto g-3">
          <div class="col">
            <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
          </div>
          <div class="col">
            <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
          </div>
          <div class="col">
            <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
          </div>
          <div class="col">
            <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
          </div>
          <div class="col">
            <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
          </div>
          <div class="col">
            <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
          </div>
          <div class="col">
            <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
          </div>
          <div class="col">
            <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
