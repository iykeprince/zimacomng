import { SharedModule } from './../shared/shared.module';
import { NgModule } from '@angular/core';
import { CategoryListComponent } from './category-list/category-list.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  { path: 'categories', component: CategoryListComponent }
];

@NgModule({
  imports: [
    SharedModule,
    RouterModule.forChild(routes)
  ],
  declarations: [CategoryListComponent]
})
export class CategoryModule { }
