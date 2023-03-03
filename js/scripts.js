let dropdown = document.querySelector('.menu'), //ul
    buttonClick = document.querySelector('.check-button'), //button
    hamburger = document.querySelector('.menu-icon');

buttonClick.addEventListener('click', () => {
    dropdown.classList.toggle('show-dropdown'); // add class
    hamburger.classList.toggle('animate-button'); // animation hamburger
})

// Input counter

$(document).ready(function () {
    $('.minus').click(function () {
        var $input = $(this).closest('.number').find("input");
        var count = parseInt($input.val()) - 1;
        count = count < 0 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).closest('.number').find("input");
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});