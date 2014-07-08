Hastily written during metaLAB's [Beautiful Data workshop](http://beautifuldata.metalab.harvard.edu/).

Simple javascript to pull a set number of photos from instagram's feed that are tagged with a certain keyword. Photos are then sorted based on the number of tags that appear on a list of designated relevant terms.

To demo online: http://instamuseum.herokuapp.com/
(Live version uses a sample list of relevant terms from a project in the workshop.)

To host yourself:

* obtain a client_id from http://instagram.com/developer/register/
* in **config.js** replace INSTAGRAM_CLIENT_ID_GOES_HERE with your client_id in quotes (e.g. "1234abcxxxxxxxxxxxxxxxxx")
* replace the array of terms with your own

Uses [HTML5 Boilerplate](http://html5boilerplate.com/) and [Bootstrap](http://getbootstrap.com/).