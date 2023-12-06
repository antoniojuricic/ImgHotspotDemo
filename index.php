<?php

// Vrijednosti dobivene s prof. strane
$circleSize = 30;
$imgPath = 'map.png';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Hotspot Demo</title>
    <style>
        #image-container {
            position: relative;
            width: 80%;
        }

        #selected-circle {
            position: absolute;
            width: <?php echo $circleSize?>px;
            height: <?php echo $circleSize?>px;
            border-radius: 50%;
            background-color: red;
            border: <?php echo $circleSize / 5 ?>px solid rgba(255, 0, 0, 0.5);
            background-color: rgba(255, 0, 0, 0.5);
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
            display: none;
        }

        #coordinates-display {
            margin-top: 10px;
        }

        #main-image {
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="image-container">
        <img src="<?php echo $imgPath ?>" alt="Demo img" id="main-image">
        <div id="selected-circle"></div>
    </div>

    <div id="coordinates-display"></div>
    <button id="show-coordinates-btn">Show Coordinates</button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imageContainer = document.getElementById('image-container');
            var selectedCircle = document.getElementById('selected-circle');
            var mainImage = document.getElementById('main-image');
            var coordinatesDisplay = document.getElementById('coordinates-display');
            var showCoordinatesBtn = document.getElementById('show-coordinates-btn');

            // Handle window resizing
            window.addEventListener('resize', function() {
                updateImageOffset();
            });

            // Update image offset on load and resize
            function updateImageOffset() {
                imageOffset = {
                    left: imageContainer.offsetLeft,
                    top: imageContainer.offsetTop
                };
            }

            var imageOffset = {};
            updateImageOffset();

            // Handle click on the image
            mainImage.addEventListener('click', function(event) {
                var x = (event.pageX - imageOffset.left) / mainImage.width * 100;
                var y = (event.pageY - imageOffset.top) / mainImage.height * 100;

                // Display the circle at the selected point
                selectedCircle.style.left = (event.pageX - imageOffset.left - <?php echo $circleSize + $circleSize / 2.5 ?> / 2) / mainImage.width * 100 + '%';
                selectedCircle.style.top = (event.pageY - imageOffset.top - <?php echo $circleSize + $circleSize / 2.5 ?> / 2) / mainImage.height * 100 + '%';
                selectedCircle.style.display = 'block';

                // Save the coordinates
                savedCoordinates = { x: x.toFixed(2), y: y.toFixed(2) };
            });

            // Show coordinates on button click
            showCoordinatesBtn.addEventListener('click', function() {
                if (savedCoordinates) {
                    coordinatesDisplay.innerHTML = 'x: ' + savedCoordinates.x + ', y: ' + savedCoordinates.y;
                } else {
                    coordinatesDisplay.innerHTML = 'No coordinates saved yet.';
                }
            });
        });
    </script>
</body>
</html>