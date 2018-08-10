@extends('layouts.app')

@section('title', 'Places')

@section('content')

    <div id="target" class="row">

        <div class="col-xs-4">

            <h1 class="page-header">Places Management</h1>

        </div>
           
        <div class="col-sm-12">

            <table class="table table-hover table-striped">
                        
                <thead>

                    <tr>

                        <th>№</th>
                        <th>Distance</th>
                        <th>Address</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        

                        <th>
                            <b-btn v-on:click.prevent="showCreateForm()" variant="danger btn-sm">    
                                Add Place
                            </b-btn>
                        </th>

                        <th>
                            @include('partials.currentPlaceForm')
                        </th>
        
                    </tr>

                </thead>

                <tbody>
                    <tr v-for="place in places.data">
                        

                        <td>@{{ place.id }}</td>
                        <td v-if="typeof place.distance != 'undefined'">
                            @{{place.distance}}
                        </td>
                        <td v-else>--</td>
                        <td>@{{ place.address }}</td>
                        <td>@{{ place.lat }}</td>
                        <td>@{{ place.lng }}</td>
                        

                        <td>
                            <b-btn v-on:click.prevent="showMap(place)" variant="success btn-sm">    
                                Show
                            </b-btn>
                        </td>

                        <td>
                            <b-btn v-on:click.prevent="showEditForm(place)" variant="warning btn-sm">   
                                Edit
                            </b-btn>
                        </td>

                        <td>
                            <b-btn v-on:click.prevent="deletePlace(place, places.current_page)" variant="danger btn-sm">    
                                Delete
                            </b-btn>
                        </td>

                    </tr>

                    <hr>

                    <pagination :limit=10 
                                :data="places" 
                                @pagination-change-page="getPlaces">
                    </pagination>

                </tbody>

            </table>

            @include('partials.create')
            @include('partials.edit')
            @include('partials.show')
            </div>
        </div>

@endsection