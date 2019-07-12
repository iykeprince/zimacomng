import { SharedModule } from './../shared/shared.module';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AdsListComponent } from './ads-list/ads-list.component';
import { AdsListItemComponent } from './ads-list-item/ads-list-item.component';
import { AdsDetailComponent } from './ads-detail/ads-detail.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  { path: 'ads', component: AdsListComponent },
  { path: 'ads/:ads_id', component: AdsDetailComponent }
];

@NgModule({
  imports: [
    SharedModule,
    RouterModule.forChild(routes)
  ],
  declarations: [AdsListComponent, AdsListItemComponent, AdsDetailComponent]
})
export class AdsModule { }
