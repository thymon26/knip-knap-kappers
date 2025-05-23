// Vervang 'YOUR_API_KEY' met je eigen Google Maps JavaScript API sleutel
function initMap() {
    // Locatie van Aventus in Apeldoorn
    const aventusApeldoorn = { lat: 52.211157, lng: 5.963924 };

    // Maak een nieuwe kaart
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 16,
        center: aventusApeldoorn,
    });

    // Voeg een marker toe voor de kapperszaak
    const marker = new google.maps.Marker({
        position: aventusApeldoorn,
        map: map,
        title: "Kapperszaak bij Aventus Apeldoorn",
    });
}

// Voeg dit toe aan je HTML:
// <div id="map" style="height:400px;width:100%;"></div>
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>