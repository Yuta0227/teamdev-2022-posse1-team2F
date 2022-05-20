$(function() {
    $('#openModal').click(function() {
        $('#modalArea').fadeIn();
    });
    $('#closeModal , #modalBg').click(function() {
        $('#modalArea').fadeOut();
    });
});

document.getElementById("filter-btn").onclick = function() {
    document.getElementById("filter-btn").classList.add("none");
    document.getElementById("filter-box").classList.toggle("none");
};