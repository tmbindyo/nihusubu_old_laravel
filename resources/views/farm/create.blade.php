@extends('layouts.app', ['title' => __('Farm Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Farm')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Farm Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('farm.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('farm.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Farm information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-6">
                                    <h6 class="heading-small text-muted mb-4">{{ __('Farm information') }}</h6>
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                            <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description') }}" required>

                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('age_cluster') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-age_cluster">{{ __('Age cluster:') }}</label>
                                            <select name="age_cluster" class="form-control form-control-alternative {{ $errors->has('age_cluster') ? ' is-invalid' : '' }}" value="{{ old('age_cluster') }}" required>

                                                @foreach($age_clusters as $age_cluster)
                                                    <option value="{{ $age_cluster->id }}">{{ $age_cluster->name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('age_cluster'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('age_cluster') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('fertility_type') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-fertility_type">{{ __('Fertility type:') }}</label>
                                            <select name="fertility_type" class="form-control form-control-alternative {{ $errors->has('fertility_type') ? ' is-invalid' : '' }}" value="{{ old('fertility_type') }}" required>

                                                @foreach($fertility_types as $fertility_type)
                                                    <option value="{{ $fertility_type->id }}">{{ $fertility_type->name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('fertility_type'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('fertility_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('farm_size') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-farm_size">{{ __('Farm size:') }}</label>
                                            <select name="farm_size" class="form-control form-control-alternative {{ $errors->has('farm_size') ? ' is-invalid' : '' }}" value="{{ old('farm_size') }}" required>

                                                @foreach($farm_sizes as $farm_size)
                                                    <option value="{{ $farm_size->id }}">{{ $farm_size->name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('farm_size'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('farm_size') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('family_size') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-family_size">{{ __('Family size:') }}</label>
                                            <select name="family_size" class="form-control form-control-alternative {{ $errors->has('family_size') ? ' is-invalid' : '' }}" value="{{ old('family_size') }}" required>

                                                @foreach($family_sizes as $family_size)
                                                    <option value="{{ $family_size->id }}">{{ $family_size->name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('family_size'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('family_size') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('sand_type') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-sand_type">{{ __('Sand type:') }}</label>
                                            <select name="sand_type" class="form-control form-control-alternative {{ $errors->has('sand_type') ? ' is-invalid' : '' }}" value="{{ old('sand_type') }}" required>

                                                @foreach($sand_types as $sand_type)
                                                    <option value="{{ $sand_type->id }}">{{ $sand_type->name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('sand_type'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('sand_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('topography') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-topography">{{ __('Topography:') }}</label>
                                            <select name="topography" class="form-control form-control-alternative {{ $errors->has('topography') ? ' is-invalid' : '' }}" value="{{ old('topography') }}" required>

                                                @foreach($topographies as $topography)
                                                    <option value="{{ $topography->id }}">{{ $topography->name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('topography'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('topography') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-gender">{{ __('Gender:') }}</label>
                                            <select name="gender" class="form-control form-control-alternative {{ $errors->has('gender') ? ' is-invalid' : '' }}" value="{{ old('gender') }}" required>

                                                @foreach($genders as $gender)
                                                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('gender'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('fertility') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-fertility">{{ __('Fertility:') }}</label>
                                            <select name="fertility" class="form-control form-control-alternative {{ $errors->has('fertility') ? ' is-invalid' : '' }}" value="{{ old('fertility') }}" required>

                                                @foreach($fertilities as $fertility)
                                                    <option value="{{ $fertility->id }}">{{ $fertility->name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('fertility'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('fertility') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class = "col-6">
                                    <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                                        <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-first_name">{{ __('First name') }}</label>
                                            <input type="text" name="first_name" id="input-first_name" class="form-control form-control-alternative{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('first_name') }}" required autofocus>

                                            @if ($errors->has('first_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-last_name">{{ __('Last name') }}</label>
                                            <input type="text" name="last_name" id="input-last_name" class="form-control form-control-alternative{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('last_name') }}" required autofocus>

                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-phone_number">{{ __('Phone number') }}</label>
                                            <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('phone_number') }}" required autofocus>

                                            @if ($errors->has('phone_number'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                            <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-location">{{ __('Location') }}</label>

                                            <div id="map"></div>
                                            <input type="text" name="location" id="pac-input" class="form-control controls form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="{{ __('Location') }}" value="{{ old('location') }}" required autofocus>

                                            @if ($errors->has('location'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
        <script>
            // This example adds a search box to a map, using the Google Place Autocomplete
            // feature. People can enter geographical searches. The search box will return a
            // pick list containing a mix of places and predicted search terms.

            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

            function initAutocomplete() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -33.8688, lng: 151.2195},
                zoom: 13,
                mapTypeId: 'roadmap'
            });

            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                });
                map.fitBounds(bounds);
            });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5u1E2NY7JBLlliz1JxtfCmaE4lNL1mjM&libraries=places&callback=initAutocomplete"
                async defer></script>
    </div>
@endsection
