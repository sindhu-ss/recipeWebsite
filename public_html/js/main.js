$(function(){
	var newTags = [];

	if(inputTags !== ""){
		newTags = inputTags.split(',');
	}
	         // id
	new Taggle("tags", {
		// split when find commar
		tags : newTags,
		// fakeColumn in Movies
		hiddenInputName : 'tags[]'

	});
});
