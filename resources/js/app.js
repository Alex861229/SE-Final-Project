
require('./bootstrap');

window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import * as VueGoogleMaps from 'vue2-google-maps'
import axios from "axios";

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCtM3X8domwSOC9JQBfy1NoP02mUy6RnHQ'
    },
});



const app = new Vue({
    el: '#app',
    data(){
    	return{
    		restaurents: [],
    		infoWindowOptions: {
    			pixelOffset: {
    				width: 0,
    				height: -35
    			}

    		},
    		activeRestaurent: {},
    		infoWindowOpened: false,
            markers: [],
            palcetype : "cafe",
            
    	}
    },
    created() {
        axios.get('/api/getSite')
            .then((response) => this.restaurents = response.data)
            .catch((error) => console.error(error));
    },
    methods: {
    	getPosition(r){
    		return{
    			lat: parseFloat(r.latitude),
    			lng: parseFloat(r.longitude)
    		}
           
    	},
    	handleMarkerClicked(r) {
            //小bug，先將未正常關閉的InfoWindow關閉就ok了
            this.handleInfoWindowClose();

    		this.activeRestaurent = r; 
    		this.infoWindowOpened = true;
    	},
    	handleInfoWindowClose() {
    		this.activeRestaurent = {}; 
    		this.infoWindowOpened = false;

            this.deleteNearbyMarker();                                    
            this.markers = [];

    	},
        handleNearby(r){
            
            this.activeRestaurent = r;

            // 全部一串都只需要包含在一對重音符號 eg,.`your string`裡，不再需要切開、合起一堆字串碎片。
            // 當你想要包含變數或者算式在字串裡時，你只需要將它放在 ${變數} 裡。
            //https://cors-anywhere.herokuapp.com類似proxy
            const URL = `https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=${r.latitude},${r.longitude}&type=${this.palcetype}&radius=5000&key=AIzaSyCtM3X8domwSOC9JQBfy1NoP02mUy6RnHQ`;
            
            //處理json資料
            //如果需要其他資料，也是從這邊取得
            //尚須處理status為""ZERO_RESULTS"的情況；"OK"時才往下做
            axios.get(URL)
                 .then(response => {
                    this.places = response.data.results;
                    this.places.forEach((place) => {
                        var lat = place.geometry.location.lat;
                        var lng = place.geometry.location.lng;

                        //直接做座標資料處理貌似會有overflow問題，我先四捨五入進小數點後6位
                        lat = lat.toFixed(6);
                        lng = lng.toFixed(6);

                        const latlng = new google.maps.LatLng(lat, lng);
                        
                        let marker = new google.maps.Marker({
                                position: new google.maps.LatLng(lat, lng),

                                //icon:顯示欲標在地圖上的圖案,"orange-dot"可以換成別的,dot就是圖案裡面會有一個點
                                icon: { 
                                    url: 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png'                             
                                }, 

                            });

                        //將marker加入到markers陣列，再丟到map上
                        this.markers.push(marker);
                        this.$refs.mapRef.$mapPromise.then((map) => {
                                    marker.setMap(map);                                            
                        });                 
                    })
                 })
                 .catch(error => {console.log(error.message); });
        },
        deleteNearbyMarker(){
             for (var i = 0; i< this.markers.length; i++) {
                this.markers[i].setMap(null);
            }      
        },
    },
    computed: {
        mapCenter() {
            if (!this.restaurents.length) {
                return {
                    lat: 10,
                    lng: 10
                }
            }

            return {
                lat: parseFloat(this.restaurents[0].latitude),
                lng: parseFloat(this.restaurents[0].longitude)
            }
        },
        infoWindowPosition() {
        	return {
    			lat: parseFloat(this.activeRestaurent.latitude),
    			lng: parseFloat(this.activeRestaurent.longitude),
    		};
    	},
    },
});
