@extends('layouts.master')
@section('content')
	<div class="right_col" role="main">
              <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Ajouter des pointages</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            @if(session('success'))
  <div class="alert alert-success">
    {{session('success')}} 
  </div>  
@endif
@if(session('error'))
  <div class="alert alert-error">
      {{session('error')}}
  </div>
@endif
@if(session('error'))
  <div class="alert alert-error">
      {{session('error')}}
  </div>
@endif
  @if(!$errors->isEmpty())
     <div class="alert alert-danger">
     @foreach($errors->all() as $error)
       {{$error}}<br/>
     @endforeach
     </div>
   @endif
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ajouter des pointages</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="{{route('pointage.index')}}"><h2><button class="btn-info btn-large"><i class="fa fa-arrow-left"> Retour</i></button></h2></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="create-pointage" method="post" action="{{route('pointage.store')}}" data-parsley-validate class="form-horizontal form-label-left">
                    {{csrf_field()}}
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="heure">Heure <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="time" id="heure" name="heure" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="longitude" class="control-label col-md-3 col-sm-3 col-xs-12">Longitude</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="longitude" class="form-control col-md-7 col-xs-12" type="text" name="longitude">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="latitude" class="control-label col-md-3 col-sm-3 col-xs-12">Latitude</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="latitude" class="form-control col-md-7 col-xs-12" type="text" name="latitude">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Pointage <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="date_pointage" name="date_pointage" class="date-picker form-control col-md-7 col-xs-12" required="required" type="date">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employe_id">Employe <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select type="text" id="employe_id" name="employe_id" required="required" class="form-control col-md-7 col-xs-12">
                            @foreach($employes as $employe)
                              <option value="{{$employe->id}}">{{$employe->nom}}{{$employe->prenom}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
                          <button type="submit" class="btn btn-success">Ajouter</button>
                          <button class="btn btn-primary" type="reset">Annuler</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>         
	
@endsection