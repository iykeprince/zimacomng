import { Component, OnInit } from '@angular/core';
declare var $: any;

@Component({
  selector: 'app-featured-ads-section',
  templateUrl: './featured-ads-section.component.html',
  styleUrls: ['./featured-ads-section.component.css']
})
export class FeaturedAdsSectionComponent implements OnInit {

  constructor() { }

  ngOnInit() {
    // ______________Owl-carousel-icons2
	var owl = $('.owl-carousel-icons2');
	owl.owlCarousel({
		loop: true,
		rewind: true,
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
