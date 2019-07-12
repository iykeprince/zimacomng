import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AdsService {

  constructor(private http: HttpClient) { }

  getAds(){
    return this.http.get('/php/ads/getLatestAds');
  }
}
