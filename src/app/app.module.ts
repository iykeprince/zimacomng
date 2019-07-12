import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { AdsModule } from './ads/ads.module';
import { CategoryModule } from './category/category.module';
import { HomeModule } from './home/home.module';
import { AuthModule } from './auth/auth.module';
import { SharedModule } from './shared/shared.module';

@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule,
    RouterModule.forRoot([]),
    SharedModule,
    AuthModule,
    HomeModule,
    CategoryModule,
    AdsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
