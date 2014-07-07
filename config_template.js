/*
	Create your own instagram client id here: http://instagram.com/developer/register/
*/
var instakey = INSTAGRAM_CLIENT_ID_GOES_HERE;

/*
	List of terms to highlight (below are sample terms, remove but follow formatting). 
	Each photo's score will be calculated based on the number of terms below that it is tagged with.
	Photos will be sorted with the highest scoring at the top (i.e. most term matches).
*/
var lista = ["mexico", "archeology", "arqueologia", "arqueología", "cultura", "culture", "patrimonio", "heritage", "history", 
"historia","antropología", "antropología", "arqueología", "archaeology", "calendario", 
"archeology", "identidad", "identity", "pride", "orgullo", "antiquity", "past", "pasado", "historicplaces","sitioshistoricos", "piramides", "pyramid", "ruinas", "ruins"];


/*
	Changes the number of calls to the instagram API. Each call returns 20 photos (e.g. if reps = 10, total photos shown will be 200).
*/
var reps = 10;