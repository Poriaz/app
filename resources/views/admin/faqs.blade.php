@extends('layouts.adminside')

@section('content')

<div class="container-fluid" ng-controller="faqsController" ng-init="getFaqs()">
                <div class="side-body">
                     <div class="page-title">
                        <span class="title">Faqs</span>
                        <div class="description"><button role="button" class="btn btn-primary"  ng-click="showFaqForm = !showFaqForm">Add New</button>
                            <div ng-show="showFaqForm">
                                <form ng-submit="addFaq(newFaq.question,newFaq.answer,newFaq.catid)">
                                <input type="text" ng-model="newFaq.question"/>
                                <input type="text" ng-model="newFaq.answer"/>
                                <select ng-model="newFaq.catid" ng-options="cat.id as cat.category for cat in cats track by cat.id">
                                                                
                                </select>
                                <input type="submit" value="Add"/>
                                <input type="button" value="Cancel" ng-click="showFaqForm = !showFaqForm"/>
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
                                                <th>Question</th>
                                                <th>Answer</th>
                                                <th>Category</th>
                                                <th>Created_at</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="faq in faqs"   ng-include="getTemplate(faq);">
                                               
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <ul class="pagination">
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getFaqs(1)">«</a></li>
                                        <li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getFaqs(currentPage-1)">‹ Prev</a></li>
                                        <li ng-repeat="i in range" ng-class="{active : currentPage == i}">
                                            <a href="javascript:void(0)" ng-click="getFaqs(i)"><% i%></a>
                                        </li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getFaqs(currentPage+1)">Next ›</a></li>
                                        <li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getFaqs(totalPages)">»</a></li>
                                    </ul>
                                    
                                    <script type="text/ng-template" id="display">
                                                    <td scope="row"><% 10 *(currentPage-1)+$index+1 %></td>
                                                    <td><% faq.question %></td>
                                                    <td><% faq.answer %></td>
                                                    <td><% faq.category.category %></td>
                                                    <td><% faq.created_at %></td>
                                                    <td>  
                                                         <button role="button" class="btn btn-primary" ng-click="editFaq(faq);">Edit </button>
                                                         <button role="button" class="btn btn-primary" ng-click="deleteFaq(faq.id, $index);">Delete</button>
                                                    </td>
                                    </script>
                                    <script type="text/ng-template" id="edit">
                                                    <td scope="row"><% 10 *(currentPage-1)+$index+1 %></td>
                                                    <td><input type="text" ng-model="faq.question"/></td>
                                                    <td><input type="text" ng-model="faq.answer"/></td>
                                                    <td>
                                                    <select ng-model="faq.category" ng-options="cat.id as cat.category for cat in cats track by cat.id">
                                                                
                                                    </select>
                                                    </td>
                                                    <td><input type="text" ng-model="faq.id" style="display:none;"/> - </td>
                                                    <td>  
                                                         <button type="submit" role="button" class="btn btn-primary" ng-click="updateFaq($index,faq.question,faq.answer,faq.id,faq.category)">Update </button>
                                                         <a class="btn btn-primary" href="#" ng-click="resetFaq();">Cancel</a>
                                                    </td>
                                                    
                                    </script>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
			
@endsection 