@extends('layouts.app')

@section('content')
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!--link rel="stylesheet" href="/css/read_bootstrap.css" -->

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
var app = angular.module('myApp', []);
app.controller('NotesCtrl', function($scope, $http) {
              $scope.InsertMessage="";
              $scope.AddCatDisabled = true;
              $scope.HideAddMessage = true;
              $scope.SelectedCategory = '';
              $scope.myFunc = function() {

                      $scope.SelectedCategory = $("#Categories_Id option:selected").text();
                      myUrl = "/ShowCodes/" + $scope.option1;
                      $http.get(myUrl).then(function(response) {
                      $scope.myData = response.data;
                      $scope.AddCatDisabled = false;
                    });
                  };

              $scope.myFunc2 = function() {
                var list = {
                CatID: $scope.option1,
                SubCatName: $scope.subcatname,
                };
                 $http({
                 method: 'POST',
                  url: '/PostCodes/',
                  data: list
                })

              .success(function (data) {
                 console.log('true');
                 $scope.myFunc();
                 $scope.InsertMessage='Last Record Added ' + data.The_ID + ' ' + $scope.subcatname;
                 $scope.HideAddMessage = false;
                 $scope.cat_type=parseInt(data.The_ID, 10);  

              })
              .error(function(){
                 $scope.InsertMessage='Could Not Add '+ $scope.subcatname + " : Possible Duplicate";
                 $scope.HideAddMessage = false;
                  
              })
    
            };


});
</script>

<div class="container" ng-app="myApp" ng-controller="NotesCtrl">


 
  <!-- Modal -->
  <div class="modal fade" id="SubCategory" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add A Sub Category for [@{{SelectedCategory}}]</h4>
        </div>
        <div class="modal-body">
       <form class="form-horizontal">
    <fieldset>

    <!-- Form Name -->

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="Category_Description">Sub-Category Name</label>  
      <div class="col-md-4">
      <input data-ng-model="subcatname" id="Category_Description" name="Category_Description" type="text" placeholder="Input Category Here" class="form-control input-md" required="">

      </div>
      <div class="col-md-1">
       <button id="singlebutton" name="singlebutton" class="btn btn-primary" ng-click="myFunc2()">Save</button>
       </div>

    </div>
       <div class="row" ng-hide="HideAddMessage">
         <div class="col-md-1" >&nbsp;</div>
         <div class="col-md-10 alert alert-info" >
               @{{InsertMessage}}
         </div>
       </div>
    </fieldset>
</form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" >
        


                <div class="panel-body">
                    <form class="form-horizontal">
                    <fieldset>

                    <!-- Form Name -->
                    <legend>Notes / 360  >> Add</legend>


                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Categories_Id">Category</label>
                      <div class="col-md-4">
                        <select id="Categories_Id" name="Categories_Id" class="form-control" data-ng-model="option1" ng-change="myFunc()">
                           @foreach($category as $category)
                            <option data-tokens="" value="{{$category->id}}">{{$category->Category_Description}}</option>
                           @endforeach
                        </select>
                       
                      </div>

                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="CodeTypes_Id">Type</label>
                      <div class="col-md-4">
                        <select id="CodeTypes_Id" name="CodeTypes_Id" class="form-control" ng-model="cat_type" ng-options="x.id as x.CodeType_Description for x in myData" >
                        </select>
                      </div>
                         <div class="col-md-1">
                         <span ng-click="HideAddMessage = true" ng-hide="AddCatDisabled" class="glyphicon glyphicon-plus" aria-hidden="true" data-toggle="modal" data-target="#SubCategory"></span>
                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Body">Note</label>
                      <div class="col-md-4">                     
                        <textarea rows="10" cols="50" class="form-control" id="Body" name="Body">Please enter your text</textarea>
                      </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="singlebutton"></label>
                      <div class="col-md-4">
                        <button id="singlebutton" name="singlebutton" class="btn btn-primary">Save</button>
                      </div>
                    </div>

                    </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
