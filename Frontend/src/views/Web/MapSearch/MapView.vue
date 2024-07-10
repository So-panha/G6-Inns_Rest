<template>
  <div id="app">
    <div class="jumbotron">
      <div class="container-fluid">
        <div class="map-container">
          <div
            id="googleMap"
            style="height: 500px; width: 89.5%; border: 1px solid #ccc; margin-left: 180px"
          ></div>
          <form class="map-form" :class="{ expanded: formExpanded }">
            <div class="form-group" style="display: flex; align-items: center; margin-top: 5px">
              <span class="map-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path
                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                  /></svg
              ></span>
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
              <button @click.prevent="calcRoute" class="btn btn-primary map-button">
                Calculate Route
              </button>
            </div>
          </form>
        </div>
        <div id="output" v-html="output" style="margin-top: 20px"></div>
      </div>
    </div>
  </div>
</template>

<script>
import axiosInstance from '@/plugins/axios'
import pinHome from '@/assets/pinHome.png'
import user from '@/assets/user.png'

export default {
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
      formExpanded: false
    }
  },

  mounted() {
    this.loadGoogleMaps()
  },
  watch: {
    from(newFrom, oldFrom) {
      if (newFrom && this.to) {
        this.calcRoute()
      }
    },
    to(newTo, oldTo) {
      if (newTo && this.from) {
        this.calcRoute()
      }
    }
  },
  methods: {
    loadGoogleMaps() {
      const script = document.createElement('script')
      script.src = `https://maps.googleapis.com/maps/api/js?key=&libraries=places`
      script.defer = true
      script.async = true
      script.onload = () => {
        this.initMap()
        this.initAutocomplete()
        this.getUserLocation()
      }
      script.onerror = () => {
        this.apiError()
      }
      document.head.appendChild(script)
    },
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
          console.error("Place not found for 'From' input.")
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
    guestHouse() {
      axiosInstance.get('/Guest_House').then((response) => {
        const guesthouses = response.data.data
        if (guesthouses.length === 0) {
          this.output = `<div class='alert-warning'><i class='fas fa-exclamation-triangle'></i> No guesthouses found.</div>`
          return
        }
        this.clearMarkers()
        guesthouses.forEach((guesthouse) => {
          const latitude = parseFloat(guesthouse.latitude)
          const longitude = parseFloat(guesthouse.longitude)

          if (!isNaN(latitude) && !isNaN(longitude) && latitude !== 0 && longitude !== 0) {
            // Valid coordinates, create marker directly
            const latlng = new google.maps.LatLng(latitude, longitude)
            this.createMarker({
              geometry: {
                location: latlng
              },
              address: guesthouse.address,
              name: guesthouse.name,
              photos: guesthouse.photos
            })
          } else {
            // Invalid or missing coordinates, use geocoding
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

      const infowindowContent = `
      <div>
        <img
          src="${imageUrl}"
          class="card-img-top"
          style="width:40%; height: auto;"
        />
        <div>
          <strong>${place.name}</strong><br>
          ${place.address}
        </div>
      </div>`

      const infowindow = new google.maps.InfoWindow({
        content: infowindowContent
      })

      marker.addListener('click', () => {
        infowindow.open(this.map, marker)
        this.calcRouteToGuesthouse(place.geometry.location)
      })
    },

    clearMarkers() {
      this.markers.forEach((marker) => {
        marker.setMap(null)
      })
      this.markers = []
    },
    calcRoute() {
      if (!this.from || !this.to) {
        this.output =
          "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Please fill in the required fields.</div>"
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

                const div = document.createElement('div')
                div.style.position = 'absolute'
                div.style.background = 'black'
                div.style.padding = '5px'
                div.style.border = '1px solid black'
                div.innerHTML = `<strong> Distance:</strong> ${totalDistanceInKm} km<br><strong> Duration:</strong> ${totalDurationInMinutes} minutes`

                const panes = overlay.getPanes()
                panes.overlayLayer.appendChild(div)
              }

              overlay.setMap(this.map)
              return
            }
          }
          this.output =
            "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> No route found.</div>"
        } else {
          this.directionsDisplay.setDirections({ routes: [] })
          this.map.setCenter({ lat: 38.346, lng: -0.4907 })
        }
      })
    },
    calcRouteToGuesthouse(destination) {
      if (!this.from || !destination) {
        this.output =
          "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Please fill in the required fields.</div>"
        return
      }

      const routeRequest = {
        origin: this.from,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
      }

      this.directionsService.route(routeRequest, (result, status) => {
        if (status === google.maps.DirectionsStatus.OK) {
          this.directionsDisplay.setDirections(result)
        } else {
          this.output =
            "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> No route found.</div>"
        }
      })
    },
    apiError() {
      console.error('Google Maps API script loading failed.')
      this.output =
        "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Failed to load Google Maps API.</div>"
    },
    createMarkerFromData(markerData) {
      // Use the markerData to create a new marker on the map
      const latitude = parseFloat(markerData.latitude)
      const longitude = parseFloat(markerData.longitude)
      const latlng = new google.maps.LatLng(latitude, longitude)

      this.createMarker({
        geometry: {
          location: latlng
        },
        address: markerData.address,
        name: markerData.name,
        photos: markerData.photos
      })
    }
  },
  watch: {
    markerData(newMarkerData) {
      if (newMarkerData) {
        this.createMarkerFromData(newMarkerData)
      }
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
}

.map-form {
  position: absolute;
  top: 10px;
  right: 5%;
  z-index: 1;
  background-color: #0000002e;
  padding: 12px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  transition: width 0.3s ease;
  width: 15px;
  overflow: hidden;
}

.map-form:hover {
  width: 472px;
}

.map-label {
  color: #555;
  font-size: 16px;
  margin-right: 10px;
  width: 20px;
}

.map-input {
  border: none;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  font-size: 16px;
  border-radius: 3px;
}

.map-button {
  margin-top: 20px;
  background-color: #007bff;
  border-color: #007bff;
  border-radius: 3px;
  font-size: 16px;
  padding: 10px 20px;
}
</style>
