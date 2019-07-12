import { Component, OnInit } from '@angular/core';
declare var $: any;

@Component({
  selector: 'app-testimonial-section',
  templateUrl: './testimonial-section.component.html',
  styleUrls: ['./testimonial-section.component.css']
})
export class TestimonialSectionComponent implements OnInit {

  constructor() { }

  ngOnInit() {
    // ______________Testimonial-owl-carousel
    var owl = $('.testimonial-owl-carousel');
    owl.owlCarousel({
      loop: true,
      rewind: false,
      margin: 25,
      animateIn: 'fadeInDowm',
      animateOut: 'fadeOutDown',
      autoplay: false,
      autoplayTimeout: 5000, // set value to change speed
      autoplayHoverPause: true,
      dots: false,
      nav: true,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: true
        }
      }
    })

    /*---End Owl-carousel----*/

  }

}
