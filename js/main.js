$(function form() {

	$("#buttonSend").click(function (){

		var fNameIsCorrect = checkName("#inputFName");
		var lNameIsCorrect = checkName("#inputLName");
		var emailIsCorrect = checkEmail();

		if (fNameIsCorrect && lNameIsCorrect && emailIsCorrect) 
		{
			$("#sendForm").submit();
		};
		
	});


	$("input#inputEmail").blur (checkEmail);
	$("#inputFName").blur (function () { checkName("#inputFName") });
	$("#inputLName").blur (function () { checkName("#inputLName") });
	/*$("#inputEmail").bind("change click input paste keyup propertychange", function (){
		if (! $("#inputEmail").val()) {
			$("#inputEmail")[0].setCustomValidity("enter email");
		} else {
			$("#inputEmail")[0].setCustomValidity("");
		}
		$("#inputEmail")[0].reportValidity();
	});
	$('#sendForm').validator().on('submit', function (e) {
		
 		if (e.isDefaultPrevented()) {
    		// handle the invalid form...
 		} else {
   			// everything looks good!
			if (! $("#inputEmail").val()) {
				e.preventDefault(); >
				
			} 
  		}
	});	*/

	$("ul#order-list").on("click", ".order-item button", function() {
		var idStr = $(this).parent(".order-item").attr("data-id");
		$("#inputItemId").val(parseInt(idStr)); 
	});


	function checkName(id) 
	{
		var val = $(id).val();
		var rv_name = /^[a-zA-Zа-яА-Я]+$/;
		if (val.length > 0 && rv_name.test(val))
		{
			$(id).addClass("not_error").removeClass("error");
			$(id).next('.error-box').text('Accept')
                                    .css('color','green'); 
			return true;
		}

		else
		{
			$(id).removeClass("not_error").addClass("error");
			$(id).next('.error-box').html('This field required')
                                    .css('color','red'); 
			return false;
		}

	};
	
	function checkEmail() 
	{
		var val = $("input#inputEmail").val();
		var rv_email = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if (val.length > 0 && rv_email.test(val))
		{
			$("input#inputEmail").addClass("not_error").removeClass("error");
			$("input#inputEmail").next('.error-box').text('Accept')
                                    .css('color','green'); 
			return true;
		}

		else
		{
			$("input#inputEmail").removeClass("not_error").addClass("error");
			$("input#inputEmail").next('.error-box').html('This field required')
                                    .css('color','red'); 
			return false;
		}
	
	};


});


$(function () {
	function initList(){
	    function resizeImages () {
			var imageHeight = $(".order-item-image:first > img").height();
			$(".order-item-image:not(:first) > img").height(imageHeight);
		}
		resizeImages ();
		$(window).resize(resizeImages);

		$('div.order-item-image').mouseenter(function(e){

			// Calculate the position of the image tooltip
	        x = e.pageX - $(this).offset().left;
	        y = e.pageY - $(this).offset().top;
	 
	        // Set the z-index of the current item,
	        // make sure it's greater than the rest of thumbnail items
	        // Set the position and display the image tooltip
	        $(this)//.css('z-index','15')
	        .children(".order-item-image-tooltip")
	        .css({'top': y + 10,'left': x + 20,/*'display':'block'*/});		
		
		}).mousemove(function(e){

			// Calculate the position of the image tooltip         
	        x = e.pageX - $(this).offset().left;
	        y = e.pageY - $(this).offset().top;
	             
	        // This line causes the tooltip will follow the mouse pointer
	        $(this).children(".order-item-image-tooltip").css({'top': y + 10,'left': x + 20});
		
		}).mouseleave(function(e){

			// Reset the z-index and hide the image tooltip
	        $(this)//.css('z-index','1')
	        .children(".order-item-image-tooltip")
	        .animate({"opacity": "hide"}, "fast");
		});
	}
	
	function getOrders(pagenumber) {		
		$("ul#order-list").html (""); //стираем текущие items
		$(".loading-image").css({'display':'block'}); // делаем видимый изображение загрузки
		$(".pagination").css({'pointer-events':'none'}); // делаем неактивные кнопки
		//$("ul#order-list").css({'display':'none'}); // скрываем items
		$.get("/order_list.php", {page: pagenumber}, function(data) 
			{	
				
				for (var i = 0; i < data.items.length; i++)
				{
	                var itemHtml = "<li  class=\"col-xs-12 col-sm-6 col-md-4 col-lg-3\">" + 
	                "<div class=\"order-item\" data-id=\""+data.items[i].id+"\" title=\""+data.items[i].title+"\">" +
	                        "<div class=\"order-item-image\">" +
	                            "<img src=\""+data.items[i].url+"\" alt=\"\" />"+
	                            "<div class=\"order-item-image-tooltip\"> <img src=\""+data.items[i].url+"\" /> </div> "+
	                        "</div>"+
	                        "<h6> Title: "+data.items[i].title+"</h6>"+
	                        "<span class=\"order-item-price\"> Price: $"+data.items[i].price+"</span> <br/>"+
	                        "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#modalForm\"> Buy </button>"+
	                    "</div>  " +
	                    "</li>" ;
	                $("ul#order-list").append (itemHtml);
	                
				}

				$("#items-count").html('Total items: '+ data.total);

				//var PagePagination = "<ul class = \"pagination\">"
				var PagePagination = "";
				for (var i = 1; i <= data.num_pages; i++)
				{
					PagePagination = PagePagination + 
					"<li class='" + (i === pagenumber ? "active" : "") + "'> <a href='#'>" + i + "</a> </li>";	
				}
				//PagePagination = PagePagination + "</ul>";
				//$("#order-list").prepend (PagePagination);
				$("#bottomPagination").html(PagePagination);
				$("#topPagination").html(PagePagination);

				setTimeout(initList, 1000);	
				$("ul#order-list").css({'display':'block'}); // возвращаем items 
				$(".pagination").css({'pointer-events':'auto'}); //активные кнопки пагинации
				$(".loading-image").css({'display':'none'}); // скрываем изображения загрузки
				window.history.pushState("", "Main", "/?page="+pagenumber);
			});
	};

	$("#topPagination, #bottomPagination").on("click", "a", function(event){
		var str = $(this).html();
		var number = parseInt(str);
		getOrders(number);
	});
	getOrders(number_page);
});

//(function () {})(); 

