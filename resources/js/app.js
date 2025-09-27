import './bootstrap';
import $ from 'jquery';

$(function () {
    const $flipbook = $("#flipbook");

    if (typeof $.fn.turn === "function") {
        $flipbook.turn({
            width: 480,
            height: 320,
            display: "single",
            autoCenter: true,
            acceleration: true,
            gradients: true,
            elevation: 80,
            duration: 1200
        });

        $flipbook.on("click", ".page", function (e) {
            const offset = $flipbook.offset();
            const width = $flipbook.width();
            const pageX = e.pageX - offset.left;

            if (pageX < width / 2) {
                $flipbook.turn("previous");
            } else {
                $flipbook.turn("next");
            }
        });
    } else {
        console.error("Turn.js no está disponible.");
    }
});
