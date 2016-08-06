/*global angular */
'use strict';

/**
 * The main app module
 * @name app
 * @type {angular.Module}
 */
var admin = angular.module('admin', ['angular-loading-bar', 'ngAnimate','infinite-scroll','ngSanitize','ngResource'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
       }).run(function($rootScope) {
        $rootScope.popup_category = "";
        $rootScope.popup_tags = "";
        $rootScope.popup_location = "";
        $rootScope.uploaded_image = "";
        $rootScope.baseurl = "add your app folder name of it is a subdirectory under a domain";
        $rootScope.theUser = window.user;
        
});
 


admin.controller('dashboardController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.users_count = 0;
        $scope.posts_count = 0;
        $scope.help_questions_count = 0;
        $scope.categories_count = 0;
        $scope.messgaesall = [];
        $scope.getDashboardData = function(){
                $http.get($scope.baseurl + '/admin/get_dashboard_data/')
                    .success(function(getData) {
                        $scope.users_count = getData.users;
                        $scope.posts_count = getData.posts;
                        $scope.help_questions_count = getData.help_questions;
                        $scope.categories_count = getData.categories;
                        $scope.messgaesall = getData.messgaesall;
                        
                    });
        }
}]);

admin.controller('usersController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.users = [];
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];
        $scope.getUsers = function(pageNumber){
                if(pageNumber===undefined){
                  pageNumber = '1';
                }
                $http.get($scope.baseurl + '/admin/get_users/'+pageNumber)
                    .success(function(response) {
                        $scope.users = response.data;
                        $scope.totalPages   = response.last_page;
                        $scope.currentPage  = response.current_page;
                        var pages = [];
                        for(var i=1;i<=response.last_page;i++) {          
                            pages.push(i);
                        }
                        $scope.range = pages; 
                    });
        };
        $scope.editable = "";
        $scope.passworderror = "";
        $scope.onFileSelect = function(files) {
            var fd = new FormData();
            //Take the first selected file
            fd.append("file", files[0]);

            $http.post($scope.baseurl + '/admin/addprofilepic', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            })
            .success(function(data){ 
                console.log(data);
                $scope.theUser.profile_pic =  data;
                files = null;
                
            })
            .error(function(data){ 
                console.log(data);
            });

        };
        
        $scope.allowAccess = function($index, $user_id, $value){
            var updatedata = {'user_id':$user_id,'value':$value};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/allow_access',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updatedata)
            })
            .success(function(data) {
                $scope.users[$index].allowed_access = $value;
            })
            .error(function(data) {
                console.log(data);
            });
        };
        
        $scope.updateProfile = function($model){
             var updatedata = {'name':$model.name,'email':$model.email};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/update_profile',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updatedata)
            })
            .success(function(data) {
                $scope.theUser.name = $model.name;
                $scope.theUser.email = $model.email;
                $scope.editable = "";
            })
            .error(function(data) {
                console.log(data);
            });
        };
        
        $scope.updatePassword = function($model){
             var updatedata = {'old_password' : $model.old_password,'password':$model.password};
            if($model.password != $model.confirm_password || $model.old_password === "")
            {
                $scope.passworderror = "Passwords didn't match !";
                return false;
            }
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/update_password',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updatedata)
            })
            .success(function(data) {
                if(data == "no match"){
                    $scope.passworderror = "Password was not updated, please enter correct password !";
                } else {
                    $scope.editable = "";
                    $scope.theUser.password = data;
                }
            })
            .error(function(data) {
                console.log(data);
            });
        };
}]);

admin.controller('postsController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.posts = [];
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];
        $scope.getPosts = function(pageNumber){
                if(pageNumber===undefined){
                  pageNumber = '1';
                }
                $http.get($scope.baseurl + '/admin/get_posts/'+pageNumber)
                    .success(function(response) {
                        $scope.posts = response.data;
                        $scope.totalPages   = response.last_page;
                        $scope.currentPage  = response.current_page;
                        var pages = [];
                        for(var i=1;i<=response.last_page;i++) {          
                            pages.push(i);
                        }
                        $scope.range = pages; 
                        
                    });
        }
        $scope.publishPost = function($index, $post_id, $value){
            var updatedata = {'post_id':$post_id,'value':$value};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/post_publish',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updatedata)
            })
            .success(function(data) {
                $scope.posts[$index].is_published = $value;
            })
            .error(function(data) {
                console.log(data);
            });
        }
}]);

admin.controller('faqsController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.faqs = [];
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];
        $scope.cats = [];
        $scope.getCategories = function(){
            $http.get($scope.baseurl + '/admin/get_cats/')
                    .success(function(response) {
                         $scope.cats = response;
                    });
        };
        
        
        $scope.getFaqs = function(pageNumber){
                $scope.getCategories();
                if(pageNumber===undefined){
                  pageNumber = '1';
                }
                $http.get($scope.baseurl + '/admin/get_faqs/'+pageNumber)
                    .success(function(response) {
                        $scope.faqs = response.data;
                        $scope.totalPages   = response.last_page;
                        $scope.currentPage  = response.current_page;
                        var pages = [];
                        for(var i=1;i<=response.last_page;i++) {          
                            pages.push(i);
                        }
                        $scope.range = pages; 
                        
                    });
        }
        
        $scope.selected = {};
        $scope.getTemplate = function($faq){
            if($faq.id === $scope.selected.id){
                return 'edit';
            }
            else {
                return 'display';
            }
            
       };
       $scope.editFaq = function($faq) {
            $scope.selected = angular.copy($faq);
            
       };
       
       $scope.resetFaq = function () {
            $scope.selected = {};
           
       };
       
       $scope.addFaq = function($question,$answer,$cat_id){
           console.log($cat_id);
         var faqData = {'question':$question,'answer':$answer,'cat_id': $cat_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/add_faq',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(faqData)
            })
            .success(function(data) {
                if($question.length > 0 && $answer.length > 0 && $cat_id.length > 0){
                    $scope.faqs.push(data);
                }
            })
            .error(function(data) {
                
            });
        };
        
       $scope.updateFaq = function($index, $question, $answer, $id, $category){
         $scope.selected = {};
         console.log($category);
         var updateFaqData = {'question':$question,'answer':$answer,'faq_id':$id,'cat_id': $category};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/update_faq',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updateFaqData)
            })
            .success(function(data) {
                $scope.faqs[$index].question = $question;
                $scope.faqs[$index].answer = $answer;
                $scope.faqs[$index].created_at = 'just now';
            })
            .error(function(data) {
                console.log(data);
            });
        };
        
        $scope.deleteFaq = function($faq_id, $index){
         $scope.selected = {};
         var deleteFaqData = {'faq_id':$faq_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/delete_faq',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(deleteFaqData)
            })
            .success(function(data) {
                $scope.faqs[$index] = null;
                
            })
            .error(function(data) {
                console.log(data);
            });
        };
}]);

admin.controller('categoriesController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.categories = [];
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];
        $scope.getCategories = function(pageNumber){
                if(pageNumber===undefined){
                  pageNumber = '1';
                }
                $http.get($scope.baseurl + '/admin/get_categories/'+pageNumber)
                    .success(function(response) {
                        $scope.categories = response.data;
                        $scope.totalPages   = response.last_page;
                        $scope.currentPage  = response.current_page;
                        var pages = [];
                        for(var i=1;i<=response.last_page;i++) {          
                            pages.push(i);
                        }
                        $scope.range = pages; 
                    });
        }
        $scope.selected = {};
        $scope.getTemplate = function($cat){
            if($cat.cat_id === $scope.selected.cat_id){
                return 'edit';
            }
            else {
                return 'display';
            }
            
       };
       $scope.editCategory = function($cat) {
            $scope.selected = angular.copy($cat);
            
       };
       
       $scope.resetCategory = function () {
            $scope.selected = {};
           
       };
       
       $scope.addCategory = function($title){
         var categoryData = {'title':$title};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/add_category',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(categoryData)
            })
            .success(function(data) {
                $scope.categories.push(data);
                
            })
            .error(function(data) {
                
            });
        };
        
       $scope.updateCategory = function($index, $title, $cat_id){
         $scope.selected = {};
         var updateCategoryData = {'title':$title,'category_id':$cat_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/update_category',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updateCategoryData)
            })
            .success(function(data) {
                $scope.categories[$index].title = category.title;
                $scope.categories[$index].created_at = 'just now';
            })
            .error(function(data) {
                console.log(data);
            });
        };
        
        $scope.deleteCategory = function($category_id, $index){
            $scope.selected = {};
         var deleteCategoryData = {'category_id':$category_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/delete_category',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(deleteCategoryData)
            })
            .success(function(data) {
                $scope.categories[$index] = null;
                
            })
            .error(function(data) {
                console.log(data);
            });
        };
}]);

admin.controller('helpcategoriesController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.helpCategories = [];
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];
        $scope.getHelpCategories = function(pageNumber){
                if(pageNumber===undefined){
                    pageNumber = '1';
                }
                $http.get($scope.baseurl + '/admin/get_helpcategories/'+pageNumber)
                    .success(function(response) {
                        $scope.helpCategories = response.data;
                        $scope.totalPages   = response.last_page;
                        $scope.currentPage  = response.current_page;
                        var pages = [];
                        for(var i=1;i<=response.last_page;i++) {          
                            pages.push(i);
                        }
                        $scope.range = pages; 
                    });
        }
        
        $scope.selected = {};
        $scope.getTemplate = function($cat){
            if($cat.id === $scope.selected.id){
                return 'edit';
            }
            else {
                return 'display';
            }
            
       };
       $scope.editCategory = function($cat) {
            $scope.selected = angular.copy($cat);
            
       };
       
       $scope.resetCategory = function () {
            $scope.selected = {};
           
       };
       
       $scope.addCategory = function($title){
         var categoryData = {'title':$title};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/add_faq_category',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(categoryData)
            })
            .success(function(data) {
                $scope.helpCategories.push(data);
                
            })
            .error(function(data) {
                
            });
        };
        
       $scope.updateCategory = function($index, $title, $id){
         $scope.selected = {};
         var updateCategoryData = {'title':$title,'category_id':$id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/update_faq_category',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updateCategoryData)
            })
            .success(function(data) {
                $scope.helpCategories[$index].title = category.title;
                $scope.helpCategories[$index].created_at = 'just now';
            })
            .error(function(data) {
                console.log(data);
            });
        };
        
        $scope.deleteCategory = function($category_id, $index){
            $scope.selected = {};
         var deleteCategoryData = {'category_id':$category_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/delete_faq_category',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(deleteCategoryData)
            })
            .success(function(data) {
                $scope.helpCategories[$index] = null;
                
            })
            .error(function(data) {
                console.log(data);
            });
        };
}]);

admin.controller('reportedPostsController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.reportedPosts = [];
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];
        $scope.getReportedPosts = function(pageNumber){
                if(pageNumber===undefined){
                    pageNumber = '1';
                }
                $http.get($scope.baseurl + '/admin/get_reported_posts/'+pageNumber)
                    .success(function(response) {
                        $scope.reportedPosts = response.data;
                        $scope.totalPages   = response.last_page;
                        $scope.currentPage  = response.current_page;
                        var pages = [];
                        for(var i=1;i<=response.last_page;i++) {          
                            pages.push(i);
                        }
                        $scope.range = pages; 
                    });
        }
        
        $scope.publishPost = function($index, $post_id, $value){
            var updatedata = {'post_id':$post_id,'value':$value};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/post_publish',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updatedata)
            })
            .success(function(data) {
                $scope.reportedPosts[$index].post.is_published = $value;
            })
            .error(function(data) {
                console.log(data);
            });
        };
                
        $scope.deleteReport = function($report_id, $index){
            var updatedata = {'report_id':$report_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/delete_report',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updatedata)
            })
            .success(function(data) {
                $scope.reportedPosts.splice($index, 1);
            })
            .error(function(data) {
                console.log(data);
            });
        };
}]);

admin.controller('contactMessagesController', ['$scope', '$http','$location','$parse', function($scope, $http, $location, $parse) {
        $scope.contactMessages = [];
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];
        $scope.getContactMessages = function(pageNumber){
                if(pageNumber===undefined){
                    pageNumber = '1';
                }
                $http.get($scope.baseurl + '/admin/get_contact_messages/'+pageNumber)
                    .success(function(response) {
                        $scope.contactMessages = response.data;
                        $scope.totalPages   = response.last_page;
                        $scope.currentPage  = response.current_page;
                        var pages = [];
                        for(var i=1;i<=response.last_page;i++) {          
                            pages.push(i);
                        }
                        $scope.range = pages; 
                    });
        }
        
        $scope.deleteMessage = function($contact_message_id, $index){
            console.log($index);
            var updatedata = {'message_id':$contact_message_id};
            $http({
                method: 'POST',
                url: $scope.baseurl+ '/admin/delete_contact_message',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(updatedata)
            })
            .success(function(data) {
                $scope.contactMessages.splice($index, 1);
                console.log($index);
            })
            .error(function(data) {
                console.log(data);
            });
        };
}]);
