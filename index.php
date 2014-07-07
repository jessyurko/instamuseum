<!DOCTYPE html>
<!--[if lt IE 8]><html class="no-js ie6 oldie" lang="en"> 
<![endif]--><!--[if IE 7]><html class="no-js ie7 oldie" lang="en">
<![endif]--><!--[if IE 8]><html class="no-js ie8 oldie" lang="en">
<![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->


<head>

  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title></title>
  <meta name="description" content="" />
  <meta name="author" content="" />

  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

  

	<script src="config.js"></script>



<style>

.item {
	width: 200px;
	display: block;
	float: left;
	margin: 10px;
	position: relative;

}

.bar {
	display: block;
	position: absolute;
	height: 20px;
	background: #3498db;
	top: 0px;
	z-index: -1;
}

.tag {
	clear: both;
	display: block;
	position: relative;
	margin: 5px;
}

.active {
	font-size: 20px;
	font-weight: bold;
}

.extra {
	color: red;
}

.item img {

	width: 100%;
}

li.pero {
	color: white;
	list-style-type: none;
	display: inline;
	overflow-wrap: break-word;
}

li.pero.highlight {
	color: red;
}


.pero{ 
	font-family: "Arial", Times, Sans-serif;
}

#tags {
	width: 10%;
	float: left;
	position: relative;
	font-family: sans-serif;
}

#container {
	width: 80%;
	position: relative;
	float: right;
}

.tags {
	position: absolute;
	z-index: 20;
	background-color: black;
	opacity: .8;
	top: 0px;
	width: 100%;
	height: 100%;
	overflow-y: scroll;
}

#searchterm {
	width: 300px;
	float: left;
}

#header {
	padding: 20px;
	clear: both;
	width: 100%;
	float: left;
}

.button {
	background-color: #3498db;
	color: #ffffff;
	padding: 5px;
	float: left;
	margin: 0 10px 10px 10px;
}

.button:hover {
	cursor: pointer;
	background-color: #5dade2;
}

</style>


</head>

<body>
	<div id="header">
    	<input type="text" class="form-control" id="searchterm" placeholder="Enter search term without leading #">	
    	<div class="button" id="go">Go!</div>
    </div>
	<div id="tags"></div>
	<div id="container">
	
	</div>




 	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="http://underscorejs.org/underscore-min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


<script>
	var loop = 0;
	

	
	
	var items = [];
	var taglist = new Object();
	
	
	function getData(link) {
		var count = "";
		if(loop > 0) count = "... ";
		count += loop;
		$("#container").append(count);
		$.ajax({url: link, dataType: "jsonp", success: function(x) {
			$.each(x.data, function(i, val) {
				var $div = $("<div class='item'><img src='"+val.images.standard_resolution.url+"'><div class='tags' style='display:none'><ul></ul></div></div>");
				
				var item = new Object();
				item.url = val.images.standard_resolution.url;
				item.score = 0;
				
				$.each(val.tags, function(j, tag) {
					
					$tag = $("<li class='pero'>"+tag+", </li>");
	
					if(taglist[tag]) taglist[tag].count++;
					
					else {
						taglist[tag] = new Object();
						taglist[tag].count = 1;
						taglist[tag].text = tag;
					}

					
					if(_.contains(lista, tag)) {
						$tag.addClass("highlight");
						item.score++;
						taglist[tag].rel = true;

					};
 
					$div.find("ul").append($tag);
  
				});
				
				item.div = $div;
				items.push(item);
					
			});
			
			loop++
			console.log(loop);

			if(loop < 10 && x.pagination.next_url) {
				getData(x.pagination.next_url);	
			
			} else {
			
				var tagarray = [];
				$.each(taglist, function(i, tag) {
					tagarray.push(tag);
				});
			
				tagarray.sort(function(a, b) {
					return b.count - a.count;
				});
			
				$.each(tagarray, function(i, tag) {
					if(i > 0) {
						var $span = $("<span class='tag'>"+tag.text + ": " + tag.count+"</span>");
						var addl = "";
						if(tag.rel) $span.addClass("extra");
						var w = tag.count/2; 
						$span.append("<div class='bar' style='width:"+w+"%'></div>");
						$("#tags").append($span)
					}
					
				});
	
				items.sort(function(a,b) {
					return b.score - a.score;
				});		
				
				$("#container").html("");
				$.each(items, function(i, item) {

					$("#container").append(item.div);
				});
				
				$(".item").on("mouseover", function(e) {
					$(e.currentTarget).find(".tags").show();
	
				});
				
				$(".item").on("mouseout", function(e) {
					$(e.currentTarget).find(".tags").hide();
	
				});
			}
			
			
		}});
		
	}
	
	$("#go").on("click", function() {
		var searchterm = $("#searchterm").val();
		loop = 0;
		$("#container").html("");
		$("#tags").html("");
		items = [];
		taglist = {};
		getData("https://api.instagram.com/v1/tags/"+searchterm+"/media/recent?client_id="+instakey);
	});


</script>




  <!--[if lt IE 7]><script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script><script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})
</script><![endif]-->

</body>
</html>
