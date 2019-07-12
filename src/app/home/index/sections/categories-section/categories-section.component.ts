import { Component, OnInit } from '@angular/core';
declare var $: any;

@Component({
  selector: 'app-categories-section',
  templateUrl: './categories-section.component.html',
  styleUrls: ['./categories-section.component.css']
})
export class CategoriesSectionComponent implements OnInit {

  categoryImages = [
    "assets/images/products/categories/furniture.png",
    "assets/images/products/categories/electronics.png",
    "assets/images/products/categories/loan.png",
    "assets/images/products/categories/delivery-truck.png",
    "assets/images/products/categories/call-center.png",
    "assets/images/products/categories/makeover.png",
    "assets/images/products/categories/graduation.png",
    "assets/images/products/categories/mobile.png",
    "assets/images/products/categories/sketch.png",
    "assets/images/products/categories/pets.png",
    "assets/images/products/categories/app.png"
  ];

  mySlideOptions={items: 1, dots: true, nav: false};
  myCarouselOptions={items: 3, dots: true, nav: true};

  constructor() { }

  ngOnInit() {
    // ______________Owl-carousel-icons2
    var owl = $('.owl-carousel-icons2');
    owl.owlCarousel({
      loop: true,
      rewind: false,
      margin: 25,
      animateIn: 'fadeInDowm',
      animateOut: 'fadeOutDown',
      autoplayTimeout: 5000, // set value to change speed
      autoplayHoverPause: true,
      dots: false,
      nav: true,
      autoplay: true,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: true
        },
        600: {
          items: 2,
          nav: true
        },
        1300: {
          items: 4,
          nav: true
        }
      }
    })
  }

}
