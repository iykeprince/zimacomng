import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CategoriesSectionComponent } from './categories-section/categories-section.component';
import { BannerSectionComponent } from './banner-section/banner-section.component';
import { LatestAdsSectionComponent } from './latest-ads-section/latest-ads-section.component';
import { FeaturedAdsSectionComponent } from './featured-ads-section/featured-ads-section.component';
import { ZimaTicketSectionComponent } from './zima-ticket-section/zima-ticket-section.component';
import { ZimaShopSectionComponent } from './zima-shop-section/zima-shop-section.component';
import { TestimonialSectionComponent } from './testimonial-section/testimonial-section.component';
import { FavouriteShopLocationSectionComponent } from './favourite-shop-location-section/favourite-shop-location-section.component';
import { OwlModule } from 'ngx-owl-carousel';

@NgModule({
  imports: [
    CommonModule,
    OwlModule
  ],
  declarations: [CategoriesSectionComponent, BannerSectionComponent, LatestAdsSectionComponent, FeaturedAdsSectionComponent, ZimaTicketSectionComponent, ZimaShopSectionComponent, TestimonialSectionComponent, FavouriteShopLocationSectionComponent],
  exports: [CategoriesSectionComponent, BannerSectionComponent, LatestAdsSectionComponent, FeaturedAdsSectionComponent, ZimaTicketSectionComponent, ZimaShopSectionComponent, TestimonialSectionComponent, FavouriteShopLocationSectionComponent]
})
export class SectionModule { }