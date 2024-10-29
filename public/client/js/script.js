$(document).ready(function(){


  let data = localStorage.getItem('panel-theme-dark-light')

  if(data != undefined){
    if(data == 'dark'){
      $('#page-change-bg-color').css('background-color', '#140d0d')
      $('.text-css-dark-light').css('color', '#f9f9f9')
      $('.footer-centered').css('background-color', '#140d0d')
    }
  }else{

  }
    $(".slider-demo").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 500,
        autoplaySpeed: 5000,
        autoplay: true,
        centerMode: true,
        centerPadding: "0",
        arrows: true,
        dots: false,
        focusOnSelect: true,
        touchMove: true,
        responsive: [
            {
                breakpoint: 900,
                settings: {
                    centerMode: true,
                    centerPadding: '0',
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: true,
                }
            },
            {
                breakpoint: 570,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                }
            },

            // Thêm các điều chỉnh khác tùy thuộc vào kích thước màn hình
        ],
    });
    $(window).on('load resize', function() {
        $('.slider-demo').slick('refresh');
    });


    $('.slider-demo-demo').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      touchMove: true,
      dots: true, // Hiển thị thanh chuyển
      speed: 500,
      arrows: true,
        autoplaySpeed: 5000,
      responsive: [
        {
          breakpoint: 1000,
          settings: {
            centerMode: true,
            centerPadding: '0',
            slidesToShow: 2
          }
        },
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '0',
            slidesToShow: 2
          }
        }
        // Thêm các điều chỉnh khác tùy thuộc vào kích thước màn hình
      ]
    });

    $('.slider-demo-demo .slick-slide').on('click', function(ev){
      let data = $(ev.currentTarget).find( ".thumb-ruby__sub_slide_upcoming" )
      let element = data[0];
      let title = $(element).attr('data-title');
      let desc = $(element).attr('data-desc');
      $('.select-upcoming-title').text(title)
      $('.select-upcoming-content').text(desc)
      $('.slider-demo-demo').find( ".change-color-text" ).removeClass("change-color-text")


        let dataTitle = $(ev.currentTarget).find( ".thumb-ruby__title_slide_upcoming" )[0]
      $(dataTitle).addClass('change-color-text')


  });

    // $('.carousel-mobile').carousel({
    //     interval: 5000,
    //     touch: true
    // })

  $('.carousel').carousel({
    interval: 5000,
      touch: true
  })




    $('.owl-carousel').slick({
      dots: true,
      autoplay: true,
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      speed: 300,
      autoplaySpeed: 5000,
      arrows: true,
      dots: false,
      focusOnSelect: true,
      touchMove: true,
      prevArrow:'<button class="prev-arrow"></button>',
    nextArrow:'<button class="next-arrow"></button>',
  });



    $( "#color-panel .panel-button" ).click(function(){
			$( "#color-panel" ).toggleClass( "close-color-panel", "open-color-panel", 1000 );
			$( "#color-panel" ).toggleClass( "open-color-panel", "close-color-panel", 1000 );
			return false;
		});

    $('#color-panel-light').click(function(e) {
      localStorage.setItem('panel-theme-dark-light', 'light')
      // toggle classes
      $('#page-change-bg-color').css('background-color', '')
      $('.text-css-dark-light').css('color', '')
      $('.footer-centered').css('background-color', '')
      // set background-image when clicked
    })

    $('#color-panel-dark').click(function(e) {
      localStorage.setItem('panel-theme-dark-light', 'dark')
      // toggle classes
      $('#page-change-bg-color').css('background-color', '#140d0d')
      $('.text-css-dark-light').css('color', '#f9f9f9')
      $('.footer-centered').css('background-color', '#140d0d')
      // set background-image when clicked
    })


    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })

    var header = $(".rd-navbar");

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        // Kiểm tra nếu cuộn xuống đủ khoảng cần thiết
        if (scroll >= 50) {
            header.css("height", "100px"); // Đặt kích thước mới
        } else {
            header.css("height", "210px"); // Kích thước ban đầu
        }
    });

    setTimeout(() => {
        $('.loading-page').css('display', 'none')
    }, 1000)
  });
