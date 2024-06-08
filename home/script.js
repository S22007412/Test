// script.js
function updateDateTime() {
    const now = new Date();
    const formattedDateTime = now.toLocaleString('es-MX', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    });

    // Split the date and time string
    const parts = formattedDateTime.split(',');

    // Capitalize the first letter of each part
    const capitalizeFirstLetter = str => str.charAt(0).toUpperCase() + str.slice(1);

    const weekday = capitalizeFirstLetter(parts[0]);
    const date = parts[1].trim();
    const time = parts[2].trim();

    // Capitalize the first letter of the month manually
    const dateParts = date.split(' ');
    dateParts[2] = capitalizeFirstLetter(dateParts[2]);

    const formattedDate = dateParts.join(' ');

    document.getElementById('datetime').innerHTML = `${weekday}, ${formattedDate}<br>${time}`;
}

setInterval(updateDateTime, 1000);
updateDateTime(); // Initial call to set the date and time immediately
