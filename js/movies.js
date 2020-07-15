//p: page number
//t: title
//y: year
//d: director
//w: wishlist
function updateList(p, t, y, d, w){
	
	$.post("findmovies.php",
		{title: t,
		 year: y,
		 director: d,
		 page: p,
		 wishlist: w},
		 function(data, status){
		
			if(status == "success"){
				
				var amount = 0;
				var rows = $('<div></div>');
				var error = 0;
				var row = $('<div class="row mb-4"></div>');
				var searchCount = 0;
				var current = 0;
				data.movies.forEach(function(item){
					
					if(item.info != null){
						createAlert("Couldn't find any movies.", false, 3000);
						error = 1;
						return;
					}
					if(item.amount != null){
						searchCount = item.amount;
						return;
					}
					if (item.current != null){
						current = item.current;
						return;
					}
					
					if(amount == 3){
					
						rows.append(row);
						row = $('<div class="row mb-4"></div>');
						amount = 0;
					}
					var col = $('<div class="col-4" ></div>');
					var card = $('<div class="card"></div>');
					var cardbody = $('<div class="card-body"></div>');
					var tit = $('<h5 class="card-title"></h5>');
					var desc = $('<p class="card-text"></p>');
					var go = $('<a href="#" class="btn btn-primary"></a>');
					var state;
					if(item.wishlist == ""){
						var wish = $('<a href="#" class="card-link p-2"></a>');
						wish.html("add to watchlist");
						state = 1;

					}
					else{
						var wish = $('<a href="#" class="card-link p-2 "></a>');
						wish.html("remove from watchlist");
						state = 2;
					}

					wish.click(function(event){
						event.preventDefault();
						
						$.get("/users/editwishlist.php",{
							id: item.id,
							type: state},
							function(data, status){
			
								if(status == "success"){
									if(data == "already"){
										createAlert("Movie already in watchlist", false, 3000);
									}
									else if(data=="nodata"){
										createAlert("Something went wrong.", false, 5000);
									}
									else{
										if(state==1){
											wish.html("remove from watchlist");
											state = 2;
										}
										else{
											wish.html("add to watchlist");
											state = 1;
										}	
									}
								}
								else{
									createAlert("Something went terribly wrong.", false, 5000);
								}
							});
					});
					tit.html(item.title);
					desc.html("Director(s): " + item.directors);
					go.html("See more");
					go.click(function(event){
						event.preventDefault();
						if(item.id)
							window.location = '/movie.php?id=' + item.id;
						else
							createAlert("Something went wrong.", false, 5000);
							 });
					cardbody.append(tit);
					cardbody.append(desc);
					cardbody.append(go);
					cardbody.append(wish);
					card.append(cardbody);
					col.append(card);
					row.append(col);
					amount++;
					
				});
				if(amount != 0)
					rows.append(row);
				if(error == 1)
					return;
				$("#movies").html(rows);
				
				var ul = $('<ul class="pagination justify-content-center pagination-lg"></ul>');
				var prevli;
				var preva;
				var nextli;
				var nexta;
				if(current == 1){
					prevli = $('<li class="page-item disabled"></li>');
					preva = $('<a href="#" class="page-link" tabindex="-1"></a>');
				}
				else{
					prevli = $('<li class="page-item"></li>');
					preva = $('<a href="#" class="page-link"></a>');
					preva.click(function(){
						//event.preventDefault();
						updateList(p-1, t, y, d, w);
					});
				}
				
				if(current == searchCount){
					nextli = $('<li class="page-item disabled"></li>');
					nexta = $('<a href="#" class="page-link" tabindex="-1"></a>');
				}
				else{
					nextli = $('<li class="page-item"></li>');
					nexta = $('<a href="#" class="page-link"></a>');
					nexta.click(function(){
						//event.preventDefault();
						updateList(p+1, t, y, d, w);
					});
				}
				preva.html("previous");
				nexta.html("next");
				prevli.append(preva);
				nextli.append(nexta);
				ul.append(prevli);
				ul.append(nextli);
				$('#pag').html(ul);
			}
			else{
				createAlert("Something went wrong.", false, 5000);
			}
	});
}