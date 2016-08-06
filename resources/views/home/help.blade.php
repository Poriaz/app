@extends('layouts.onlyheader')

@section('content')


<div class="help-center" ng-controller="helpController" ng-init="getHelp();">
	<div class="search-help">
    	<div class="container">
        	<div class="row">
                <div class="help-banner col-md-12">
                    <h2>How can we help you today?</h2>
                    <div class="search-box-help">
                        <form class="helpsearch" role="search">
                            <input type="search" placeholder="Find answers (design help, password, billing)" id="#">
                            <input type="submit" value="Search" placeholder="Find answers (design help, password, billing)">
                        </form>
                    </div>
                </div>
            </div>
        </div><!-----------------container ends-------------------->
    </div><!-----------------search-help ends-------------------->
    
     <div class="all-que">
    	<div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Frequently Asked Questions  <% title %></h2>
                    </div>
                 </div>
        	<div class="row">
            	<div class="col-md-12">
                    
                    <ul class="tab-list col-md-3">
                        <li ng-repeat="category in helpData.categories">
                        	<a href="#" ng-click="get_category_help(category.id,category.category)"><% category.category %></a>
                        </li>
                    </ul>
                    <div class="tab-content col-md-9">
                      
                    	<div class="signup-help" ng-repeat="faq in helpData.faqs">
                                <h4><a href="#"><% faq.question %></a></h4>
                                <p><% faq.answer %></p>
                        	
                       </div>
					
		  </div><!-----------------tab-content ends-------------------->

                </div>
            </div>
        </div><!-----------------container ends-------------------->
    </div><!-----------------common-que ends-------------------->
</div><!-----------------help-center ends-------------------->
<style>
	.tab-list.col-md-3 > li {
  background: #f1f1f1 none repeat scroll 0 0;
  margin-bottom: 2px;
  padding: 10px;
  width: 100%;
}
.tab-content.col-md-9 > p {
  font-size: 18px;
}
.tab-content.col-md-9 > ul {
  display: inline-block;
  width: 100%;
  padding-left:20px;
}
.tab-content.col-md-9 li {
  float: left;
  list-style: outside none disc;
  margin: 6px 0;
  width: 100%;
}
.all-que h4 {
    margin-top: 10px !important;
    float: left;
    width: 100%;
}
</style>


@endsection