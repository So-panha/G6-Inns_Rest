<template>
  <div id="app">
    <div class="jumbotron">
      <div class="container-fluid">
        <div class="map-container">
          <div
            id="googleMap"
            style="height: 550px; width: 93%; border: 1px solid #ccc; margin-left: 150px"
          ></div>
          <form class="map-form" :class="{ expanded: formExpanded }">
            <div class="form-group" style="display: flex; align-items: center; margin-top: 5px">
              <span class="map-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path
                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                  />
                </svg>
              </span>
              <input
                v-model="from"
                type="text"
                id="from"
                placeholder="Enter origin"
                class="form-control map-input"
                style="width: 200px; margin-right: 10px"
                aria-label="Origin"
              />
              <input
                v-model="to"
                type="text"
                id="to"
                placeholder="Enter destination"
                class="form-control map-input"
                style="width: 200px; margin-right: 10px"
                aria-label="Destination"
              />
              <button @click.prevent="calcRoute" class="btn btn-primary map-button" id="cal">
                Calculate Route
              </button>
            </div>
          </form>
        </div>
        <!-- <div id="output" v-html="output" style="margin-top: 20px"></div> -->
      </div>
    </div>
    <!-- Cards component -->
    <card-service :houses="filteredHouses" @showOnMap="showHouseOnMap" />
  </div>
</template>

<script>
import CardService from '../Post/CardService.vue'
import axiosInstance from '@/plugins/axios'
import pinHome from '@/assets/pinHome.png'
import user from '@/assets/user.png'

export default {
  components: {
    CardService
  },

  data() {
    return {
      from: '',
      to: '',
      output: '',
      map: null,
      directionsService: null,
      directionsDisplay: null,
      userLocationMarker: null,
      markers: [],
      formExpanded: false,
      houses: [],
      filteredHouses: [] // To store filtered houses near the user
    }
  },

  mounted() {
    this.loadGoogleMaps()
  },

  computed: {
    filteredHouses() {
      return this.houses.filter((house) => this.isWithinRange(house))
    }
  },

  methods: {
    // code for loading google maps
    loadGoogleMaps() {
      const script = document.createElement('script')
      script.src = `https://maps.googleapis.com/maps/api/js?&libraries=places`
      script.src = `https://maps.googleapis.com/maps/api/js?key=&libraries=places`

      script.defer = true
      script.async = true
      script.onload = () => {
        this.initMap()
        this.initAutocomplete()
        this.getUserLocation()
        this.guestHouse()
      }
      script.onerror = () => {
        this.apiError()
      }
      document.head.appendChild(script)
    },

    //  show the location when open first maps
    initMap() {
      const myLatLng = { lat: 11.5546, lng: 104.9169 }
      const mapOptions = {
        center: myLatLng,
        zoom: 18,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      this.map = new google.maps.Map(document.getElementById('googleMap'), mapOptions)
      this.directionsService = new google.maps.DirectionsService()
      this.directionsDisplay = new google.maps.DirectionsRenderer()
      this.directionsDisplay.setMap(this.map)
    },

    //  auto complete when searching for directions
    initAutocomplete() {
      const options = {
        types: ['geocode']
      }
      this.autocompleteFrom = new google.maps.places.Autocomplete(
        document.getElementById('from'),
        options
      )
      this.autocompleteTo = new google.maps.places.Autocomplete(
        document.getElementById('to'),
        options
      )

      this.autocompleteFrom.addListener('place_changed', () => {
        const place = this.autocompleteFrom.getPlace()
        if (!place.geometry) {
          console.error('Place not found for From input.')
          return
        }
        this.from = place.formatted_address
      })

      this.autocompleteTo.addListener('place_changed', () => {
        const place = this.autocompleteTo.getPlace()
        if (!place.geometry) {
          console.error("Place not found for 'To' input.")
          return
        }
        this.to = place.formatted_address
      })
    },

    //  code caught location of user stand
    getUserLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const lat = position.coords.latitude
            const lng = position.coords.longitude
            const latlng = new google.maps.LatLng(lat, lng)

            const geocoder = new google.maps.Geocoder()
            geocoder.geocode({ location: latlng }, (results, status) => {
              if (status === 'OK') {
                if (results[0]) {
                  const formattedAddress = results[0].formatted_address
                  this.from = formattedAddress
                  this.map.setCenter(latlng)
                  this.addUserLocationMarker(latlng)
                  this.guestHouse()
                } else {
                  console.error('No results found for the given coordinates.')
                  this.from = 'Your current location'
                }
              } else {
                console.error('Geocoding failed:', status)
                this.from = 'Your current location'
              }
            })
          },
          (error) => {
            console.error('Error getting user location:', error)
            this.from = 'Your current location'
          },
          {
            enableHighAccuracy: true,
            maximumAge: 0,
            timeout: 5000
          }
        )
      } else {
        console.error('Geolocation is not supported by this browser.')
        this.from = 'Your current location'
      }
    },

    // icons to show user location where
    addUserLocationMarker(latlng) {
      this.userLocationMarker = new google.maps.Marker({
        position: latlng,
        map: this.map,
        title: 'Your Location',
        icon: {
          url: user,
          scaledSize: new google.maps.Size(50, 50),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(25, 50)
        }
      })
    },

    // add guesthouse from backend to show on the maps
    guestHouse() {
      axiosInstance
        .get('/guest_house/list')
        .then((response) => {
          const guesthouses = response.data.data
          if (guesthouses.length === 0) {
            // this.output = `<div class='alert-warning'><i class='fas fa-exclamation-triangle'></i> No guesthouses found.</div>`
            return
          }
          this.clearMarkers()
          guesthouses.forEach((guesthouse) => {
            const latitude = parseFloat(guesthouse.latitude)
            const longitude = parseFloat(guesthouse.longitude)

            if (!isNaN(latitude) && !isNaN(longitude) && latitude !== 0 && longitude !== 0) {
              const latlng = new google.maps.LatLng(latitude, longitude)
              const distance = google.maps.geometry.spherical.computeDistanceBetween(
                this.userLocationMarker.getPosition(),
                latlng
              )
              this.createMarker({
                geometry: {
                  location: latlng
                },
                address: guesthouse.address,
                name: guesthouse.name,
                photos: guesthouse.photos
              })
            } else {
              this.geocodeAddress(guesthouse.address, (latlng) => {
                if (latlng) {
                  this.createMarker({
                    geometry: {
                      location: latlng
                    },
                    address: guesthouse.address,
                    name: guesthouse.name,
                    photos: guesthouse.photos
                  })
                } else {
                  console.warn('Geocoding failed for address:', guesthouse.address)
                }
              })
            }
          })
        })
        .catch((error) => {
          console.error('Error fetching guesthouses:', error)
          // this.output = `<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Failed to fetch guesthouses. Please try again later.</div>`
        })
    },

    // icons for location guesthouses
    createMarker(place) {
      const marker = new google.maps.Marker({
        position: place.geometry.location,
        map: this.map,
        title: place.address,
        label: {
          text: place.name,
          fontSize: '14px',
          fontWeight: 'bold',
          color: 'gray'
        },
        icon: {
          url: pinHome,
          scaledSize: new google.maps.Size(40, 40),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(20, 40),
          labelOrigin: new google.maps.Point(-20, 15)
        }
      })

      this.markers.push(marker)
      let imageUrl = ''
      if (place.photos && place.photos.length > 0) {
        imageUrl = `http://127.0.0.1:8000${place.photos[0].url.slice(16)}`
      }
      const contentString = `
        <div>
          <h3>${place.name}</h3>
          <p>${place.address}</p>
       <img
        src="${imageUrl}"
        class="card-img-top"
        style="width:40%; height: auto;"
      />        
      </div>
      `

      const infowindow = new google.maps.InfoWindow({
        content: contentString
      })

      marker.addListener('click', () => {
        infowindow.open(this.map, marker)
        this.calcRouteToGuesthouse(place.geometry.location)
      })
    },

    // code for geocode when adding guesthouse
    geocodeAddress(address, callback) {
      const geocoder = new google.maps.Geocoder()
      geocoder.geocode({ address }, (results, status) => {
        if (status === 'OK') {
          const latlng = results[0].geometry.location
          callback(latlng)
        } else {
          console.error('Geocoding failed:', status)
          callback(null)
        }
      })
    },

    clearMarkers() {
      this.markers.forEach((marker) => {
        marker.setMap(null)
      })
      this.markers = []
    },

    // calculate route to another places
    calcRoute() {
      if (!this.from || !this.to) {
        // this.output =
        //   "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Please fill in the required fields.</div>"
        return
      }

      const routeRequest = {
        origin: this.from,
        destination: this.to,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
      }

      this.directionsService.route(routeRequest, (result, status) => {
        if (status === google.maps.DirectionsStatus.OK) {
          const route = result.routes[0]
          if (route) {
            const legs = route.legs
            if (legs && legs.length > 0) {
              let totalDistance = 0
              let totalDuration = 0
              legs.forEach((leg) => {
                totalDistance += leg.distance.value
                totalDuration += leg.duration.value
              })

              const totalDistanceInKm = (totalDistance / 1000).toFixed(2)
              const totalDurationInMinutes = Math.floor(totalDuration / 60)

              this.directionsDisplay.setDirections(result)

              const path = result.routes[0].overview_path
              const midPointIndex = Math.floor(path.length / 2)
              const midPoint = path[midPointIndex]
              const overlay = new google.maps.OverlayView()
              overlay.draw = () => {
                const marker = new google.maps.Marker({
                  position: midPoint,
                  map: this.map,
                  visible: false
                })

                const div = document.createElement('div')`   div.style.position = 'absolute'
                div.style.background = 'black'
                div.style.padding = '5px'
                div.style.border = '1px solid black'
                div.innerHTML = <strong> Distance:</strong> ${totalDistanceInKm} km<br><strong> Duration:</strong> ${totalDurationInMinutes} minutes`

                const panes = overlay.getPanes()
                panes.overlayLayer.appendChild(div)
              }

              overlay.setMap(this.map)
              return
            }
          }
          // this.output =
          //   "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> No route found.</div>"
        } else {
          this.directionsDisplay.setDirections({ routes: [] })
          this.map.setCenter({ lat: 38.346, lng: -0.4907 })
        }
      })
    },

    fetchGuestHousesNearLocation(location) {
      axiosInstance.get('/Guest_House').then((response) => {
        const guesthouses = response.data.data
        if (guesthouses.length === 0) {
          // this.output =
          //   "<div class='alert-warning'><i class='fas fa-exclamation-triangle'></i> No guesthouses found.</div>"
          return
        }
        this.clearMarkers()
        guesthouses.forEach((guesthouse) => {
          const latitude = parseFloat(guesthouse.latitude)
          const longitude = parseFloat(guesthouse.longitude)

          // Check if the guesthouse is within 5000 meters (5 km) from the user
          if (!isNaN(latitude) && !isNaN(longitude) && latitude !== 0 && longitude !== 0) {
            const latlng = new google.maps.LatLng(latitude, longitude)
            const distance = google.maps.geometry.spherical.computeDistanceBetween(location, latlng)
            if (distance <= 5000) {
              this.createMarker({
                geometry: {
                  location: latlng
                },
                address: guesthouse.address,
                name: guesthouse.name,
                photos: guesthouse.photos
              })
            }
          } else {
            this.geocodeAddress(guesthouse.address, (latlng) => {
              if (latlng) {
                this.createMarker({
                  geometry: {
                    location: latlng
                  },
                  address: guesthouse.address,
                  name: guesthouse.name,
                  photos: guesthouse.photos
                })
              } else {
                console.warn('Geocoding failed for address:', guesthouse.address)
              }
            })
          }
        })
      })
    },

    calcRouteToGuesthouse(latlng) {
      const userLocation = {
        lat: this.userLocationMarker.getPosition().lat(),
        lng: this.userLocationMarker.getPosition().lng()
      }

      const request = {
        origin: userLocation,
        destination: latlng,
        travelMode: 'DRIVING'
      }

      this.directionsService.route(request, (result, status) => {
        if (status === 'OK') {
          this.directionsDisplay.setDirections(result)

          const route = result.routes[0]
          if (route) {
            const legs = route.legs
            if (legs && legs.length > 0) {
              let totalDistance = 0
              let totalDuration = 0
              legs.forEach((leg) => {
                totalDistance += leg.distance.value
                totalDuration += leg.duration.value
              })

              const totalDistanceInKm = (totalDistance / 1000).toFixed(2)
              const totalDurationInMinutes = Math.floor(totalDuration / 60)

              const path = route.overview_path
              const midPointIndex = Math.floor(path.length / 2)
              const midPoint = path[midPointIndex]

              // Create a marker for the midpoint
              const midPointMarker = new google.maps.Marker({
                position: midPoint,
                map: this.map,
                icon: {
                  path: google.maps.SymbolPath.CIRCLE,
                  scale: 5,
                  fillColor: 'black',
                  fillOpacity: 1,
                  strokeWeight: 0
                }
              })

              // Info window content for the midpoint marker
              const infowindowContent = ` <div style="background-color: white; border: 1px black; padding: 10px;">
                                      <strong>Distance:</strong> ${totalDistanceInKm} km<br>
                                      <strong>Duration:</strong> ${totalDurationInMinutes} minutes
                                    </div>`

              const infowindow = new google.maps.InfoWindow({
                content: infowindowContent
              })

              // Open infowindow on midpoint marker
              infowindow.open(this.map, midPointMarker)
              return
            }
          }
        } else {
          // this.output = `<div class="alert alert-danger mt-3">Could not calculate directions: ${status}</div>`
        }
      })
    },

    // Handle Google Maps API script loading error
    apiError() {
      console.error('Google Maps API script loading failed.')
      // this.output =
      //   "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Failed to load Google Maps API.</div>"
    },

    // Route to a specific house address from the card service component
    showHouseOnMap(house) {
      const address = ` ${house.address}, ${house.city}, ${house.state}, ${house.country}`

      const geocoder = new google.maps.Geocoder()
      geocoder.geocode({ address: address }, (results, status) => {
        if (status === 'OK') {
          const location = results[0].geometry.location
          this.map.setCenter(location)
          this.map.setZoom(15)
          this.createMarker({
            geometry: {
              location: location
            },
            address: house.address,
            name: house.name,
            photos: house.photos
          })
        } else {
          console.error('Geocode was not successful for the following reason: ' + status)
        }
      })
    }
  }
}
</script>

<style scoped>
.map-form.expanded {
  width: 200px;
}

.map-container {
  position: relative;
  margin-left: -190px;
  margin-top: -59px;
}

.map-form {
  position: absolute;
  top: 10px;
  right: 3%;
  /* z-index: 1; */
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: width 0.3s ease-in-out;
}

.map-input {
  margin-bottom: 10px;
}

.map-button {
  margin-top: 10px;
}

.map-label {
  position: absolute;
  top: 10px;
  left: 10px;
  color: #495057;
}

#cal {
  margin-top: -10px;
}
</style>
