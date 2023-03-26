document.addEventListener('DOMContentLoaded', () => {
    console.log('DOMContentLoaded');

    var linkShowDebug = document.getElementById('showDebug');
    var debug = document.getElementById('debug');

    linkShowDebug.addEventListener('click', function () {
        if (debug.style.display === 'block') {
            debug.style.display = 'none';
        } else {
            debug.style.display = 'block';
        }
    });
});

$(document).ready(function () {
    console.log('jQuery OK');
});