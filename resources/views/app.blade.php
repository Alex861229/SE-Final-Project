<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel google map demo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 1rem 2rem;
            }

        </style>
    </head>

    <body>
        <div class="flex-center position-ref full-height">
           
            <div class="content">
               <h2>Restaurants</h2>
            </div>

               <div class="map" id="app" >
                    <gmap-map 
                    ref="mapRef"
                    :center="mapCenter"
                    :zoom="10"
                    style="width: 100%; height:440px;"
                    >
                        <gmap-info-window
                            :options="infoWindowOptions"
                            :position="infoWindowPosition"
                            :opened="infoWindowOpened"
                            @closeclick="handleInfoWindowClose"
                        >
                            <div class="info-window">
                                <h2 v-text="activeRestaurent.latitude"></h2>
                                <h2 v-text="activeRestaurent.longitude"></h2>
                                <h2 v-text="activeRestaurent.name"></h2>
                                <h5 v-text="'Hours: ' + activeRestaurent.hours"></h5>
                                <p v-text="activeRestaurent.address"></p>
                                <p v-text="activeRestaurent.city + ', ' + activeRestaurent.state"></p>
                            </div>
                        </gmap-info-window>
                        <gmap-marker
                        v-for="(r, index) in restaurents"
                        :key="r.id"
                        :position="getPosition(r)"
                        :clickable="true"
                        :draggable="false"
                        @click="handleMarkerClicked(r);handleNearby(r)"
                        >                        
                        </gmap-marker>                   
                    </gmap-map>                                        
               </div>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
