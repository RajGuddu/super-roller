$('.banner-slider').owlCarousel({
  loop: true,
  margin: 0,
  nav: true,
  dots: false,
  center: false,
  autoplay: true,
  autoplayTimeout: 3000,
  autoplayHoverPause: true,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
      center: true,
      nav: false,
    },
    768: {
      items: 1,
      nav: true,
    },
    1000: {
      items: 1,
      loop: true,
    }
  }
});

$('.abound-slide').owlCarousel({
  loop: true,
  margin: 20,
  nav: true,
  dots: false,
  center: true,
  autoplay: true,
  autoplayTimeout: 2000,
  autoplayHoverPause: true,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
      center: true,
      nav: false,
    },
    768: {
      items: 3.5,
      center: false,
      nav: true,
    },
    1000: {
      items: 5.5,
      loop: true,
      center: false,
    }
  }
});

$('.timeshare-slide').owlCarousel( {
  autoplay: true,
  center: true,
  loop: true,
  nav: true,
  items: 3,
  margin: 30,
  dots:false,
  autoplayTimeout: 8500,
  smartSpeed: 450,
  responsive: {
    0: {
      items: 1
    },
    768: {
      items: 1
    },
    1170: {
      items: 1.3
    }
  }
});

$('#client-testimonials').owlCarousel( {
    loop: true,
    center: true,
    items: 3,
    margin: 30,
    autoplay: true,
    dots:false,
    nav:true,
    autoplayTimeout: 8500,
    smartSpeed: 450,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 1
      },
      1170: {
        items: 1
      }
    }
  });