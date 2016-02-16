$(document).on('click', '.result_container', function(e) {
    var result = $.data(this, 'object').reference;
    var expanded = result.expanded;

    for(var i = 0; i < results.length; i++) {
        results[i].retract();
    }

    if(!expanded)
        result.expand();
});

$(document).on('keyup', '#query', function(e) {
    if(e.keyCode == 13)
        getResults($(this).val()); //this method also checks if the query is empty
});
