$(document).ready(function() {
    var sort = 0;
    var strana = 0;
    var kat_id = 0;
    var search = "";

    $.ajax({
        url: "models/ispisProizvoda.php",
        method: "GET",
        dataType: "json",
        success: function(data){
            prikazProizvoda(data);
        },
        error: function(xhr,status,error){
            console.log(xhr,status,error);
        }
    })

    let urlPaginacija = "models/paginacija.php"
    $.ajax({
        url: urlPaginacija,
        method : "GET",
        success: function(data){
            document.getElementById("paginacija").innerHTML = data;
            $('.promenaStrane').click(promeniStranu);
        },
        error: function(xhr,status,error){
            console.log(xhr,status,error);
        }
    })    

    function prikazProizvoda(lisofProduct){
        var html="";
        for(let product of lisofProduct){
            html += `<div class="productItemFlex product-item position-relative bg-light d-flex flex-column text-center flexProduct" data-id="${product.id}">
								<img src="${product.slika}" alt="Dog Food">
								<h6 class="titleProduct">${product.naziv}</h6>
								<h5 class="text-primary mb-0">$ ${product.cena}</h5>
								<div class="btn-action d-flex justify-content-center">
                                    <a class='btn btn-primary py-2 px-3' href='index.php?page=details&id=${product.id}'>Show More</a>
								</div>
							</div>`
        }
        document.getElementById("allProducts").innerHTML = html;
    }
    $('.promenaStrane').click(promeniStranu);
    

    function promeniStranu(e){
        e.preventDefault();
 
        strana = this.dataset.id;
        let url = "models/ispisProizvoda.php?strana=" + strana + "&sort=" + sort + "&kat_id=" + kat_id + "&search=" + search;
        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            success: function(data){
                prikazProizvoda(data);
            },
            error: function(xhr,status,error){
                console.log(xhr,status,error);
            }
        })
    }
    
    document.getElementById("selectedProduct").onchange = function(vrednost){
        sort = vrednost.target.value;

        $.ajax({
            url : "models/ispisProizvoda.php?sort=" + sort + "&strana=" + strana + "&kat_id=" + kat_id + "&search=" + search,
            method : "GET",
            dataType : "json",
            success : function(data){
                prikazProizvoda(data);
            },
            error : function(xhr, status, error){
                console.log(error);
            }
        });
    }

    const categoryRadio = document.querySelectorAll('input[name="categories"]')
    categoryRadio.forEach(categoryCheckbox => {
        categoryCheckbox.addEventListener('click', filtrirajPoKategoriji)

    })
    document.getElementById("search").addEventListener('keyup', filtrirajPoKategoriji)

    function filtrirajPoKategoriji(){

        let categoires = document.getElementsByName("categories");
		for (let i = 0; i < categoires.length; i++) {
			if (categoires[i].checked) {
				kat_id = categoires[i].value;
				break;
			}
		}
        search = $("#search").val().toLowerCase().trim();


        let urlPaginacija = "models/paginacija.php?kat_id=" + kat_id +"&search="+ search;
        $.ajax({
            url: urlPaginacija,
            method : "GET",
            success: function(data){
                document.getElementById("paginacija").innerHTML = data;
                $('.promenaStrane').click(promeniStranu);
            },
            error: function(xhr,status,error){
                console.log(xhr,status,error);
            }
        })
        
        let urlProizvoda = "models/ispisProizvoda.php?kat_id=" + kat_id +"&search="+ search +"&strana=1&sort=" + sort;
        $.ajax({
            url : urlProizvoda,
            method : "GET",
            dataType : "json",
            success: function(data){
                prikazProizvoda(data);
            },
            error: function(xhr,status,error){
                console.log(xhr,status,error);
            }
        })
    }

    document.getElementById("reset").addEventListener("click", clearFilters)

	function clearFilters() {
        let filterInputs = document.querySelectorAll('input[type="radio"]')
        filterInputs.forEach(input => {
            input.checked = false
        })
        document.getElementById("search").value="";
        kat_id=0
        search="";


        let urlPaginacija = "models/paginacija.php"
        $.ajax({
            url: urlPaginacija,
            method : "GET",
            success: function(data){
                document.getElementById("paginacija").innerHTML = data;
                $('.promenaStrane').click(promeniStranu);
            },
            error: function(xhr,status,error){
                console.log(xhr,status,error);
            }
        })
        $.ajax({
            url: "models/ispisProizvoda.php",
            method: "GET",
            dataType: "json",
            success: function(data){
                prikazProizvoda(data);
            },
            error: function(xhr,status,error){
                console.log(xhr,status,error);
            }
        })

	}

})

