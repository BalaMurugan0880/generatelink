@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Appointment</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('appointments.index')}}">Appointment</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right"  style="float: right;">
                        <a class="btn btn-primary" href="{{ route('appointments.index') }}"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>

            <div class="card card-warning mt-2">
                <div class="card-body">
                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Requester Name</label>
                                    <input type="text" name="req_name" class="form-control" placeholder="">
                                    <input type="text" name="user_id" class="form-control" value="{{ auth()->user()->id }}" hidden>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Requester Designation</label>
                                    <input type="text" name="req_designation" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                    <label>Requester Contact Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="req_contact" class="form-control" data-inputmask='"mask": "(60) 99-99999999"' data-mask>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Appointment Date</label>
                                    <input type="date" name="apt_date" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Appointment Time</label>
                                    <input type="time" name="apt_time" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="marker-info">**Please drag the marker to get your exact location.</p>
                                <div id="map" style="height:400px;width:auto;"></div>
                                <div class="form-group">
                                    <label>Pick-Up Location</label>
                                    <input type="text" name="pickup_location" id="pickup_location" class="form-control" placeholder="Enter a Location">
                                    <input type="text" name="pickup_lat" id="pickup_lat" class="form-control" >
                                    <input type="text" name="pickup_long" id="pickup_long" class="form-control" >
                                    <input type="text" name="pickup_url" id="pickup_url" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" name="customer_name" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Customer Phone Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="customer_contact" class="form-control" data-inputmask='"mask": "(60) 99-99999999"' data-mask>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Vehicle Registration Number</label>
                                    <input type="text" name="customer_vrn" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Vehicle Make</label>
                                    <select name="vehicle_make" id="vehicle_make" class="form-control">
                                        <option value="">-- Select Vehicle Make --</option>
                                        <option value="Vehicle 1">Vehicle 1</option>
                                        <option value="Vehicle 2">Vehicle 2</option>
                                        <option value="Vehicle 3">Vehicle 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Vehicle Model</label>
                                    <select name="vehicle_model" id="vehicle_model" class="form-control">
                                        <option value="">-- Select Vehicle Model --</option>
                                        <option value="Model 1">Model 1</option>
                                        <option value="Model 2">Model 2</option>
                                        <option value="Model 3">Model 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div id="map2" style="height:400px;width:auto;"></div>
                                    <label>Drop-off Location</label>
                                    <input type="text" name="dropoff_location" id="dropoff_location" class="form-control" placeholder="Enter a Location">
                                    <input type="text" name="dropoff_lat" id="dropoff_lat"  class="form-control" >
                                    <input type="text" name="dropoff_long" id="dropoff_long" class="form-control" >
                                    <input type="text" name="dropoff_url" id="dropoff_url" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Special Notes</label>
                                    <textarea class="form-control" style="height:150px" name="special_notes" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </section>
</div>

</form>

{{-- Pick up Location Map --}}
<script>
    var map;
    var marker;

    function initMap() {
    var initialLatLng = {lat: 3.1319, lng: 101.6841};
    var mapOptions = {
        zoom: 13,
        center: initialLatLng
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    marker = new google.maps.Marker({
        position: initialLatLng,
        map: map,
        draggable: true
    });

    function updateLocation(latLng) {
        document.getElementById('pickup_lat').value = latLng.lat();
        document.getElementById('pickup_long').value = latLng.lng();

        // Generate URL and get address for the new marker position
        var url = "https://www.google.com/maps/search/?api=1&query=" + latLng.lat() + "," + latLng.lng();
        document.getElementById('pickup_url').value = url;

        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'location': latLng }, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
            var addressComponents = results[0].address_components;
            var address = '';
            for (var i = 0; i < addressComponents.length; i++) {
                var component = addressComponents[i];
                if (component.types.includes('street_number') || component.types.includes('route')) {
                address += component.long_name + ' ';
                } else if (component.types.includes('locality')) {
                address += component.long_name + ', ';
                } else if (component.types.includes('administrative_area_level_1')) {
                address += component.long_name + ', ';
                } else if (component.types.includes('country')) {
                address += component.long_name;
                }
            }
            document.getElementById('pickup_location').value = address;
            } else {
            console.log('No results found');
            }
        } else {
            console.log('Geocoder failed due to: ' + status);
        }
        });
    }

    google.maps.event.addListener(map, 'click', function(event) {
        marker.setPosition(event.latLng);
        updateLocation(event.latLng);
    });

    google.maps.event.addListener(marker, 'dragend', function() {
        var latLng = marker.getPosition();
        updateLocation(latLng);
    });
    }

    window.addEventListener('load', initMap);
</script>

{{-- Drop OFF Location Map --}}
<script>
  var map2;
  var marker2;

  function initDropoffMap() {
    var initialLatLng = {lat: 3.1319, lng: 101.6841};
    var mapOptions = {
      zoom: 13,
      center: initialLatLng
    };

    map2 = new google.maps.Map(document.getElementById('map2'), mapOptions);

    marker2 = new google.maps.Marker({
      position: initialLatLng,
      map: map2,
      draggable: true
    });

    function updateDropoffLocation(latLng) {
      document.getElementById('dropoff_lat').value = latLng.lat();
      document.getElementById('dropoff_long').value = latLng.lng();

      // Generate URL and get address for the new marker position
      var url = "https://www.google.com/maps/search/?api=1&query=" + latLng.lat() + "," + latLng.lng();
      document.getElementById('dropoff_url').value = url;

      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({ 'location': latLng }, function(results, status) {
        if (status === 'OK') {
          if (results[0]) {
            var addressComponents = results[0].address_components;
            var address = '';
            for (var i = 0; i < addressComponents.length; i++) {
              var component = addressComponents[i];
              if (component.types.includes('street_number') || component.types.includes('route')) {
                address += component.long_name + ' ';
              } else if (component.types.includes('locality')) {
                address += component.long_name + ', ';
              } else if (component.types.includes('administrative_area_level_1')) {
                address += component.long_name + ', ';
              } else if (component.types.includes('country')) {
                address += component.long_name;
              }
            }
            document.getElementById('dropoff_location').value = address;
          } else {
            console.log('No results found');
          }
        } else {
          console.log('Geocoder failed due to: ' + status);
        }
      });
    }

    google.maps.event.addListener(map2, 'click', function(event) {
      marker2.setPosition(event.latLng);
      updateDropoffLocation(event.latLng);
    });

    google.maps.event.addListener(marker2, 'dragend', function() {
      var latLng = marker2.getPosition();
      updateDropoffLocation(latLng);
    });
  }

  window.addEventListener('load', initDropoffMap);
</script>

{{-- Google Place Api --}}
{{-- <script>
    function initAutocomplete() {
        // Initialize the autocomplete feature for pickup location
        var pickupInput = document.getElementById('pickup_location');
        var pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, {
            componentRestrictions: { country: 'my' } // Restrict to Malaysia
        });

        // Add event listener for when a user selects an address for pickup location
        pickupAutocomplete.addListener('place_changed', function() {
            var pickupPlace = pickupAutocomplete.getPlace();
            if (!pickupPlace.geometry) {
                window.alert("No details available for input: '" + pickupPlace.name + "'");
                return;
            }

            // Populate the latitude and longitude fields with the coordinates of the selected place for pickup location
            document.getElementById('pickup_lat').value = pickupPlace.geometry.location.lat();
            document.getElementById('pickup_long').value = pickupPlace.geometry.location.lng();

            var pickupMapUrl = "https://www.google.com/maps/search/?api=1&query=" + encodeURIComponent(pickupPlace.formatted_address);

            // Populate the pickup_url field with the generated URL for pickup location
            document.getElementById('pickup_url').value = pickupMapUrl;
        });

        // Initialize the autocomplete feature for dropoff location
        var dropoffInput = document.getElementById('dropoff_location');
        var dropoffAutocomplete = new google.maps.places.Autocomplete(dropoffInput, {
            componentRestrictions: { country: 'my' } // Restrict to Malaysia
        });

        // Add event listener for when a user selects an address for dropoff location
        dropoffAutocomplete.addListener('place_changed', function() {
            var dropoffPlace = dropoffAutocomplete.getPlace();
            if (!dropoffPlace.geometry) {
                window.alert("No details available for input: '" + dropoffPlace.name + "'");
                return;
            }

            // Populate the latitude and longitude fields with the coordinates of the selected place for dropoff location
            document.getElementById('dropoff_lat').value = dropoffPlace.geometry.location.lat();
            document.getElementById('dropoff_long').value = dropoffPlace.geometry.location.lng();

            var dropoffMapUrl = "https://www.google.com/maps/search/?api=1&query=" + encodeURIComponent(dropoffPlace.formatted_address);

            // Populate the dropoff_url field with the generated URL for dropoff location
            document.getElementById('dropoff_url').value = dropoffMapUrl;
        });
    }
</script> --}}

@endsection