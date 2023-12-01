document.addEventListener('DOMContentLoaded', function () {
    // Function to update overlay text and color
    function updateOverlayText(countryName, continent) {
        const overlayText = document.getElementById('prephrase');
        const country = document.getElementById('country-selected');
        country.textContent = countryName;
        country.style.color = getContinentColor(continent);
        country.style.display = 'block';
        overlayText.textContent = "You selected "
    }

    // Get all area elements in the map
    const areas = document.querySelectorAll('area');

    // Add mouseover event listener to each area
    areas.forEach(area => {
        area.addEventListener('click', function (event) {
        const continent = this.getAttribute('data-country');
        const countryName = continent;
        updateOverlayText(countryName, continent);
        });
    });

    // Check if the hash corresponds to a country on page load
    const hash = window.location.hash.substring(1);
    if (hash) {
        const countryElement = document.querySelector(`[data-country="${hash}"]`);
        if (countryElement) {
        const continent = countryElement.getAttribute('data-country');
        const countryName = continent;
        updateOverlayText(countryName, continent);
        }
    }

    // Function to get continent color
    function getContinentColor(continent) {
        switch (continent) {
        case 'Asia':
            return '#dc425c';
        case 'Europe':
            return '#2078b8';
        case 'Africa':
            return 'yellow';
        case 'North America':
            return '#34b34c';
        case 'South America':
            return '#e78321';
        case 'Australia':
            return '#7a66ab';    
        default:
            return 'white'; // Default color or any other color you prefer
        }
    }
    });
