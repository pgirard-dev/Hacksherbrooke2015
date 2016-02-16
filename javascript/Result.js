function Result(name, address, telephone, category, image, website, distance) {
    this.name = name;
    this.address = address;
    this.telephone = telephone;
    this.category = category;
    this.image = image;
    this.website = website;
    this.distance = ("" + distance).substring(0, 3) + "km";

    this.expanded = false;

    this.titleElement = $('<div>').addClass('title');
    $('<img>').attr('src', "icons/" + this.image + ".svg").addClass('image iconic').appendTo(this.titleElement);

    this.infoElement = $('<div>').addClass('info');
    $('<h3>').text(this.name).addClass('name').appendTo(this.infoElement);
    $('<h3>').text(this.category).addClass('category').appendTo(this.infoElement);
    this.infoElement.appendTo(this.titleElement);

    $('<div>').addClass('status_circle').appendTo(this.titleElement);

    this.contentElement = $('<div>').addClass('content');

    var that = this;
    $.getJSON("model/getCatInfo.php?id=" + this.category, function(data) {
       // console.log(data);

        that.image = data.image;
        that.category = data.category;

        that.titleElement = $('<div>').addClass('title');
        $('<img>').attr('src', "icons/" + that.image + ".svg").addClass('image iconic').appendTo(that.titleElement);

        that.infoElement = $('<div>').addClass('info');
        $('<h3>').text(that.name).addClass('name').appendTo(that.infoElement);
        $('<h3>').text(that.distance).addClass('distance').appendTo(that.infoElement);
        that.infoElement.appendTo(that.titleElement);

        if(Math.floor(Math.random() * 2) == 0)
            $('<div>').addClass('status_circle').css('background-color', 'rgb(30, 235, 242)').appendTo(that.titleElement);
        else
            $('<div>').addClass('status_circle').css('background-color', '#AAA').appendTo(that.titleElement);

        that.contentElement = $('<div>').addClass('content');

        $('<h4>').text(that.name).addClass('name2').appendTo(that.contentElement);

        that.contentLeftElement = $('<div>').addClass('content_left').appendTo(that.contentElement);
        $('<h4>').text(that.telephone).addClass('telephone').appendTo(that.contentLeftElement);

        if(that.website) {
            $('<a>').attr({'href': "http://" + that.website, 'target': '_blank'}).addClass('website').text("Site Web").appendTo(that.contentLeftElement);
        }
        else {
            $('<a>').attr({'href': "#"}).addClass('website').text("Site Web").appendTo(that.contentLeftElement);
        }

        $('<h4>').text(that.address).addClass('address').appendTo(that.contentLeftElement);

        $('<img>').attr('src', "icons/" + that.image + ".svg").addClass('content_image iconic').appendTo(that.contentElement);

        that.titleElement.appendTo($('#accordion'));
        that.contentElement.appendTo(that.titleElement);

        that.containerElement = $('<div>').addClass('result_container');
        that.titleElement.appendTo(that.containerElement);
        that.contentElement.hide().appendTo(that.containerElement);

        that.containerElement.appendTo($('#accordion'));

        $.data(that.containerElement[0], 'object', {'reference': that});

    }).fail(function(jqXHR, textStatus, errorThrown) { //if a connection error occurs
		alert("Error: " + textStatus + ", " + errorThrown);
	});
}

Result.prototype.expand = function() {
    if(!this.expanded) {
        this.expanded = true;
        this.titleElement.hide({duration: 800, queue: false});
        this.contentElement.slideDown({duration: 1000, queue: false});
    }
};

Result.prototype.retract = function() {
    if(this.expanded) {
        this.expanded = false;
        this.titleElement.show({duration: 800, queue: false});
        this.contentElement.slideUp({duration: 1000, queue: false});
    }
};

Result.prototype.remove = function() {
    this.containerElement.remove();
};
