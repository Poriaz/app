@extends('layouts.adminside')

@section('content')

<div class="container-fluid" ng-controller="categoriesController">
                <div class="side-body">
                    <div class="page-title">
                        <span class="title">Post Categories</span>
                        <div class="description"><button role="button" class="btn btn-primary"  ng-click="showCategoryForm = !showCategoryForm">Add New</button>
                            <div ng-show="showCategoryForm">
                                <form ng-submit="addCategory(newCategory.title)">
                                <input type="text" ng-model="newCategory.title"/>
                                <input type="submit" value="Add"/>
                                <input type="button" value="Cancel" ng-click="showCategoryForm = !showCategoryForm"/>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card"  ng-init="getCategories()">
                                
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category</th>
                                                <th>Created On</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr ng-repeat="cat in categories" ng-include="getTemplate(cat);">
                                             
                                            </tr>
                                        </tbody>
                                    </table>
                                     <ul class="pagination">
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getCategories(1)">«</a></li>
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getCategories(currentPage-1)">‹ Prev</a></li>
                                        <li ng-repeat="i in range" ng-class="{active : currentPage == i}">
                                            <a href="javascript:void(0)" ng-click="getCategories(i)"><% i%></a>
                                        </li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getCategories(currentPage+1)">Next ›</a></li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getCategories(totalPages)">»</a></li>
                                    </ul>
                                                <script type="text/ng-template" id="display">
                                                    <td scope="row"><% 10 *(currentPage-1)+$index+1 %></td>
                                                    <td><% cat.title %></td>
                                                    <td><% cat.created_at %></td>
                                                    <td>  
                                                         <button role="button" class="btn btn-primary" ng-click="editCategory(cat);">Edit </button>
                                                         <button role="button" class="btn btn-primary" ng-click="deleteCategory(cat.cat_id, $index);">Delete</button>
                                                    </td>
                                                </script>
                                                <script type="text/ng-template" id="edit">
                                                    <td scope="row"><% 10 *(currentPage-1)+$index+1 %></td>
                                                    <td><input type="text" ng-model="cat.title"/></td>
                                                    <td><input type="text" ng-model="cat.cat_id" style="display:none;"/> - </td>
                                                    <td>  
                                                         <button type="submit" role="button" class="btn btn-primary" ng-click="updateCategory($index,cat.title,cat.cat_id)">Update </button>
                                                         <a class="btn btn-primary" href="#" ng-click="resetCategory();">Cancel</a>
                                                    </td>
                                                    
                                                </script>
                                           
                                            
                                       
                                    
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
			
@endsection 