jQuery(document).ready(function($){
  var toggleMenu = function() {
    var $menu = $('#navbar'),
        $trigger = $('#trigger'),
        toggleClass = "active";
    $trigger.on('click', function(e){
      e.preventDefault();
      $menu.toggleClass(toggleClass);
      $trigger.toggleClass(toggleClass);
    });
  };
  var subMenuSlide = function() {
    var $submenu = $('.submenu'),
        $menu = $('.nav-main'),
        toggleClass = "active",
        submenuToggle = ".toggle-submenu",
        $submenuToggle = $(".toggle-submenu"),
        $submenuClose = $(".close-submenu");

    $submenuToggle.on('click', function(e) {
      e.preventDefault();
      $menu.toggleClass(toggleClass);
      $('#'+$(this).data('submenu')).toggleClass(toggleClass);
    });
    $submenuClose.on('click', function(e){
      e.preventDefault();
      $menu.toggleClass(toggleClass);
      $('#'+$(this).data('submenu')).toggleClass(toggleClass);
    });

  };
  var brandListToggle = function() {
    $('#brand-list-toggle').on('click', function(e) {
      e.preventDefault();
      $('#brands-list').slideToggle();
      $('#brands-list .default-list').slideToggle();
    });
  };
  toggleMenu();
  subMenuSlide();
  brandListToggle();
  $('.projects-related').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: false,
    centerMode: true,
    infinite: true,
    responsive: [
      {
        breakpoint: 2000,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      ]
  });
  $('.large-image-list').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.small-image-list'
  });
  $('.small-image-list').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: '.large-image-list',
    centerMode: true,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 2000,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      ]
  });
  $('#employees').slick({
    slidesToShow: 4,
    infinite: false,
    arrows: false,
    responsive: [
  {
    breakpoint: 2000,
    settings: {
      slidesToShow: 3,
      slidesToScroll: 3,
    }
  },
  {
    breakpoint: 1200,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2
    }
  },
  {
    breakpoint: 1024,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1
    }
  }
]
  });
});
