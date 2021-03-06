@extends('layouts.adminside')

@section('content')

<div class="container-fluid" ng-controller="helpcategoriesController" ng-init="getHelpCategories()">
                <div class="side-body">
                    <div class="page-title">
                        <span class="title">Faq Categories</span>
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
                            <div class="card">
                                
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
                                            <tr ng-repeat="cat in helpCategories"  ng-include="getTemplate(cat);">
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                     <ul class="pagination">
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getHelpCategories(1)">«</a></li>
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getHelpCategories(currentPage-1)">‹ Prev</a></li>
                                        <li ng-repeat="i in range" ng-class="{active : currentPage == i}">
                                            <a href="javascript:void(0)" ng-click="getHelpCategories(i)"><% i%></a>
                                        </li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getHelpCategories(currentPage+1)">Next ›</a></li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getHelpCategories(totalPages)">»</a></li>
                                    </ul>
                                    <script type="text/ng-template" id="display">
                                                    <td scope="row"><% 10 *(currentPage-1)+$index+1 %></td>
                                                    <td><% cat.category %></td>
                                                    <td><% cat.created_at %></td>
                                                    <td>  
                                                         <button role="button" class="btn btn-primary" ng-click="editCategory(cat);">Edit </button>
                                                         <button role="button" class="btn btn-primary" ng-click="deleteCategory(cat.id, $index);">Delete</button>
                                                    </td>
                                    </script>
                                    <script type="text/ng-template" id="edit">
                                                    <td scope="row"><% 10 *(currentPage-1)+$index+1 %></td>
                                                    <td><input type="text" ng-model="cat.category"/></td>
                                                    <td><input type="text" ng-model="cat.id" style="display:none;"/> - </td>
                                                    <td>  
                                                         <button type="submit" role="button" class="btn btn-primary" ng-click="updateCategory($index,cat.category,cat.id)">Update </button>
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