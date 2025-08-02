const container = document.querySelector('.ellipse-container');
const movingDiv = document.querySelector('.moving-div');
let angle = 0;

function animateEllipse() {
    // Ellipse dimensions based on container size
    const centerX = container.offsetWidth / 2;
    const centerY = container.offsetHeight / 2;
    const radiusX = centerX - 15; // Horizontal radius (adjust for div's size)
    const radiusY = centerY - 15; // Vertical radius (adjust for div's size)

    // Update position
    const x = centerX + radiusX * Math.cos(angle);
    const y = centerY + radiusY * Math.sin(angle);

    movingDiv.style.transform = `translate(${x - 15}px, ${y - 15}px)`; // Adjust for div's center

    angle += 0.02; // Speed of the animation
    requestAnimationFrame(animateEllipse);
}

animateEllipse();