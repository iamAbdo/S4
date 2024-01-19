<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/modifier.css">
    <title>Formulaire et Carte</title>
</head>
<body>
    <div class="container">
        <form class="hotel-form">
            <h2>Formulaire pour modifier</h2>

            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" required>

            <label for="location">Location:</label>
            <select id="location" name="location" required>
                <option value="paris">Paris</option>
                <option value="newyork">New York</option>
                <option value="tokyo">Tokyo</option>
            </select>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="price">Prix:</label>
            <input type="text" id="price" name="price" required>

            <label for="rating">Évaluation (étoiles):</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>

            <label for="images">Images:</label>
            <input type="file" id="images" name="images" accept="image/*" multiple required>

            <input type="submit" value="Soumettre">
        </form>

        <div class="info-card">
            <div class="images">
                <img src="./assets/Images/b.jpg" alt="" >
            </div>
            <div class="detail">
                <h1 class="title">nom de lhotel</h1>
                <div class="stars">/5 stars</div>
                <div class="description">
                    PARIS<br>
                    <u>Hotel Description:</u><br>
                </div>
                <div class="services-dhotel">
                    <!-- ... Vos services ... -->
                </div>
                <div class="reserve-option">
                    <!-- ... Vos options de réservation ... -->
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
